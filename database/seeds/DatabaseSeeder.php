<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement("SET foreign_key_checks = 0");

        $this->call(MenusTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RolesPermissionsPivotTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UsersRolesPivotTableSeeder::class);

    }
}
