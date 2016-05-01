<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('permissions')->truncate();

		/*
		 * General Hackerspace CRM permissions
		 */
		$permissions = [

			['name' => 'permission_edit', 'label' => 'Edit permissions'],

			['name' => 'setting_view', 'label' => 'View settings'],
			['name' => 'setting_edit', 'label' => 'Edit settings'],
			['name' => 'setting_delete', 'label' => 'Delete settings'],

			['name' => 'role_create', 'label' => 'Create roles'],
			['name' => 'role_view', 'label' => 'View roles'],
			['name' => 'role_edit', 'label' => 'Edit roles'],
			['name' => 'role_delete', 'label' => 'Delete roles'],

			['name' => 'menu_create', 'label' => 'Create menus'],
			['name' => 'menu_view', 'label' => 'View menus'],
			['name' => 'menu_edit', 'label' => 'Edit menus'],
			['name' => 'menu_delete', 'label' => 'Delete menus'],

			['name' => 'module_install', 'label' => 'Install modules'],
			['name' => 'module_view', 'label' => 'View modules'],
			['name' => 'module_update', 'label' => 'Update modules'],
			['name' => 'module_delete', 'label' => 'Delete modules'],

			['name' => 'user_create', 'label' => 'Create users'],
			['name' => 'user_view', 'label' => 'View users'],
			['name' => 'user_edit', 'label' => 'Edit users'],
			['name' => 'user_delete', 'label' => 'Delete users'],

			['name' => 'profile_create', 'label' => 'Create profiles'],
			['name' => 'profile_view', 'label' => 'View profiles'],
			['name' => 'profile_edit', 'label' => 'Edit profiles'],
			['name' => 'profile_delete', 'label' => 'Delete profiles'],

		];

		foreach ($permissions as $permission) {
			Permission::create($permission);
		}

	}
}
