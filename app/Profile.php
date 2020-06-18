<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Image;

class Profile extends Model
{
	protected $fillable = [
		'direccion',
		'historial',
		'user_id',
		'image_id',
		'slug',
	];

	protected $casts = [
		'direccion' => 'string',
		'historial' => 'text',
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
}
