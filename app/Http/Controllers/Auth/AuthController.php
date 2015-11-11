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

	public function loginSocial($provider) {
		if (!$provider) return redirect('/');

		return Socialize::driver($provider)->redirect();
	}

	public function callbackSocial($provider) {

		$user = Socialize::driver($provider)->user();

		//kalo ada langsung login
		$existingUser = User::where('provider_type', $this->getProviderType($provider))->where('provider_id', (string) $user->id)->first();

		if ($existingUser) {
			$this->auth->login($existingUser);
			return redirect('/')->withSuccess('hello', $this->auth->user()->nama);
		}

		$data = [
			'nama' => $user->name,
			'provider_type' => $this->getProviderType($provider),
			'provider_id' => $user->id,
			'avatar' => isset($user->avatar) ? $user->avatar : " ",
			'email' => isset($user->email) ? $user->email : " "
		];
		Session::put('dataUser', $data);

		return redirect()->route('get.register');

	}

	private function getProviderType($provider) {
		if ($provider == 'twitter') {
			return 'tw';
		}else if ($provider == 'facebook') {
			return 'fb';
		}else {
			return false;
		}
	}

	public function getRegister() {
		$data = Session::get('dataUser');
		if (!$data) return redirect('/');


		$tanggal['days'] = $this->generateDays();
		$tanggal['months'] = $this->generateMonths();
		$tanggal['years'] = $this->generateYears();

		return view('register')->with('date', $tanggal)->with('data', $data);
	}


	public function postRegister(Request $request) {

		//dd($request['provider_id'] != Session::get('dataUser.provider_id'), $request['provider_type'], Session::get('dataUser.provider_type'));
		dd($request);
		//cek sama session supaya nolak kalo provider_id dan provider_typenya diutak-atik
		if ($request['provider_id'] != Session::get('dataUser.provider_id') && $request['provider_type'] != Session::get('dataUser.provider_type')) return redirect('/register');

		//quick test
		//$v = Validator::make(['date' => '2009-2-22'], ['date' => 'date_format:"Y-m-d"']);
		//var_dump( $v->passes() );

		//validasi dan bikin tanggal lahir
		$validasiTanggal = Validator::make($request->only(['day', 'month', 'year']), [
			'day' => 'required|digits_between:1,31',
			'month' => 'required|digits_between:1,12',
			'year' => 'required|integer|min:1900'
		]);

		if ($validasiTanggal->fails()) {
			return redirect('/register')->back()->withErrors($validasiTanggal);
		}

		$request['tanggal_lahir'] = Carbon::create($request['year'], $request['month'], $request['day'], 0)->toDateString();

		//$request['tanggal_lahir'] = '11/11/2004';
		$validator = Validator::make($request->except('_token'), [
			'nama' => 'required|max:255',
			'provider_type' => 'in:tw,fb|required',
			'provider_id' => 'required|unique_with:users,provider_type',
			'tanggal_lahir' => 'date_format:"Y-m-d"',
			'alamat' => 'required',
		]);

		dd($request->all());

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		}

		$user = User::create([
			'nama' => $request['nama'],
			'provider_type' => $request['provider_type'],
			'provider_id' => $request['provider_id'],
			'avatar' => $request['avatar'],
			'tanggal_lahir' => $request['tanggal_lahir'],
			'alamat' => $request['alamat'],
			'nomer_handphone' => $request['nomer_handphone'],
			'email' => $request['email']
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
