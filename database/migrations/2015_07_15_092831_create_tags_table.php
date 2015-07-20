<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tagname');
			$table->timestamps();
			
		});
		Schema::create('tags_user',function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('tags_id')->unsigned()->index();
			$table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
			$table->timestamps();
		}); //user,tags 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
		Schema::drop('tags_user');
	}

}
