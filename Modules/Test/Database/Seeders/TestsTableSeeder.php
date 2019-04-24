<?php

namespace Modules\Test\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Test\Entities\Test;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test = new Test;
		$test->col1 = 1;
		$test->col2 = 2;
		$test->save();
    }
}
