<?php

use App\Setting;
use App\User;
use Carbon\Carbon;

function setting($name = false, $field = 'value')
{
	$settings = Setting::getCache();

	if ( $name ) {
		return isset($settings[$name][$field]) ? $settings[$name][$field] : null;
	} else {
		return $settings;
	}
}

function api_response($response, $code = 200) {
	$user = \Auth::user();
	$user_hash = null;
	if ( $user ) {
		$user = $user->main_cols();
		$user_hash = md5(json_encode($user));
	}

	if ( $response === false || $response === null ) $response = new \stdClass;
	
	$response = [
		// 'sys_hash' => md5('sys_hash'),
		'user_hash' => $user_hash,
		'response' => $response
	];

	return response()->json($response, $code);
}