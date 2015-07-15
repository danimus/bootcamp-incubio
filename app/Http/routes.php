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
Route::get('/', 'WelcomeController@index');

//Main page for logged users
Route::get('v1/home', 'HomeController@index');


//User's pages
Route::get('v1/user/login', 'UserController@login');
Route::get('v1/user/register', 'UserController@register');
Route::get('v1/user/remember-password', 'UserController@remember');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

