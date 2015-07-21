<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class tags extends Model {

	protected $table = 'tags';

	public function users()
	{
		return $this ->belongsToMany('App\user')->withTimestamps();
	}

}
