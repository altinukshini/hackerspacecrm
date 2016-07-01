<?php

return [

	'version' => '0.1 alpha',

	// app url
	'url' => '/',

	'crmname' => 'Hackerspace CRM',

	'crmdescription' => 'CRM for managing Hackerspaces',

	'crmfooter' => 'Hackerspace CRM',

	'admin_name' => 'CRM Admin',
	'admin_username' => 'admin', // password will be the same when db is seeded (change it after loging in)
	'admin_email' => 'admin@example.com',

	// default locale
	'locale' => 'en',

	'supported_locales' => [
		'en' =>    'English',
		'sq' =>    'Shqip',
	],

	// default theme
	'theme' => 'adminlte',

	// supported menu groups (do not change these)
	'menu_groups' => ['public', 'main', 'settings'],

	// enable registration via /register for new users
	'enable_registration' => 1, // 1 = true, 0 = false

	// newly created user role
	'new_user_role' => 'authenticated',

	// do not change this
	'caching_driver' => 'memcached', // file, memcached
	
];