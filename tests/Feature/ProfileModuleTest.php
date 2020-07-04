<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\{Role, User, Image, Profile};

class ProfileModuleTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 */
	function it_create_profile_when_register_user()
	{

		Role::generate_roles();

		$user = factory(User::class)->create();
		$image = Image::create();
		$user->createProfile($image);

		$this->assertDatabaseHas('users', [
			'name' => $user->name,
			'email' => $user->email
		]);

		$this->assertEquals(1, Profile::count());
		$this->assertEquals(1, User::count());
	}

	/**
	 * @test
	 */
	function it_update_profile()
	{

		Role::generate_roles();

		$user = factory(User::class)->create();
		$image = Image::create();
		$user->createProfile($image);

		$this->assertEquals(1, Profile::count());
		$this->assertEquals(1, User::count());
	}
}
