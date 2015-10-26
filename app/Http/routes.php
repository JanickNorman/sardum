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

//Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');


// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController'
// ]);


Route::get('login/{provider?}', 'Auth\AuthController@login');
Route::get('register', 'Auth\AuthController@register');

Route::get('/', 'SiteController@index');
Route::get('gallery/{id}', 'SiteController@photo');
//sekedar redirect
Route::get('gallery', function() {
	return redirect('/');
});

// Route::get('twitter', 'TwitterController@redirectToProvider');
// Route::get('twitter/callback', 'TwitterController@handleProviderCallback');



