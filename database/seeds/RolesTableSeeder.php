<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		DB::table('roles')->truncate();

		$roles = [
			['name' => 'administrator', 'label' => 'CRM Administrator'],
			['name' => 'authenticated', 'label' => 'Authenticated'],
			['name' => 'member', 'label' => 'Member'],
			['name' => 'director', 'label' => 'Director'],
			['name' => 'president', 'label' => 'President'],
			['name' => 'vp', 'label' => 'VP'],
			['name' => 'secretary', 'label' => 'Secretary'],
			['name' => 'treasurer', 'label' => 'Treasurer'],
		];

		foreach ($roles as $role) {
			Role::create($role);
		}
	}
}
