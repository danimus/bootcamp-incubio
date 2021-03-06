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


//Route::post('v1/user/remember-password', 'UserController@remember');

Route::get('/reset-password', 'HomeController@reset');

Route::get('/user/logout', 'UserController@logOut');
Route::get('/postlogin','UserController@postLogin');

//Pages for logged users
Route::group(array('prefix' => 'api/v1', 'before' => 'auth'), function()
{
	//User routes
	Route::post('user/register', 'UserController@register');
	Route::post('user/login', 'UserController@logIn');
	Route::get('user/logout', 'UserController@logOut');
	Route::post('user/remember-password', 'UserController@remember');
	Route::post('user/reset-password', 'UserController@reset');
	Route::get('user/confirmateemail/', 'UserController@confirmate');
	Route::get('user/nameuser', 'UserController@getNameUser');
	//Route::get('user/restore/{token?}', 'UserController@restore');
	
	//Tags routes
	Route::post('tags/delete', 'TagController@delete');
	Route::get('tags/get-tags-user', 'TagController@getTagsUser');
	Route::post('tags/add', 'TagController@addNewTag');
	//Statistics routes
	
	Route::get('statistics/global-trends', 'StatisticsController@getGlobalTrends');
	Route::get('statistics/local-trends', 'StatisticsController@getLocalTrends');
	Route::get('statistics/user-tags', 'StatisticsController@getUserTags');

});

Route::get('/tags/{id}', 'TagController@show');

Route::get('/mongo', 'ItemController@create');

Route::get('/tags/{id}', 'TagController@show');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

