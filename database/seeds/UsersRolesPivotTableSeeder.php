<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersRolesPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('role_user')->truncate();

        $admin = User::whereUsername('admin')->firstOrFail();
        $admin->roles()->attach(Role::whereName('administrator')->firstOrFail());
    }
}
