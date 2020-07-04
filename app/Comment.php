<?php

namespace App;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
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

	public function post() {
		return $this->belongsTo(Post::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
