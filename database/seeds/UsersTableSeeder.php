<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'full_name' => Config::get('hackerspacecrm.admin_name'),
            'username' => Config::get('hackerspacecrm.admin_username'),
            'email' => Config::get('hackerspacecrm.admin_email'),
            'password' => bcrypt(Config::get('hackerspacecrm.admin_username')),
            'locale' => 'en',
            'verified' => 1,
            'email_token' => '',
            'last_login' => '0000-00-00 00:00:00',
            'remember_token' => '',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
