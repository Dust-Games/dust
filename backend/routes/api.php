<?php

use Illuminate\Support\Facades\Route;

/*|==========| Auth |==========|*/

Route::post('login', 'AuthController@login')->name('login');
Route::post('register', 'AuthController@register')->name('register');
Route::post('refresh-token', 'AuthController@refreshToken')->name('refresh');


Route::group(
	[
		'middleware' => 'auth:api'
	],
	function () {
	    Route::post('logout', 'AuthController@logout')->name('logout');
	    Route::post('me', 'AuthController@me')->name('me');
	}
);