<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LikesController extends Controller {


	private $currentId;
	public function __construct() {

		$this->currentId = Auth::user->id;
	}

	public function likeArticle(Article $article) {

		if (! $article->liked()) {
			$article->like();
		}else {
			$article->
		}

	}	

}

//if model hasn't been liked
	//like
//else
	//unlike