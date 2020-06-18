<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{User, Image};

class Post extends Model
{
	protected $fillable = [
		'title',
		'body',
		'user_id',
		'image_id',
		'slug'
	];

	protected $casts = [
		'title' => 'string',
		'body' => 'text',
		'user_id' => 'integer',
		'image_id' => 'integer',
		'slug' => 'string',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function image()
	{
		return $this->belongsTo(Image::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
