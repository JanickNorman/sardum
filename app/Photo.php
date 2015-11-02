<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

	protected $table = "photos";


	public function uploader() {

		return $this->belongsTo('App\User');
	}

	public function likes() {

		return $this->hasMany('App\Like');
	}
}
