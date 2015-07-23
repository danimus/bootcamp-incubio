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
use Log;

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
	public function getNameUser()
	{
		$var=  Auth::user()->name;
		return response()->json($var);
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

	public function logOut(){
		Auth::logout();
		return response()->api("yes","Logged out successfully","");

	}

	
	public function logIn(){
		$email=Input::get('email');
		$password=Input::get('password');
		$user = User::where('email', '=', $email)->first();
		if(!(empty($email) || empty($password))){
			if ($user == null){
				$success="no";
				$msg="You are not registered";
			} else {
				if ($user->confirmed == 0){
					$success="no";
					$msg="Your account is not activated, check your mailbox";
				}else if(Auth::attempt(array('email'=>$email, 'password'=>$password))){
					$success="yes";
					$msg="Logged in successfully";
				}else if ($user-> password != $password){
					$success="no";
					$msg="Your password is incorrect";			}			
			}
		}else{
			$success="no";
			$msg="There are some empty fields";
		}
		return response()-> api($success,$msg,"");
		
	}

	private function saveUser($name, $email, $password){
		$user = new User;
		$token  = UserController::getToken(12);
		$user ->token = $token;
		$user->name =  $name;
		$user->email =  $email;
		$user->password = Hash::make($password);
		Mail::send('emails.confirmation', array('user' => $user, 'token' => $token), function($message) use ($user)
			{
			  $message->to($user->email)->subject('Confirmar Mail');
			});
		$user->save();
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
									$this->saveUser($name,$email,$password);
									$success="yes";
									$msg="User created successfully";
								}else{
									$success="no";
									$msg="Password too short, minimum 6 characters";
								}
							}else{
								$success="no";
								$msg="Passwords don't match";	
							}
						}else{
							$success="no";
							$msg="Passwords required";
						}							
					}else{			
						$success="no";
						$msg="Invalid e-mail format";		
					}				
				}else{
					$success="no";
					$msg="E-mail is required";
				}	
			}else{
				$success="no";
				$msg="Name is required";	
			}

		}catch (QueryException $e) {

			$success="no";
			$msg="This e-mail is already registered";
		}
		return response()->api($success,$msg,"");
	}


	public function remember(){
		$user = User::where('email', '=', Input::get('email'))->first();
		$token = UserController::getToken(12);
		$user -> token = $token;
		$user -> save(); 
		if($user != null){
			Mail::send('emails.restorePassword', array('user' => $user, 'token' => $token ), function($message)
			{
				$message->to(Input::get('email'))->subject('Restablece tu contraseña');
			});
			return response()->api("yes","Mail send, please check your mailbox","");
		}else{
			return response()->api("no","Mail do not send, please try again","");
		}		
	}

	public function reset(Request $request){
		$token = $request -> input('token');
		$user = User::where('token', '=', $token)->first();
		if ($user == null) return response() -> api('no', 'Password recovery progress error', "");
		else if($request -> input('password') == $request -> input('passwordconfirmation')){
			$user->password = Hash::make(Input::get('password'));
			$user->token = '0';
			try{
				$user->save();	

			}
			catch(QueryException $e){
				return response()->api("no","This e-mail is not in use","");
			}
			return response()->api("yes","Reset password",Input::get('password'));	
		}else{
			return response()->api("no","Passwords don't match","");	
		}
	}

	public function restore($token){

		return View::make('auth/reset')->with('token',$token);
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

	private function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
	}

	public function getToken($length){
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    for($i=0;$i<$length;$i++){
	        $token .= $codeAlphabet[UserController::crypto_rand_secure(0,strlen($codeAlphabet))];
	    }
	    return $token;
	}


	public function confirmate(Request $request) {

		$token = $request -> input('token');
		$user = User::where('token','=',$token)-> first();

		if ($user != null) {
			$user-> token = '0';
			$user -> confirmed = '1';
			$user -> save();
			return response() -> api("yes", "Successfully confirmed", "");
		}
		else return response() -> api("no", "Problems with confirmation progress","");
			
	}

}
