<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\{User, Role, Image, Profile};
use Illuminate\Support\Facades\Auth;

class UserModuleTest extends TestCase
{
	use RefreshDatabase;

	/**
	*@test
	*/
	function it_index_admin_users_in_index()
	{
			$this->withoutExceptionHandling();
			Role::generate_roles();

			$admin = User::create([
				'email' => 'jose@mail.com',
				'surname' => 'g',
				'name' => 'jose 1',
				'slug' => 'jose-1',
				'password' => bcrypt('user'),
			]);
			$admin->roles()->attach([1,2,3]);

			$this->actingAs($admin);

			$u = factory(User::class)->create(
				['name' => 'user 1']
			);
			$u->roles()->attach(1);

			$this->get(route('admin.users.index'))
					->assertStatus(302);
	}

	/**
	*@test
	*/
	function it_registrations_user_in_webapp(){
		// $this->withoutExceptionHandling();
		Role::generate_roles();
		$user = factory(User::class)
					->create([
						'name' => 'user1',
						'email' => 'user1@gmail.com',
						]);
		$image = Image::create();
		$user->createProfile($image);

		$this->post('register',[$user])
			->assertRedirect(route('home'));

		$this->assertDatabaseHas('users', [
			'name' => 'user1',
			'email' => 'user1@gmail.com',
		]);
	}

/**
*@test
*/
function it_validate_email_in_registration_user(){
	// $this->withoutExceptionHandling();
		Role::generate_roles();
		$user = factory(User::class)
					->create([
				'name' => 'user1',
				'email' => '',
				'password' => '12345d',

			]);
		$this->from('register')
			->post('register',[$user])
			->assertRedirect(route('register'))
			->assertSessionHasErrors(['email']);

		// $this->assertEquals(0, User::count());
}

 /**
 *@test
 */
 function it_validate_name_in_registrations_user(){
		Role::generate_roles();
		$user = factory(User::class)
					->create([
				'name' => 'user1',
				'email' => '',
				'password' => '12345d',

			]);

		$this->from('register')
			->post('register',[$user])
			->assertRedirect(route('register'))
			->assertSessionHasErrors(['name']);
 }
}
