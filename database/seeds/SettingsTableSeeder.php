<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('settings')->truncate();

		$settings = [
		
			['key' => 'base_url', 'value' => Config::get('hackerspacecrm.base_url')],
			['key' => 'site_title', 'value' => Config::get('hackerspacecrm.site_title')],
			['key' => 'tagline', 'value' => Config::get('hackerspacecrm.tagline')],
			['key' => 'default_locale', 'value' => Config::get('hackerspacecrm.default_locale')],
			['key' => 'default_theme', 'value' => Config::get('hackerspacecrm.default_theme')],
			['key' => 'registration', 'value' => Config::get('hackerspacecrm.registration')],
			['key' => 'new_user_default_role', 'value' => Config::get('hackerspacecrm.new_user_default_role')]

		];

		foreach ($settings as $setting) {
			Setting::create($setting);
		}


	}
}
