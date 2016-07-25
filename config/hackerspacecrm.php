<?php

return [

	/*
    |--------------------------------------------------------------------------
    | CRM Version
    |--------------------------------------------------------------------------
    |
    | This option controls the CRM version used throughout the application.
    |
    | Do not change this!
    |
    */
	'version' => '0.1 alpha',

    /*
    |--------------------------------------------------------------------------
    | CRM url
    |--------------------------------------------------------------------------
    |
    | This is the full url of the CRM implementation.
    | In case you are installing the CRM under a different basepath from root /
    | please specify it in the url too. Do not forget the slash (/) in the end.
    | 
    | Default:	http://localhost/
    |
    | Examples:	http://localhost/
    | 			http://localhost/crm/
    |
    */
	'url' => 'http://localhost:8000/',

    /*
    |--------------------------------------------------------------------------
    | CRM basepath
    |--------------------------------------------------------------------------
    |
    | This is the basepath of your CRM implementation, that is used throughout
    | the application.
    |
    | Default: '/'
    |
    */
    'basepath' => '/',

    /*
    |--------------------------------------------------------------------------
    | CRM name
    |--------------------------------------------------------------------------
    |
    | This is the name of your CRM implementation. You can change it as you
    | desire or leave it as is.
    |
    | Default: 'Hackerspace CRM'
    |
    | Use example: 'Prishtina Hackerspace CRM'
    |
    */
	'crmname' => 'Hackerspace CRM',

    /*
    |--------------------------------------------------------------------------
    | CRM description
    |--------------------------------------------------------------------------
    |
    | This is the description of what your CRM does. You can change it as you
    | desire or leave it as is.
    |
    | Default: 'CRM for managing Hackerspaces'
    |
    | Use example: 'Prishtina Hackerspace membership management system'
    |
    */
	'crmdescription' => 'CRM for managing Hackerspaces',

    /*
    |--------------------------------------------------------------------------
    | CRM footer
    |--------------------------------------------------------------------------
    |
    | The content of this option will display in the footer.
    |
    | Default: 'Hackerspace CRM'
    |
    | Use example: 'Prishtina Hackerspace CRM'
    |
    */
	'crmfooter' => 'Hackerspace CRM',

    /*
    |--------------------------------------------------------------------------
    | Organisation name
    |--------------------------------------------------------------------------
    |
    | If your hackerspace has an organisation behind, use this option to 
    | document that, or just change it to your hackerspace name.
    |
    | Default: 'Hackerspace CRM'
    |
    | Use example: 'Prishtina Hackerspace CRM'
    |
    */
    'orgname' => 'Hackerspace CRM',

    /*
    |--------------------------------------------------------------------------
    | Organisation description
    |--------------------------------------------------------------------------
    |
    | Put a short description of your organisation in here.
    |
    */
    'orgdescription' => '',

    /*
    |--------------------------------------------------------------------------
    | Hackerspace / Organisation address
    |--------------------------------------------------------------------------
    |
    | Write down the address of your hackerspace of organisation.
    |
    | Example: 'Ganimete Terbeshi Str. #2<br />Prishtina, 10000<br />Republic of Kosovo'
    |
    */
    'address' => '',

    /*
    |--------------------------------------------------------------------------
    | CRM Administrator's name
    |--------------------------------------------------------------------------
    |
    | This option will be used when creating the CRM administrator user.
    | Name it as you desire.
	| 
	| Default: 'CRM Admin'
    |
    | Example: 'Administrator', 'Master Hacker'
    |
    */
	'admin_name' => 'CRM Admin',

    /*
    |--------------------------------------------------------------------------
    | CRM Administrator's username
    |--------------------------------------------------------------------------
    |
    | This option will be used when creating the CRM administrator user.
    | Name it as you desire.
	| 
	| Default: 'admin'
    |
    | Example: 'administrator', 'hackeruser', 'root'
    |
    | Please note that the password of this user will be the same 
   	| as the username when the database is seeded. 
   	| Change it after loging in.
    |
    |
    */
	'admin_username' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | CRM Administrator's email
    |--------------------------------------------------------------------------
    |
    | This option will be used when creating the CRM administrator user.
    | Name it as you desire.
	| 
	| Default: 'CRM Admin'
    |
    | Example: 'Administrator', 'Master Hacker'
    |
    */
	'admin_email' => 'admin@example.com',

    /*
    |--------------------------------------------------------------------------
    | CRM default language
    |--------------------------------------------------------------------------
    |
    | This option manages the CRM's default language. In case you have more
    | supported locales under 'supported_locales', you can change this
    | option to a different locale.
	| 
	| Default: 'en'
    |
    */
	'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | CRM supported languages
    |--------------------------------------------------------------------------
    |
    | This option manages the CRM's supported languages. In case you have
    | translated the default CRM strings to a different language, please add
    | that language in this array so that changing language is available for
    | your users.
	| 
	| Default: ['en' => 'English']
	|
	| Example: 'supported_locales' => [
	|				'en' =>    'English',
	|				'sq' =>    'Shqip',
	|			],
    |
    */
	'supported_locales' => [
		'en' =>    'English',
		'sq' =>    'Shqip',
	],

    /*
    |--------------------------------------------------------------------------
    | CRM default theme
    |--------------------------------------------------------------------------
    |
    | This option is not supported yet. But leave it there for now :)
	| 
	| Default: 'adminlte'
    |
    */
	'theme' => 'adminlte',

    /*
    |--------------------------------------------------------------------------
    | CRM menu groups
    |--------------------------------------------------------------------------
    |
    | This option is not supported yet. But leave it there for now :)
    | These options are used when creating the CRM default menus
	| 
	| Default: ['public', 'main', 'settings']
	|
	| Do not change this!
    |
    */
	'menu_groups' => ['public', 'main', 'settings'],

    /*
    |--------------------------------------------------------------------------
    | User registration
    |--------------------------------------------------------------------------
    |
    | Via this option you decide if a guest user can register 
    | via the /register page. If you wish to manage user registration yourself, 
    | set this variable to 0. You can as well change this via admin panel.
    |
	| Default: 1
    |
    */
	'enable_registration' => 1, // 1 = true, 0 = false

    /*
    |--------------------------------------------------------------------------
    | New user role
    |--------------------------------------------------------------------------
    |
    | When a user registers via /registration or is created by a CRM
    | administrator at /users page, This role will be assigned to that user.
    | You can manage this option via admin panel.
    | 
    | Supported default roles: administrator, authenticated, member, director, 
    |				 		   president, vp, secretary, treasurer
    |
	| Default: authenticated
    |
    */
	'new_user_role' => 'authenticated',

    /*
    |--------------------------------------------------------------------------
    | Caching driver
    |--------------------------------------------------------------------------
    |
    | This option is not yet supported. Leave it as is for now :)
    |
	| Default: 'memcached'
	|
	| Do not change this!
    |
    */
	'caching_driver' => 'memcached',
	
];