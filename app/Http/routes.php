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


Route::bind('provider', function($provider) {
	if ($provider == 'facebook') {
		return 'facebook';
	} elseif ($provider == 'twitter') {
		return 'twitter';
	} else {
		return false;
	}
});
Route::get('login/{provider}', [
	'as' => 'login.social',
	'uses' =>'Auth\AuthController@loginSocial',
	]);
Route::get('login/callback/{provider}', [
	'as' => 'callback.social',
	'uses' => 'Auth\AuthController@callbackSocial',
	]);


Route::get('/register', [
	'as' => 'get.register',
	'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', [
	'as' => 'post.register',
	'uses' => 'Auth\AuthController@postRegister']);



Route::get('/', [
	'as' => 'home',
	'uses' => 'SiteController@index']);
Route::get('/photo/{id}', [
	'as' => 'show.photo',
	'uses' => 'SiteController@showPhoto']);
Route::post('photo/upload', [
	'as' => 'upload.photo',
	'uses' => 'SiteController@uploadPhoto']);


Route::post('like/photo', [
		'as' => 'like.photo',
		'uses' => 'LikesController@likePhoto']);
Route::post('unlike/photo', [
		'as' => 'unlike.photo',
		'uses' => 'LikesController@unlikePhoto']);

