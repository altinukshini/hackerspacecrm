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
Route::patch('/members/{profileId}', 'ProfilesController@update');

/*
 * Application settings routes
 */
Route::get('/reports/membership', function () {
	return view('settings.users.roles');
});

/*
 * Application settings routes
 */
Route::get('/settings', function () {
	return redirect('/');
});
Route::get('/settings/general', 'SettingsController@showGeneral');
Route::patch('/settings/general', 'SettingsController@editGeneral');

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

/*
 * Menus routes
 */
Route::get('/settings/menus', 'MenusController@show');
Route::get('/settings/menus/{menuId}', 'MenusController@getMenu'); // for ajax request that populates the form
Route::post('settings/menus','MenusController@add');
Route::delete('settings/menus/{menuId}', 'MenusController@delete');
Route::patch('/settings/menus/{menuId}', 'MenusController@update');

// \DB::listen(function($query) {
//     var_dump($query);
// });