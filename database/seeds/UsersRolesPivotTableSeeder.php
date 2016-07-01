<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersRolesPivotTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		DB::table('role_user')->truncate();

		$admin = User::whereUsername(crminfo('admin_username'))->firstOrFail();
		$admin->roles()->attach(Role::whereName('administrator')->firstOrFail());
	}
}
