<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{Post, User};

class Comment extends Model
{
	protected $fillable = [
		'body',
		'user_id',
		'post_id',
	];

	protected $casts = [
		'user_id' => 'integer',
		'post_id' => 'integer',
		'body' => 'text',
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
