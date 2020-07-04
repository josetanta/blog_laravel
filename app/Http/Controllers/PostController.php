<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;
use App\{Image, Post, Comment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Storage};
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image as ImageFacade;

class PostController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth')->except(['show']);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\PostRequest $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostRequest $request)
	{
		$post = new Post;
		$data = $request->all();

		if ($request->hasFile('image')) {
			$image = $request->file('image');
			$data['image'] = time() . '.' .$image->extension();

			$resize_img = ImageFacade::make($image->getRealPath())
				->resize(500,500, function ($constraint)
					{
						$constraint->aspectRatio();
					}
				)->save(storage_path('app/public/uploads/posts/' . $data['image']));

			$new_image = Image::create(['ruta' => 'uploads/posts/'.$data['image']]);
			$post->image_id = $new_image->id;
		}

		$post->title = $data['title'];
		$post->body = $data['body'];
		$post->user_id = auth()->id();
		$post->slug = Str::slug($data['title']);
		$post->save();
		return redirect()->route('posts.show',$post);
	}

	/**
	 * Display the specified resource.
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
		return view('posts.show', [
			'post' => $post,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Post $post)
	{
		return view('posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function update(PostRequest $request, Post $post)
	{
		$data = $request->all();
		if ($request->hasFile('image')) {

			if(isset($post->image->ruta)){
				Storage::delete('public/' . $post->image->ruta);
			}

			$image = $request->file('image');
			$data['image'] = time() . '.' .$image->extension();

			$resize_img = ImageFacade::make($image->getRealPath())
				->resize(500,500, function ($constraint)
					{
						$constraint->aspectRatio();
					}
				)->save(storage_path('app/public/uploads/posts/' . $data['image']));

			$new_image = Image::create(['ruta' => 'uploads/posts/'.$data['image']]);
			$post->image_id = $new_image->id;
		}

		$post->update([
			'title' => $request['title'],
			'body' => $request['body'],
		]);
		return redirect()->route('posts.show',$post)->with('success','Se actualizo tu Post');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect()->route('home');
	}
}
