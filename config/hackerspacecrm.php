<?php

return [

	'base_url' => '/',

	'site_title' => 'Hackerspace CRM',

	'tagline' => 'CRM for managing Hackerspaces',

    'admin_name' => 'CRM Admin',
    'admin_username' => 'admin', // password will be the same when db is seeded (change it after loging in)
    'admin_email' => 'admin@example.com',

	'default_locale' => 'en',

    'supported_locales' => [
        'en' =>    'English',
        'sq' =>    'Shqip',
    ],

	'default_theme' => 'adminlte',

	'registration' => 1, // 1 = true, 0 = false

	'new_user_default_role' => 'authenticated',
	

];