<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Photo;
use \Input as Input;

class SiteController extends Controller {

	public function __construct() {

	}

	public function index() {
		$data['photos'] = Photo::paginate(3);
		return view('index')->with('data', $data);
	}

	public function showPhoto($id) {
		$photo = Photo::findOrFail($id);
		$uploader = $photo->uploader;

		$data['image'] = $photo['image'];
		$data['photo_id'] = $photo['id'];
		$data['deskripsi'] = $photo['deskripsi'];
		$data['totalLikes'] = $photo->likes->count();
		$data['nama_uploader'] = $uploader['nama'];
		$data['avatar_uploader'] = $uploader['avatar'];

		return view('photo')->with('data', $data);
	}

	public function uploadPhoto(Request $request) {
		dd(Input::hasFile('file'));
	}

}
