<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
<<<<<<< HEAD
			$table->integer('tagid');
			$table->boolean('confirmed') -> default(0);
			$table->string('confirmation_code')->nullable();
=======
>>>>>>> 9479de3079c78b157758f6d7c1dd11e13ab4595d
			$table->rememberToken();
			$table->timestamps();
			$table->string('user_twitter');
			$table->boolean('active')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
