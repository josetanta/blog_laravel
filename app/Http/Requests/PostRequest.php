<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required|min:5|unique:posts,title,slug',
			'body' => 'required|min:20',
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
		];
	}

	public function messages()
	{
		return [
			'title.required' => 'Necesita un Titulo su Post',
			'body.required' => 'Al menos una breve introducción para su publicación',
		];
	}
}
