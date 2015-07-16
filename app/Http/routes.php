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
Route::get('/', 'UserController@index');
Route::post('v1/user/register', 'UserController@register');
Route::post('v1/user/login', 'UserController@login');
Route::post('v1/user/remember-password', 'UserController@remember');

//Pages for logged users
Route::group(['middleware' => ['auth']], function() {
	//User routes
	Route::get('home', 'HomeController@index');

	//Tags routes
	Route::get('/v1/tags/add', 'TagsController@index');
	Route::get('/v1/tags/delete', 'TagsController@index');
	Route::get('/v1/tags/modify', 'TagsController@index');

	//Statistics routes
	Route::get('/v1/statistics/global-trends', 'StatisticsController@index');
	Route::get('/v1/statistics/local-trends', 'StatisticsController@index');
	Route::get('/v1/statistics/user-tags', 'StatisticsController@index');

	//Route::post('v1/user/register','UserController@register');

});

Route::get('/v1/tags/get-tags-user', 'TagController@getTagsUser');

Route::get('/tags/{id}', 'TagController@show');

Route::get('/v1/tags/add/{tagname}', 'TagController@addNewTag({tagname})');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);
