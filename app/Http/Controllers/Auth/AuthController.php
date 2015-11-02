<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use \Socialize as Socialize;
use \Input as Input;
use \App\User;
use \Form as Form;
use \Auth as Auth;
use \Session as Session;

use App\AuthenticateUser;
use Illuminate\Http\Request;
use App\DateHelper;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
}
	

	public function loginTwitter() {
		return Socialize::driver('twitter')->redirect();
	}

	public function callbackTwitter() {

		try {
			$user = Socialize::driver('twitter')->user();

			//tambah data rekomendasi di default form nya
			Session::put(['nama' => $user->name,
					'provider_type' => 'tw',
					'provider_id' => $user->id,
					'avatar' => $user->avatar]);

			return redirect()->route('get.register');	
		} catch (\Exception $e) {
			return redirect('/')->route('home');
		}
	}

	/*
	*
	* DateHelper logic dari form datenya, supaya ngga ada 31 February
	*
	*/
	public function getRegister(DateHelper $dateHelper) {
		return view('register');
	}


	public function postRegister(Request $request) {
		$input = $request->except('_token');

		if (Session::has('provider_id') && Session::has('provider_type') && Session::has('avatar')) {
			
			$data = [
				'provider_type' => Session::get('provider_type'),
				'provider_id' => Session::get('provider_id'),
				'nama' => $input['nama'],
				'avatar' => Session::get('avatar'),
				'email' => $input['email'],
				'tanggal_lahir' => $input['tanggal_lahir']['day'],
				'alamat' => $input['alamat'],
				'nomer_handphone' => $input['nomer_handphone']
			];
			$validator = $this->registrar->validator($data);
			if (!$validator->fails()) {

				return redirect()->route('home');
			}
			$user = $this->registrar->create($data);
			Auth::login($user);

			return redirect('/');
		}

		return redirect()->route('get.register')->withMessage('please choose login provider');
	}

}
