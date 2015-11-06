<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

	protected $table = "photos";


	public function uploader() {

		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	public function likes() {

		return $this->hasMany('App\Like');
	}

	public function likedBy() {

		return $this->belongsToMany('Auth\User', 'likes');
	}
}
