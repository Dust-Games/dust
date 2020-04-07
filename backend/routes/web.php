<?php

use Illuminate\Support\Facades\Route;

/*|==========| Laravel Passport |==========|*/

Route::group(
	[
		'prefix' => 'oauth',
		'namespace' => '\Laravel\Passport\Http\Controllers',
	],
	function () {

		Route::post('/token', 'AccessTokenController@issueToken')
			->name('passport.token')->middleware('throttle');

});