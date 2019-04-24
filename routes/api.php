<?php

use Illuminate\Http\Request;
use App\Setting;

Setting::init();

/*
/--------------------------------------------------------------------------
/ Auth Routes
/--------------------------------------------------------------------------
*/ 
Route::post('auth/social/google', 'API\AuthController@social');
Route::post('auth/register', 'API\AuthController@register');
Route::post('auth/login', 'API\AuthController@login');
Route::post('auth/mobile-verify', 'API\AuthController@mobileVerify');
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('auth/details', 'API\AuthController@details');
	Route::post('auth/logout','API\AuthController@logout');
});


/*
/--------------------------------------------------------------------------
/ User Routes
/--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('users/list', 'API\UserController@index');
	Route::get('users/get/{id}', 'API\UserController@show');
	Route::post('users/edit/{id}', 'API\UserController@update');
	Route::delete('users/delete/{id}', 'API\UserController@delete');
});