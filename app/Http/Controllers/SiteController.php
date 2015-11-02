<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SiteController extends Controller {

	public function __construct() {
		
	}

	public function index() {
		$data['tes'] = "haia";
		return view('index')->with($data, 'data');
	}

	public function showPhoto($id) {
		return view('photo');
	}

	public function uploadPhoto(Request $request) {
		dd(\Input::hasFile('photo'));
	}

}
