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
	flashMessage('You don\'t have permission to access this page', 'danger', true);
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
	flashMessage('Page not created yet', 'info', true);
    return redirect('/');
});
Route::get('/members/{profile}', 'ProfilesController@show');