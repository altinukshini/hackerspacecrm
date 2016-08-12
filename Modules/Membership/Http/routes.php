<?php

Route::group(['middleware' => 'web', 'prefix' => 'module', 'namespace' => 'Modules\Membership\Http\Controllers'], function()
{
	Route::get('membership', 'MembershipController@index');
});