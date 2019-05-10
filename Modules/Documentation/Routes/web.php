<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'docs'], function($a) {
	Route::get('/{any}', function ($any) {
		if ( Str::endsWith($any, '.md') ) {
			return file_get_contents(module_path('Documentation').'/Resources/views/docs/'.$any);
		} else {
			$controller = app()->make('Modules\Documentation\Http\Controllers\DocumentationController');
			return $controller->callAction('index', []);
		}
	})->where('any', '.*');


    Route::get('/', function() use ($a) {
		$controller = app()->make('Modules\Documentation\Http\Controllers\DocumentationController');
		return $controller->callAction('index', []);

		if ( Str::endsWith($_SERVER['PATH_INFO'], '/') ) {
			$controller = app()->make('Modules\Documentation\Http\Controllers\DocumentationController');
			return $controller->callAction('index', []);
		} else {
			header('location: http://127.0.0.1:8000/docs/');die;
		}
	});
});
