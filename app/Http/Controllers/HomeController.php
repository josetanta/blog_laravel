<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller {

	public function __invoke(Request $request) {
		$posts = Post::all();
		return view('home', compact('posts'))->with('success', 'Welcome!!');
	}
}
