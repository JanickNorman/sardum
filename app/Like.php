<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

	protected $table = 'likes';

	protected $fillable = ['user_id', 'photo_id'];

	public function owner() {

		return $this->belongsTo('App\User', 'user_id');
	}

}
