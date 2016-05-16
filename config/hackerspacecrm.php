<?php

return [

	'version' => '0.1 alpha',

	'url' => '/',

	'crmname' => 'Hackerspace CRM',

	'crmdescription' => 'CRM for managing Hackerspaces',

	'crmfooter' => 'Hackerspace CRM',

	'admin_name' => 'CRM Admin',
	'admin_username' => 'admin', // password will be the same when db is seeded (change it after loging in)
	'admin_email' => 'admin@example.com',

	'locale' => 'en',

	'supported_locales' => [
		'en' =>    'English',
		'sq' =>    'Shqip',
	],

	'theme' => 'adminlte',

	'menu_groups' => ['public', 'main', 'settings'],

	'enable_registration' => 1, // 1 = true, 0 = false

	'new_user_role' => 'authenticated',

	'caching_driver' => 'memcached', // file, memcached
	
];