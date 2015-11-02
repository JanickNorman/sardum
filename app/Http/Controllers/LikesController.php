<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input as Input;
use \Auth as Auth;
use App\Photo;
use App\Like;

use Illuminate\Http\Request;

class LikesController extends Controller {

	public function likePhoto(Request $request) {

		$like = new Like;

		$user = Auth::user();
		$id = Input::only('photo_id');

		$like->user_id = $user->id;
		$like->photo_id = $id;
		
		$like->save();

		//response angka
		return response()->json(['status' => 'success']);
	}	

	public function unlikePhoto() {

	    $user = Auth::user();
	    $id = Input::only('photo_id');

	    $like = Like::findOrFail($id);

	    $like->where('user_id', $user->id)->where('photo_id', $id)->firstOrFail()->delete();
	    
		return response()->json(['status' => 'success']);

	}

}

