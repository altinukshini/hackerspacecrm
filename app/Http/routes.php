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

/* Authentication Routes provided by Laravel */
Route::auth();

/* Email Confirmation Routes */
Route::get('/login/confirm', function () {
	Flash::error('You don\'t have permission to access this page');
    return redirect('/');
});
Route::get('/login/confirm/{email_token}', 'Auth\AuthController@confirmEmail');


Route::get('/dashboard', 'DashboardController@index');

/* Application Locale switch */
Route::get('locale/{locale}', ['as'=>'locale.switch', 'uses'=>'LocaleController@switchLocale']);

/*
 * User / Member / Profile Routes
 */
Route::get('/members', function () {
	Flash::info('Page not created yet');
    return redirect('/');
});
Route::get('/members/{profile}', 'ProfilesController@show');


/*
 * Application settings routes
 */
Route::get('/settings', function () {
	return redirect('/');
});
Route::get('/settings/general', function () {
	return view('settings.general');
});
Route::get('/settings/emails', function () {
	return view('settings.emails');
});

Route::get('/settings/users/all', function () {
	return view('settings.users.all');
});
Route::get('/settings/users/roles', function () {
	return view('settings.users.roles');
});
Route::get('/settings/users/permissions', function () {
	return view('settings.users.permissions');
});

Route::get('/settings/menus', 'SettingsController@showMenu');

// Route::patch('/settings/menus/{$menu}', 'SettingsController@updateMenu');

Route::delete('settings/menus/{menu}', function(){
	Flash::success('Menu was deleted succesfully!');
	return back();
});
