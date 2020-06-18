<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class HomeController extends Controller
{

	public function __invoke(Request $request)
	{
		$posts = Post::all();
		return view('home', compact('posts'))->with('success', 'Welcome!!');
	}
}
