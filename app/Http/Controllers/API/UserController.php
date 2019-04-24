<?php namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Validator;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->main_cols();
		return api_response($users, 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

		if ( !$user ) {
			return api_response([
				'error' => 'user_not_found',
				'message' => 'کاربر وجود ندارد',
			], 404);
		}

		return api_response($user->main_cols(), 200);
    }

    public function update(Request $request, $id)
    {
		$user = User::find($id);
		
		if ( !$user ) {
			return api_response([
				'error' => 'user_not_found',
				'message' => 'کاربر وجود ندارد',
			], 404);
		}

		$validator = Validator::make($request->all(), [
			'firstname' => [
				'required',
			],
			'lastname' => [
				'required',
			],
			'email' => [
				'required',
				'email',
				Rule::unique('users')->ignore($user->id),
			],
		]);
		
		if ( $validator->fails() ) {
			return api_response([
				'error' => $validator->errors()
			], 400);
		}

		$firstname = $request->firstname;
		$lastname = $request->lastname;
		$mobile = $request->mobile;
		$email = $request->email;
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
				$err = 'حجم فایل بیشتر از حد مجاز است - حجم مجاز: KB '.$valid_maxSize;
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

		$user_data = [
			'firstname' => $firstname,
			'lastname' => $lastname,
			'mobile' => $mobile,
			'email' => $email,
		];
		if ( $request->has('avatar') ) $user_data['avatar'] = $avatar;
		$user->update($user_data);

		return api_response($user->main_cols(), 200);
    }

    public function delete($id)
    {
		$user = User::find($id);

		if ( !$user ) {
			return api_response([
				'error' => 'user_not_found',
				'message' => 'کاربر وجود ندارد',
			], 404);
		}

		$user->delete();

		return api_response(null, 200);
    }
}