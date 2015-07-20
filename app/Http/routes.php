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


//Root page
Route::get('/', 'HomeController@index');


Route::get('register', 'UserController@register');


//Pages for logged users
<<<<<<< HEAD
Route::group(['middleware' => ['auth']], function() {
	//User routes
	Route::get('home', 'HomeController@index');
    Route::get('v1/user/login', 'UserController@login');
	Route::get('v1/user/remember-password', 'UserController@remember');
=======
>>>>>>> development

Route::group(array('prefix' => 'api/v1', 'before' => 'auth'), function()
{
	//User routes
	Route::post('user/register', 'UserController@register');
	Route::post('user/login', 'UserController@login');
	Route::post('user/remember-password', 'UserController@remember');

	//Tags routes
<<<<<<< HEAD
	Route::get('/v1/tags/add', 'TagsController@index');
	Route::get('/v1/tags/delete', 'TagsController@index');
	Route::get('/v1/tags/get-tags-user', 'TagsController@index');
=======
	Route::post('tags/delete', 'TagController@delete');
	Route::get('tags/get-tags-user', 'TagController@getTagsUser');
	Route::post('tags/add', 'TagController@addNewTag');
>>>>>>> development

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
