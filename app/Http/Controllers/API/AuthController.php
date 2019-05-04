<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class AuthController extends Controller
{
	/**
     * login api
     *
     * @return \Illuminate\Http\Response
	*/ 
	public function login()
	{
        if ( Auth::attempt(['email' => request('email'), 'password' => request('password')]) ) {
            $user = Auth::user();
			$access_token = $user->createToken('Android')->accessToken;
			$user = $user->main_cols();
			$user['access_token'] = $access_token;
			return api_response($user, 200);
        } else {
			return api_response([
				'error' => 'authentication_failed',
				'message' => 'اطلاعات ورود صحیح نیست',
			], 401);
        }
	}

	public function logout()
	{
		if ( Auth::check() ) {
			Auth::user()->AauthAcessToken()->delete();
		}
		
        return api_response(null, 200);
	}
	
	/**
     * Register api
     *
     * @return \Illuminate\Http\Response
	*/
    public function register(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'firstname' => [
				'required',
			],
			'lastname' => [
				'required',
			],
			'mobile' => [
				'required',
				'mobile',
				Rule::unique('users'),
			],
			'email' => [
				'required',
				'email',
				Rule::unique('users'),
			],
			'password' => [
				'required',
			],
		]);
		
		if ( $validator->fails() ) {
			return api_response([
				'error' => $validator->errors()
			], 400);
		}
		
		$avatar_file = $request->avatar;
		$avatar = null;

		if ( $avatar_file ) {
			$valid_extensions = str_replace(' ', '', setting('module.user.avatar_ext'));
			$valid_extensions = explode(',', $valid_extensions);
			$valid_maxSize = setting('module.user.avatar_max_size');

			$file_original_name = $avatar_file->getClientOriginalName();
			$ext = explode('.', $file_original_name);
			$ext = end($ext);
			if ( !in_array(strtolower($ext), $valid_extensions) ) {
				return api_response([
					'error' => 'avatar_ext_not_allowed',
					'message' => 'فرمت فایل غیر مجاز است - فرمت های مجاز: '.implode('-', $valid_extensions),
				], 400);
			}

			$file_size = round($avatar_file->getSize() / 1000);
			if ( $file_size > $valid_maxSize ) {
				return api_response([
					'error' => 'avatar_size_not_allowed',
					'message' => 'حجم فایل بیشتر از حد مجاز است - حجم مجاز: KB '.$valid_maxSize,
				], 400);
			}
		
			$fileName = md5($file_original_name.time()).'.'.$ext;

			if ($avatar_file->isValid()) {
				$avatar_file->move("uploads/users/avatars/", $fileName);
				$avatar = $fileName;
			}
		}
		
		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$mobile = $request->mobile;
		$email = $request->email;
		$password = bcrypt(trim($request->password));

        $user = User::create([
			'firstname' => $firstname,
			'lastname' => $lastname,
			'mobile' => $mobile,
			'email' => $email,
			'password' => $password,
			'avatar' => $avatar,
		]);

		$user->notify(new \App\Notifications\AccountCreated());

        $access_token = $user->createToken('Android')->accessToken;
		$user = User::find($user->id)->main_cols();
		$user['access_token'] = $access_token;
		return api_response($user, 200);
	}

	public function social(Request $request) {
		$CLIENT_ID = '';

		$id_token = $request->id_token;

		if ( !$id_token ) {
			return api_response([
				'error' => 'fields_required',
				'message' => 'پارامتر های الزامی ارسال نشده است',
			], 400);
		}

		$client = new \Google_Client(['client_id' => $CLIENT_ID]);

		$payload = $client->verifyIdToken($id_token);
		$user = false;

        if ( $payload ) {
			$provider_id = $payload['sub'];
			$email = $payload['email'];
			$firstname = $payload['given_name'];
			$lastname = $payload['family_name'];
			$avatar = $payload['picture'];

			$user = User::where('email', $email)->first();
            if ( $user ) {
				if ( !$user->firstname ) $user->firstname = $firstname;
				if ( !$user->lastname ) $user->lastname = $lastname;

				$socials = json_decode($user->socials, true);
				if ( !$socials ) $socials = [];
				$socials['google']['provider_id'] = $provider_id;
				$socials['google']['provider_profile'] = "https://plus.google.com/$provider_id";
				$user->socials = json_encode($socials);

                $user->save();
            } else {
                $socials = [];
				$socials['google']['provider_id'] = $provider_id;
				$socials['google']['provider_profile'] = "https://plus.google.com/$provider_id";
				$socials = json_encode($socials);

                $user = User::create([
					'firstname' => $firstname,
					'lastname' => $lastname,
					'email' => $email,
					'socials' => $socials,
					'verified' => 1,
					'active' => 1,
				]);

				$user = User::find($user->id);
			}

			if ( $user && $avatar && !$user->avatar ) {
				$isExists = strpos(basename($avatar),'?');
				if ( $isExists != '' ) $imgName = substr(basename($avatar),0,$isExists);
				else $imgName = basename($avatar);

				$ext = explode('.', $imgName);
				$ext = end($ext);
	
				if ( $imgName && $imgName != "profile_b48.png" ) {
					$imgName = md5($imgName.time()).'.'.$ext;
					$full_path = public_path("uploads/users/avatars/$imgName");
					
					$ch = curl_init($avatar);
					$fp = fopen($full_path, 'wb');
					curl_setopt($ch, CURLOPT_FILE, $fp);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_exec($ch);
					curl_close($ch);
					fclose($fp);
	
					$avatarLocal = ( file_exists($full_path) ) ? $imgName : false;
				} else {
					$avatarLocal = false;
				}
	
				if ( $avatarLocal ) {
					$user->avatar = $avatarLocal;
				}
			}
		}
		
		if ( $user ) {
			$access_token = $user->createToken('Android')->accessToken;
			$user = $user->main_cols();
			$user['access_token'] = $access_token;
			return api_response($user, 200);
		} else {
			return api_response([
				'error' => 'social_signin_failed',
				'message' => 'لاگین یا ثبت نام با گوگل موفقیت آمیز نبود',
			], 400);
		}
	}
	
	/**
     * details api
     *
     * @return \Illuminate\Http\Response
	*/
    public function details()
    {
		$user = Auth::user()->main_cols();
		
		if ( !$user ) {
			return api_response([
				'error' => 'user_not_found',
				'message' => 'کاربر وجود ندارد',
			], 404);
		}

		return api_response($user, 200);
	}
	

	public function mobileVerify(Request $request)
	{
		$mobile = $request->mobile;
		
		if ( !$mobile ) {
			return api_response([
				'error' => 'fields_required',
				'message' => 'شماره موبایل الزامی است',
			], 400);
		}
		
		if ( !preg_match('/^(?:09)(?!.*-.*-)(?:\d(?:-)?){9}$/m', $mobile) ) {
			return api_response([
				'error' => 'mobile_format_not_correct',
				'message' => 'فرمت موبایل صحیح نیست',
			], 400);
		}
		
		$code = mt_rand(1000, 9999);

		$sms_response = (new \Sms)
			->setNumber($mobile)
			->setPattern(1143, ['token' => $code])
			->send();

		if ( $sms_response['status'] == 'error' ) {
			return api_response([
				'error' => 'sms_service_error',
				'message' => 'درحال حاضر قابلیت ارسال پیامک وجود ندارد',
			], 400);
		}

		return api_response([
			'mobile' => $mobile,
			'code' => $code,
		], 200);
	}

}