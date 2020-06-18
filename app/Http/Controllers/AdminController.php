<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Providers\RouteServiceProvider;
use App\{User, Post};
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('admin');
	}

	public function dashboard(){
		return view('admin.dashboard.dashboard');
	}

	public function indexUsers()
	{
		$users = User::all();
		return view('admin.users.index', compact('users'));
	}

  public function indexPosts()
  {
    $posts = Post::all();
    return view('admin.posts.index', compact('posts'));
  }

  public function indexComments()
  {

  	return view('admin.comments.index',[
  		'comments' => Comment::all(),
  	]);
  }
}
