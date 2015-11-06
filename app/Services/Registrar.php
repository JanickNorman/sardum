<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'provider_type' => 'in:tw,fb|required',
			'provider_id' => 'required',
			'email' => 'required|email|max:255',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'nama' => $data['nama'],
			'provider_type' => $data['provider_type'],
			'provider_id' => $data['provider_id'],
			'nama' => $data['nama'],
			'email' => $data['email'],
			'avatar' => $data['avatar'],
			'tanggal_lahir' => $data['tanggal_lahir'],
			'alamat' => $data['alamat'],
			'nomer_handphone' => $data['nomer_handphone'], 
		]);
	}

}
