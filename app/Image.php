<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{Profile, Post};

class Image extends Model
{
	protected $fillable = [
		'ruta',
	];

	protected $casts = [
		'ruta' => 'string',
	];

	public function profile()
	{
		return $this->hasOne(Profile::class);
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}