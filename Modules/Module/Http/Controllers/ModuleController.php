<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Module\Entities\Module;

use ZanySoft\Zip\Zip;

class ModuleController extends Controller
{
   
    public function index()
    {
		$modules = Module::all();

        return response()->json($modules);
	}
	
    public function install(Request $request)
    {
		$module_file = $request->module_file;
		$file_name = $module_file->getClientOriginalName();
		$path_parts = pathinfo($file_name);
		$file_basename = $path_parts['filename'];
		
		$module_file->move(storage_path("modules/"), $file_name);
		
		$module_zip = storage_path("modules/$file_name");

		$zip = Zip::open($module_zip);
		$zip->extract(storage_path("modules/$file_basename"));

		unlink($module_zip);

		$config = include storage_path("modules/$file_basename/Config/config.php");

		rename(storage_path("modules/$file_basename"), base_path("Modules/{$config['name']}"));

		\Artisan::call("module:migrate {$config['name']}");
		\Artisan::call("module:seed {$config['name']}");

		return [
			'status' => 'success'
		];
	}
	
}
