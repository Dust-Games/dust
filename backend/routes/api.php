<?php

use Illuminate\Support\Facades\Route;

/*|==========| Auth |==========|*/

Route::post('login', 'AuthController@login')->name('login');
Route::post('register', 'AuthController@register')->name('register');


Route::group(
	[
		'middleware' => 'auth:api'
	],
	function () {
	    Route::post('logout', 'AuthController@logout')->name('logout');
	    Route::post('refresh', 'AuthController@refresh')->name('refresh');
	    Route::post('me', 'AuthController@me')->name('me');
	}
);