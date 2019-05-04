<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Setting\Entities\Setting;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
