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
		
			['key' => 'url', 'value' => Config::get('hackerspacecrm.url')],
			['key' => 'crmname', 'value' => Config::get('hackerspacecrm.crmname')],
			['key' => 'crmdescription', 'value' => Config::get('hackerspacecrm.crmdescription')],
			['key' => 'locale', 'value' => Config::get('hackerspacecrm.locale')],
			['key' => 'theme', 'value' => Config::get('hackerspacecrm.theme')],
			['key' => 'enable_registration', 'value' => Config::get('hackerspacecrm.enable_registration')],
			['key' => 'new_user_role', 'value' => Config::get('hackerspacecrm.new_user_role')]

		];

		foreach ($settings as $setting) {
			Setting::create($setting);
		}


	}
}
