<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;

class ResponseAPIServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Response::macro('api', function($success, $message_error, $body){
			return response()->json(
				[
					'header'  => 
						[
							'success ' => $success,
							'msg ' => $message_error,
						],
					'body' => 
						[
							$body
						]
				]
			);
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
