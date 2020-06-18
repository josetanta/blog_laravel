<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Post $post)
	{
		$request->validate([
			'body' => 'required|min:10'
		],[
			'body.required' => "Por favor su comentario al menos debera tener 10 letras."
		]);

		Comment::create([
			'body' => $request['body'],
			'user_id' => auth()->user()->id,
			'post_id' => $post->id,
		]);
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Post $post, Comment $comment)
	{
		$request->validate([
			'body' => 'required|min:10'
		]);

		$comment->update([
			'body' => $request['body']
		]);
		return redirect()->route('posts.show', $post);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post,Comment $comment)
	{
		$comment->delete();
		return redirect()->route('posts.show', $post)->with('info','Elimino su comentario.');
	}
}
