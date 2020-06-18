<?php

namespace App;

use App\Image;
use App\{Role, Profile, Post, Comment};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'surname',
		'password',
		'slug',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',

	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'surname' => 'string',
		'name' => 'string',
		'slug' => 'string',
	];

	public function roles()
	{
		return $this->belongsToMany(Role::class)->withPivot('role_id');
	}

	public function is_admin()
	{

		if ($this->roles[0]->id === 2 || $this->roles[0]->id === 3)
			return true;
		else
			return false;
	}

	public function profile()
	{
		return $this->hasOne(Profile::class);
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function createProfile(Image $image)
	{
		$this->profile()->create([
			'user_id' => $this,
			'image_id' => $image->id,
			'slug' => $this->generateSlug(),
		]);
	}

	public function generateSlug()
	{
		return Str::snake($this->name . ' ' . $this->surname);
	}
}
