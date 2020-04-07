<?php

use Illuminate\Support\Facades\Route;

/*|==========| Auth |==========|*/

Route::group(
	[
		'prefix' => 'auth',
		'as' => 'auth.',
	],
	function () {
		Route::post('login', 'AuthController@login')->name('login');
		Route::post('register', 'AuthController@register')->name('register');
		Route::post('refresh-token', 'AuthController@refreshToken')->name('refresh');


		Route::group(
			[
				'middleware' => 'auth:api'
			],
			function () {
			    Route::post('logout', 'AuthController@logout')->name('logout');
			    
			}
		);		
	}
);

/*|==========| Users |==========|*/

Route::group(
	[
		'prefix' => 'users',
		'as' => 'users.',
	],
	function () {

		Route::group(
			[
				'middleware' => 'auth:api',
			],
			function () {
				Route::post('me', 'UserController@me')->name('me');
			}
		);
	}
);
