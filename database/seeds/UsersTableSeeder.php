<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$User = new User;
		$User->username = 'system';
		$User->firstname = 'system';
		$User->lastname = 'system';
		$User->access = 100;
		$User->verified = 1;
		$User->active = 1;
		$User->created_by = 1;
		$User->updated_by = 1;
		$User->save();

		$User = new User;
		$User->username = 'administrator';
		$User->firstname = 'administrator';
		$User->lastname = 'administrator';
		$User->email = 'fanoos.cms@gmail.com';
		$User->password = Hash::make(456321);
		$User->access = 100;
		$User->verified = 1;
		$User->active = 1;
		$User->created_by = 1;
		$User->updated_by = 1;
		$User->save();
    }
}
