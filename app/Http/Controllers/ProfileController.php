<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\ProfileRequest;
use App\{Profile, Image};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Profile  $profile
	 * @return \Illuminate\Http\Response
	 */
	public function show(Profile $profile)
	{
		$posts = $profile->user->posts;
		return view('auth.profiles.show',[
			'profile' => $profile,
			'posts' => $posts,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Profile  $profile
	 * @return \Illuminate\Http\Response
	 */

	public function edit(Profile $profile)
	{
		if (Auth::user()->id === $profile->user_id) {
			return view('auth.profiles.edit', compact('profile'));
		}
		return back();
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\ProfileRequest;  $request
	 * @param  \App\Profile  $profile
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProfileRequest $request, Profile $profile)
	{

		$data  = $request->all();
		// Poner el campo del Modelo Profile(en este caso es image_id)
		if($request->hasFile('image')){
			Storage::delete('public/' . $profile->image->ruta);
			$data['image'] = $request->file('image')->store('uploads/profiles','public');
			$new_image = Image::create(['ruta' => $data['image']]);
			$profile->image_id = $new_image->id;
		}

		$profile->update($data,['slug' => auth()->user()->slug]);

		return redirect()->route('account.show', $profile)->with('success', 'Actualizaste tu Perfil');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Profile  $profile
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Profile $profile)
	{
		//
	}
}
