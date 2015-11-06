<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['provider_id', 
	'provider_type', 'nama', 'avatar', 'email', 'tanggal_lahir', 'alamat', 'nomer_handphone'];


	protected $guard = ['remember_token'];

	protected $dates = ['tanggal_lahir'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['remember_token'];


	public function photos() {
		return $this->hasMany('App\Photo');
	}

	public function doLikes() {
		return $this->hasMany('App\Like');
	}

	public function likes() {
		return $this->belongsToMany('App\Photo', 'likes');
	}

}
