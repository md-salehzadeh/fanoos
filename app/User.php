<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'firstname', 'lastname', 'avatar', 'email', 'mobile', 'phone', 'password', 'remember_token', 'status', 'activation_code', 'opts', 'socials', 'access', 'verified', 'active', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
	protected $casts = [];

	public function AauthAcessToken() {
		return $this->hasMany('\App\OauthAccessToken');
	}

	public function Contact() {
		return $this->hasMany('\App\Contact', 'user_id', 'id');
	}

	public function main_cols() {
		$columns = ['id', 'firstname', 'lastname', 'avatar', 'email', 'mobile', 'created_at'];
		return array_intersect_key($this->toArray(), array_flip($columns));
	}
}
