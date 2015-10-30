<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use \Socialize as Socialize;
use \Input as Input;
use \App\User as User;
use \Form as Form;

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
		//$this->middleware('guest', ['except' => 'getLogout']);
}
	

	public function twitterLogin() {
		return Socialize::driver('twitter')->redirect();
	}

	public function twitterCallback() {

		try {
			$user = Socialize::driver('twitter')->user();

			//kalo user udah daftar, coba login
			if ($this->auth->attempt([
					'provider' => 'tw',
					'provider_id' => $user->id
				])) 
			{

				return redirect('/')->withSuccess("Welcome");

			} else {
				session(['nama' => $user->name,
						'provider' => 'tw',
						'provider_id' => $user->id]);
			
				return redirect()->action('Auth\AuthController@getRegister');	
			}

		} catch (\Exception $e) {
			return redirect('/');
		}
	}

	public function getRegister(DateHelper $dateHelper) {
		return view('register');
	}


	public function postRegister(Request $request) {

	}

}
