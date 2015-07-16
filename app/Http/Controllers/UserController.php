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
<<<<<<< HEAD
use ResetsPasswords;
use Mail;
use Password;
use Illuminate\Auth\Passwords\PasswordBroker;
=======
>>>>>>> origin/development

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
		$user = User::where('email', '=', Input::get('email'))->first();
		if($user != null){
			/*Mail::send('emails.restorePassword', ['user' => $user], function($m) use ($user){
				$m->to($user->email, $user->name)->subject('Your reminder!');
			}); */

			Mail::send('emails.restorePassword', ['user' => $user], function($message)
			{
				$message->to('ruben.nieto93@gmail.com', 'Ruben Nieto')->subject('Welcome!');
			});
			return response()->api("yes","mail send","");
		}else{
			return response()->api("no","mail send failed","");
		}

		/*Password::remind(Input::only('email'), function($message)
		{
		    $message->subject('Password Reminder');
		  return response()->api("yes","If there is an account associated with the email you will receive an email with a link to reset your password.","");
		});*/
				
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
