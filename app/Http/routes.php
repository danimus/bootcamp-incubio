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

//Default page
//Route::get('/', 'WelcomeController@index');

//Root page
Route::get('/', 'UserController@login');

Route::get('register', 'UserController@register');


//Pages for logged users
Route::group(['middleware' => ['auth']], function() {
	//User routes
	Route::get('home', 'HomeController@index');
    Route::get('v1/user/login', 'UserController@login');
	Route::get('v1/user/remember-password', 'UserController@remember');

	//Api routes
	Route::get('/v1/api/response', 'ApiController@index');

	//Tags routes
	Route::get('/v1/tags/add', 'TagsController@index');
	Route::get('/v1/tags/delete', 'TagsController@index');
	Route::get('/v1/tags/get-tags-user', 'TagsController@index');

	//Statistics routes
	Route::get('/v1/statistics/global-trends', 'StatisticsController@index');
	Route::get('/v1/statistics/local-trends', 'StatisticsController@index');
	Route::get('/v1/statistics/user-tags', 'StatisticsController@index');

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
