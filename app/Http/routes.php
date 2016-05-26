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
Route::get('users/{username}', 'UsersController@getUser'); // for ajax request that populates the form
Route::patch('users/{username}', 'UsersController@update');
Route::patch('users/{username}/password', 'UsersController@changePassword');
Route::delete('users/{username}', 'UsersController@delete');


/*
 * Application settings routes
 */
Route::get('settings', function () { return redirect('/'); });
Route::get('settings/general', 'SettingsController@showGeneralSettingsForm');
Route::patch('settings/general', 'SettingsController@editGeneralSettings');
Route::get('settings/emails', function () {
	return view('settings.emails');
});

/*
 * Menus routes
 */
Route::get('settings/menus', 'MenusController@show');
Route::get('settings/menus/{menuId}', 'MenusController@getMenu'); // for ajax request that populates the form
Route::post('settings/menus','MenusController@create');
Route::patch('settings/menus/{menuId}', 'MenusController@update');
Route::delete('settings/menus/{menuId}', 'MenusController@delete');

Route::get('roles', 'RolesController@show');
Route::get('roles/{username}', 'RolesController@getUserRoles'); // for ajax request that populates the form
Route::post('roles/{username}', 'RolesController@update');
Route::get('permissions', 'PermissionsController@showPermissionsForm');
Route::patch('permissions', 'PermissionsController@update');

// \DB::listen(function($query) {
//     var_dump($query);
// });