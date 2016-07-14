<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'DashboardController@index')
Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', 'DashboardController@index');

/* Authentication Routes provided by Laravel */
Route::auth();
/* Email Confirmation Routes */
Route::get('login/confirm/{email_token}', 'Auth\AuthController@confirmEmail');
Route::get('login/confirm', function () {
    return redirect('login');
});

/* Application Locale switch */
Route::get('locale/{locale}', ['as'=>'locale.switch', 'uses'=>'LocaleController@switchLocale']);

/*
 * User / Member / Profile Routes
 */
Route::get('members', 'ProfilesController@all');
Route::get('members/{username}', 'ProfilesController@show');
Route::patch('profiles/{username}', 'ProfilesController@update');
Route::post('profiles/{username}', 'ProfilesController@create');
Route::get('profiles/{username}/create', 'ProfilesController@showCreateForm');
// Route::delete('profiles/{username}', 'ProfilesController@delete');

Route::get('users', 'UsersController@all');
Route::post('users', 'UsersController@create');
Route::get('users/{username}', 'UsersController@getUser'); // for ajax request that populates the form
Route::get('users/{username}/edit', 'UsersController@showUpdateUserForm');
Route::patch('users/{username}', 'UsersController@update');
Route::patch('users/{username}/password', 'UsersController@changePassword');
Route::delete('users/{username}', 'UsersController@delete');


/*
 * Application settings routes
 */
Route::get('settings', function () { return redirect('/'); });
Route::get('settings/general', 'SettingsController@showGeneralSettingsForm');
Route::patch('settings/general', 'SettingsController@updateGeneralSettings');
Route::get('settings/emails', 'EmailTemplatesController@showEmailTemplatesForm');
Route::patch('settings/emails/{templateId}', 'EmailTemplatesController@update');

/*
 * Menus routes
 */
Route::get('settings/menus', 'MenusController@show');
Route::get('settings/menus/{menuId}', 'MenusController@getMenu'); // for ajax request that populates the form
Route::post('settings/menus','MenusController@create');
Route::patch('settings/menus/{menuId}', 'MenusController@update');
Route::delete('settings/menus/{menuId}', 'MenusController@delete');

Route::get('roles', 'RolesController@show');
Route::post('roles', 'RolesController@create');
Route::get('roles/{roleId}', 'RolesController@getRole');
Route::patch('roles/{roleId}', 'RolesController@update');
Route::delete('roles/{roleId}', 'RolesController@delete');

Route::get('roles/user/{username}', 'RolesController@getUserRoles'); // for ajax request that populates the form
Route::post('roles/user/{username}', 'RolesController@updateUserRoles'); // to update roles for a single username

Route::get('permissions', 'PermissionsController@showPermissionsForm');
Route::patch('permissions', 'PermissionsController@update');

// \DB::listen(function($query) {
//     var_dump($query);
// });