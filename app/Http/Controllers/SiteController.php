<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SiteController extends Controller {

	
	public function index() {

		return view('index');
	}

	public function photo($id) {

		return view('photo');
	}

}
