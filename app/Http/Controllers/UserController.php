<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use View;
use Redirect;
use Response;
use Input;
use Hash;
use Illuminate\Database\QueryException as QueryException;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	
	public function login(){

		if(Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))){

			return response()->api("yes","Logged in successfully","");
		}
		else{
			return response()->api("no","Auth failed","");
		}

	}

	public function register(){

		$user = new User;
		$user->name =  Input::get('name');
		$user->email =  Input::get('email');
		$user->password = Hash::make(Input::get('password'));

		try{
			$user->save();
			return response()->api("yes","User created successfully","");

		}
		catch (QueryException $e) {
			return response()->api("no","Error while saving user","");

		}
	}

	public function remember(){
		return View::make('auth/password');	
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// 
	}

}
