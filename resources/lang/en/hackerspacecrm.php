<?php

return [
	'messages'	=> [
		'welcome'	=>	'Welcome to :applicationname',
		'models'	=>	[
			'create'	=>	[
				'success'	=>	':modelname was created successfully!',
				'fail'	=>	':modelname could not be created!',
			],
			'update'	=>	[
				'success'	=>	':modelname was updated successfully!',
				'fail'	=>	':modelname could not be updated!',
			],
			'delete'	=>	[
				'success'	=>	':modelname was deleted successfully!',
				'fail'	=>	':modelname could not be deleted!',
			],
			'translate'	=>	[
				'success'	=>	':modelname translation was created successfully!',
				'fail'	=>	':modelname translation could not be created.',
				'exists'	=>	'This :modelname already has a translation.',
			],
			'notexist'	=>	'The :modelname you were looking for does not exist!',
			'notfound'	=>	'The :modelname you were looking for was not found!',
		],
		'nopermission'	=>	'You don\'t have the required permission to perform this action!',
		'mustlogin'	=>	'You must be loged in in order to see this page!',
		'sessionexpired'	=>	'Your session has expired!',
		'notallowed'	=>	'You are not allowed to perform this action!',
		'confirmemail'	=>	'Please check your email address to confirm and activate your account.',
		'tokennotfound'	=>	'User with provided token was not found!',
		'accountverified'	=>	'Your account has been verified. You may now log in.',
		'notranslation'	=>	'No translation available for this locale!',
	],
	'models'	=> [
		'permission'	=>	'Permission',
		'permissions'	=>	'Permissions',
		'role'	=>	'Role',
		'roles'	=>	'Roles',
		'profile'	=>	'Profile',
		'profiles'	=>	'Profiles',
		'user'	=>	'User',
		'users'	=>	'Users',
		'setting'	=>	'Setting',
		'settings'	=>	'Settings',
		'menu'	=>	'Menu',
		'menus'	=>	'Menus',
		'emailtemplate'	=>	'Email Template',
		'emailtemplates'	=>	'Email Templates',
	],
	'help'	=> [
		'settings'	=> [
			'emails'	=>	'<b>Do not write php code!!!</b> <br />Please make sure you only use the required variables specified under the textarea.<br /><br /><b>Variables you can use:</b> $crm->crmname, $crm->description, $crm->orgname, $crm->orgdescription, $crm->address, $crm->url, $crm->locale, $crm->theme, $crm->new_user_role.<br><br><b>Syntax examples for displaying a variable:</b> {{ $crm->crmname }}, {{ $edit_link }}',
			'roles'		=>	'We do not recommend deleting the default CRM roles, doing so may affect the CRM\'s behaviour. Please consider adding new ones instead.',
		],

	],
	'labels'	=> [
		'selectlocale'	=>	'Language',
	],
	'menus'		=> [
	    'mainnavigation'	=>	'MAIN NAVIGATION',
	    'settings'	=>	'SETTINGS',
	]
];