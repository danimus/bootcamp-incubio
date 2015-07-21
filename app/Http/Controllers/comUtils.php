<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComUtils{

	public function request($success, $message_error, $body)
	{
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
	}
}
