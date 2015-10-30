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

	public function photo($id) {
		
		return view('photo');
	}

	public function likePhoto() {

		$photo = Photo::findOrFail($id);
		if (! $photo->liked($myUserId)) {

			$photo->unlike();
		}else {

			$photo->like();
		}
	}

}
