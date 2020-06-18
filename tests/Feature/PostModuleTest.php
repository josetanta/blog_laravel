<?php

namespace Tests\Feature;

use App\{Post, Image, Profile, User, Role};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostModuleTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * @test
	 */
	function it_show_all_posts()
	{
		Role::generate_roles();

		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);

		$post = factory(Post::class)->create([
			'user_id' => $auth->id
		]);

		$this->get(route('home'))
			->assertStatus(200)
			->assertSee($post->title)
			->assertSee($auth->name);
	}

	/**
	 * @test
	 */
	function show_a_post_created_for_author()
	{

		// $this->withoutExceptionHandling();

		Role::generate_roles();

		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);

		$post = factory(Post::class)->create([
			'user_id' => $auth->id,
		]);

		$this->actingAs($auth)
			->withSession(['email' => $auth->email])
			->get(route('posts.show', $post))
			->assertSee($post->title);
	}

	/**
	* @test
	*/
	function it_delete_a_post_for_user_creator()
	{
		$this->withoutExceptionHandling();
		Role::generate_roles();
		$auth = factory(User::class)->create();
		$image = Image::create();
		$auth->createProfile($image);

		$this->actingAs($auth);

		$post1 = factory(Post::class)->create([
			'user_id' => $auth->id
		]);
		$this->from(route('posts.show', $post1))
				->delete(route('posts.destroy',$post1))
				->assertStatus(302)
				->assertRedirect(route('home'));
	}

	/**
	 * @test
	*/
	function it_update_a_post_for_user()
	{
		// $this->withoutExceptionHandling();
		Role::generate_roles();
		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);
		$this->actingAs($auth);

		$post = factory(Post::class)->create([
			'user_id' => $auth->id,
		]);

		$this->from(route('posts.edit', $post))
			->put(route('posts.update', $post), [
				'title' => 'Post Update from User',
				'body' => 'Este es el contenido del post',
			])->assertRedirect(route('posts.show', $post));

		$this->assertDatabaseHas('posts', [
			'title' => 'Post Update from User',
			'body' => 'Este es el contenido del post',
		]);
	}

	/**
	 * @test
	*/
	function it_validated_title_a_created_a_post()
	{
		// $this->withoutExceptionHandling();
		Role::generate_roles();
		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);

		$this->actingAs($auth)
			->from(route('auth.posts.create',$auth))
			->post(route('auth.posts.store', $auth),[
				'title' => 'ti',
				'body' => 'Este es mi post creado sin titulo',
			])->assertSessionHasErrors(['title'])
				->assertRedirect(route('auth.posts.create',$auth));

	}
	/**
	 * @test
	*/
	function it_validated_body_a_created_a_post()
	{
		// $this->withoutExceptionHandling();
		Role::generate_roles();
		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);

		$this->actingAs($auth)
			->from(route('auth.posts.create',$auth))
			->post(route('auth.posts.store', $auth),[
				'title' => 'Title Post',
				'body' => '',
			])->assertSessionHasErrors(['body'])
				->assertRedirect(route('auth.posts.create',$auth));

	}
	/**
	 * @test
	*/
	function it_validated_title_and_body_a_created_a_post()
	{
		// $this->withoutExceptionHandling();
		Role::generate_roles();
		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);

		$this->actingAs($auth)
			->from(route('auth.posts.create',$auth))
			->post(route('auth.posts.store', $auth),[
				'title' => '',
				'body' => '',
			])->assertSessionHasErrors(['title','body'])
				->assertRedirect(route('auth.posts.create',$auth));
	}

	/**
	 * @test
	*/
	function it_validated_image_a_created_a_post()
	{
		// $this->withoutExceptionHandling();
		Role::generate_roles();
		$auth = factory(User::class)->create();
		$image = Image::create();

		$auth->createProfile($image);

		$this->actingAs($auth)
			->from(route('auth.posts.create',$auth))
			->post(route('auth.posts.store', $auth),[
				'title' => 'Post with Image',
				'body' => 'This is post with Image',
			])->assertSessionHasErrors(['image'])
				->assertRedirect(route('auth.posts.create',$auth));
	}

}