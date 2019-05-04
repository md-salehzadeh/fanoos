<?php

namespace Modules\Module\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Module\Entities\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

		$module = new Module;
		
		$module->create([
			"name" => "Core",
			"title" => "هسته",
			"description" => "ماژول هسته سیستم",
			"version" => "1.0.0",
			"release_date" => "2019-04-26",
			"dependencies" => null,
			"author_name" => "mohammad salehzadeh",
			"author_email" => "hidden.shadow.phcj@gmail.com",
		]);

		$module->create([
			"name" => "Module",
			"title" => "ماژول ها",
			"description" => "ماژول مدیریت ماژول ها",
			"version" => "1.0.0",
			"release_date" => "2019-04-26",
			"dependencies" => null,
			"author_name" => "mohammad salehzadeh",
			"author_email" => "hidden.shadow.phcj@gmail.com",
		]);
    }
}
