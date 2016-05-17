<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		DB::table('permissions')->truncate();

		/*
		 * General Hackerspace CRM permissions
		 */
		$permissions = [

			['name' => 'public', 'label' => 'Public'],

			['name' => 'permission_edit', 'label' => 'Edit permission'],

			['name' => 'setting_view', 'label' => 'View setting'],
			['name' => 'setting_edit', 'label' => 'Edit setting'],
			['name' => 'setting_delete', 'label' => 'Delete setting'],

			['name' => 'role_create', 'label' => 'Create role'],
			['name' => 'role_view', 'label' => 'View role'],
			['name' => 'role_edit', 'label' => 'Edit role'],
			['name' => 'role_delete', 'label' => 'Delete role'],

			['name' => 'menu_create', 'label' => 'Create menu'],
			['name' => 'menu_view', 'label' => 'View menu'],
			['name' => 'menu_edit', 'label' => 'Edit menu'],
			['name' => 'menu_delete', 'label' => 'Delete menu'],

			['name' => 'module_install', 'label' => 'Install module'],
			['name' => 'module_view', 'label' => 'View module'],
			['name' => 'module_update', 'label' => 'Update module'],
			['name' => 'module_delete', 'label' => 'Delete module'],

			['name' => 'user_create', 'label' => 'Create user'],
			['name' => 'user_view', 'label' => 'View user'],
			['name' => 'user_edit', 'label' => 'Edit user'],
			['name' => 'user_delete', 'label' => 'Delete user'],

			['name' => 'profile_create', 'label' => 'Create profile'],
			['name' => 'profile_view', 'label' => 'View profile'],
			['name' => 'profile_edit', 'label' => 'Edit profile'],
			['name' => 'profile_delete', 'label' => 'Delete profile'],

		];

		foreach ($permissions as $permission) {
			Permission::create($permission);
		}
	}
}
