<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input as Input;
use \Auth as Auth;
use \Session as Session;
use App\Photo;
use App\Like;
use \Validator as Validator;

use Illuminate\Http\Request;

class LikesController extends Controller {
 
	public function likePhoto(Request $request) {
		$input['user_id'] = Auth::user()->id;
		$input['photo_id'] = (int) $request['photo_id'];

		$validator = Validator::make($input, [
				'user_id' => 'required|min:1',
				'photo_id' => 'required|min:1'
		]);
		return "NYAMPE";

		if ($validator->fails()) {
			return response()->json('status' => 'bad input');
		} 
		return "NYAMPE";

		$like = Like::where('user_id', $user_id)->where('photo_id', $photo_id)->first();

		if ($like) {
			return redirect()->action('unlike/photo')->with('photo_id', $photo_id);
		}

		$like = new Like;
		$like->user_id = $user_id;
		$like->photo_id = $photo_id;
		$like->save();

		if ($request->ajax()) {
 			return response()->json([
 					'status' => 'success',
 					'article_likes' => $user_id
 				]);
		}


		return redirect('/')->back();
	}	

	public function unlikePhoto(Request $request) {

		// $user_id = Auth::user()->id;
	 //    $photo_id = Session::has('photo_id') ? Session::get('photo_id') : $request['photo_id'];

	 //    return $photo_id;
	 //    $like = Like::where('user_id', $user_id)->where('photo_id', $photo_id)->first();

	 //    $like = new Like;
	 //    $like->where('user_id', $user->id)->where('photo_id', $photo_id)->firstOrFail()->delete();
	    
		return response()->json(['status' => 'success']);
	}

}

