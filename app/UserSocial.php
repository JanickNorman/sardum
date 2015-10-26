<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class UserSocial extends Model implements AuthenticatableContract {

	use Authenticatable;

	protected $table = 'users_social';

	protected $fillable = ['name', 'email', 'username', 'provider', 'provider_id', 'remember_token'];

}
