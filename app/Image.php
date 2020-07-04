<?php

namespace App;

use App\Post;
use App\Profile;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
	protected $fillable = [
		'ruta',
	];

	protected $casts = [
		'ruta' => 'string',
	];

	public function profile() {
		return $this->hasOne(Profile::class);
	}

	public function post() {
		return $this->belongsTo(Post::class);
	}
}