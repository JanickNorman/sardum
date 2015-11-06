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
use \Carbon\Carbon;
use \Validator as Validator;

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

			$existingUser = User::where('provider_type', 'tw')->where('provider_id', (string) $user->id)->first();

			if ($existingUser) {
				$this->auth->login($existingUser);
				return redirect('/')->withSuccess('hello' . Auth::user()->nama);
			}

			//tambah data rekomendasi di default form nya
			Session::put(['nama' => $user->name,
					'provider_type' => 'tw',
					'provider_id' => $user->id,
					'avatar' => $user->avatar
					]);

			return redirect()->route('get.register');
		} catch (\Exception $e) {
			return redirect('/');
		}
	}

	public function getRegister() {
		$date['days'] = $this->generateDays();
		$date['months'] = $this->generateMonths();
		$date['years'] = $this->generateYears();

		return view('register')->withDate($date);
	}


	public function postRegister(Request $request) {
		$inputs = $request->except('_token');
		$inputs['provider_id'] = Session::has('provider_id') ? Session::get('provider_id') : NULL;
		$inputs['provider_type'] = Session::has('provider_type') ? Session::get('provider_type') : NULL;
		$inputs['avatar'] = Session::has('avatar') ? Session::get('avatar') : NULL;
		$inputs['tanggal_lahir'] = Carbon::create($inputs['year'], $inputs['month'], $inputs['day'], 0)->toDateString();


		$validator = Validator::make($inputs, [
			'nama' => 'required|max:255',
			'provider_type' => 'in:tw,fb|required',
			'provider_id' => 'required|unique_with:users,provider_type',
			'email' => 'required|email|max:255',
			'day' => 'required|min:1|max:31',
			'month' => 'required|min:1|max:12',
			'year' => 'required|max:2015',
			'alamat' => 'required',
			'nomer_handphone' => 'required'
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		}

		$user = User::create([
			'nama' => $inputs['nama'],
			'provider_type' => $inputs['provider_type'],
			'provider_id' => $inputs['provider_id'],
			'avatar' => $inputs['avatar'],
			'tanggal_lahir' => $tanggal_lahir,
			'alamat' => $inputs['alamat'],
			'nomer_handphone' => $inputs['nomer_handphone'],
			'email' => $inputs['email']
			]);

		Auth::login($user);

		return redirect('/')->withSuccess('Welcome');
	}

	private function generateDays() {
		$temp[0] = "days";
		foreach(range(1, 31) as $n) {
			$temp[$n] = $n;
		}
		return $temp;
	}
	private function generateMonths() {
		$months[0] = "months";
		for($m=1; $m<=12; ++$m){
		    $months[$m] = date('F', mktime(0, 0, 0, $m, 1));
		};
		return $months;
	}
	private function generateYears() {
		$temp[0] = "years";
		foreach(range(2015, 1900) as $year) {
			$temp[$year] = $year;
		}
		return $temp;
	}







}
