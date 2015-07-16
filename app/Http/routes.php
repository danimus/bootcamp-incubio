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

//Pages for logged users

Route::group(array('prefix' => 'api/v1', 'before' => 'auth'), function()
{
	//User routes
	Route::get('user/register', 'UserController@register');
	Route::get('user/login', 'UserController@login');
	Route::get('user/remember-password', 'UserController@remember');

	//Tags routes
	Route::get('tags/add', 'TagsController@index');
	Route::get('tags/delete', 'TagsController@index');
	Route::get('tags/modify', 'TagsController@index');
	Route::get('tags/get-tags-user', 'TagsController@getTagsUser');
	Route::get('tags/add/{tagname}', 'TagsController@addNewTag({tagname})');

	//Statistics routes
	Route::get('statistics/global-trends', 'StatisticsController@index');
	Route::get('statistics/local-trends', 'StatisticsController@index');
	Route::get('statistics/user-tags', 'StatisticsController@index');

});


Route::get('/tags/{id}', 'TagController@show');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	]);
