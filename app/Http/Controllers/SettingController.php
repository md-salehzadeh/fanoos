<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$_settings = Setting::select(['id', 'name', 'type', 'title', 'description', 'value', 'default'])->where('status', 'published')->take(100)->get();

		$settings = [];
		foreach ( $_settings as $setting ) {
			$settings['core'][] = $setting;
		}

        return response()->json($settings);
	}
}
