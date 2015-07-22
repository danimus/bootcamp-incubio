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
use ResetsPasswords;
use Mail;
use Password;
use Illuminate\Auth\Passwords\PasswordBroker;

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

	public function register(Request $request){
		try{
			$name=$request->input('name');	
			//required field
			if(!(empty($name))){
				$email= $request->input('email');
				//required field
				if(!empty($email)){
					//email format
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$password= $request->input('password');
						$password2= $request->input('password2');
						//required fields
						if(!(empty($password) || empty($password2))){
							//password match
							if($password==$password2){
								//minimum password length
								if(strlen($password)>=6){
									$user = new User;
									$user->name =  $name;
									$user->email =  $email;
									$user->password = Hash::make($password);
									$user->save();
									return response()->api("yes","User created successfully","");
								}else{
									return response()->api("no","Password too short, minimum 6 characters","");
								}
							}else{
								return response()->api("no","Passwords don't match","");
							}
						}else{
							return response()->api("no","Passwords required","");
						}
					}else{								
						return response()->api("no","Invalid e-mail format","");
					}
				}else{
					return response()->api("no","E-mail is required","");
				}
			}else{
				return response()->api("no","Name is required","");
			}	
		}catch (QueryException $e) {
			return response()->api("no","Error while saving user","");
		}
	}

	public function remember(Request $request){
		//$email = $request->input('email');
		$user = User::where('email', '=', Input::get('email'))->first();
		if($user != null){
			Mail::send('emails.restorePassword', ['user' => $user], function($message)
			{
				$message->to(Input::get('email'))->subject('Restablece tu contraseña');
			});
			return response()->api("yes","Mail send, please check your mailbox","");
		}else{
			return response()->api("no","Mail do not send, please try again","");
		}		
	}

	public function reset(){
		$user = User::where('email', '=', Input::get('email'))->first();
		if(Input::get('password') == Input::get('password_confirmation')){
			$user->password = Hash::make(Input::get('password'));
			try{
				$user->save();	
			}
			catch(QueryException $e){
				return response()->api("no","Error while saving user","");
			}
			return response()->api("yes","Reset password".Input::get('password'),"");	
		}else{
			return response()->api("no","Passwords don't match","");	
		}
	}

	public function restore(){
		return View::make('auth/reset');
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

	public function loginTwitter(){
		$oauth_token = Input::get('oauth_token');
		$oauth_verifier = Input::get('oauth_verifier');
    	// get service
		$twit = OAuth::consumer('Twitter');

    	// check if code is valid

    	// if code is provided get user data and sign in
		if (!empty($oauth_token)) {

        	// This was a callback request from google, get the token
			$token = $twit->requestAccessToken($oauth_token, $oauth_verifier);

        	// Send a request with it
			$result = json_decode( $twit->request( 'account/verify_credentials.json' ), true );

			echo print_r($result);

		}
    	// if not ask for permission first
		else {
        	// get authorization
			$token = $twit->requestRequestToken();
			$url = $twit->getAuthorizationUri(array('oauth_token' => $token->getRequestToken()));

        	// return to login url
			return Response::make()->header( 'Location', (string)$url );
		}
	}
}
