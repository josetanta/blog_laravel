<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\{User, Image, Role};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CommentModuleTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * @test
	 */
	function it_create_comment_in_post()
	{
		$this->withoutExceptionHandling();

		Role::generate_roles();

		$auth = factory(User::class)->create();
		$image = Image::create();
		$auth->createProfile($image);

		$this->actingAs($auth);

		$post = $auth->posts()->create([
			'title' => 'Post 1',
			'body' => 'This is content Post 1',
			'slug' => Str::slug('Post 1'),
		]);

		$this->assertDatabaseHas('posts', [
			'title' => 'Post 1',
			'slug' => 'post-1',
		]);

		$this->from(route('posts.show', $post))
			->post(route('posts.comments.store', $post), [
				'body' => 'Este es un comentario',
				'post_id' => $post->id,
				'user_id' => $auth->id,
			])
			->assertStatus(302)
			->assertRedirect(route('posts.show', $post));
	}

	/**
	 *@test
	 */
	function it_delete_comment_for_author_of_comment()
	{
		$this->withoutExceptionHandling();
		Role::generate_roles();

		$auth = factory(User::class)->create();
		$image = Image::create();
		$auth->createProfile($image);

		$this->actingAs($auth);

		$post = $auth->posts()->create([
			'title' => 'Post 1',
			'body' => 'This is content Post 1',
			'slug' => Str::slug('Post 1'),
		]);

		$comment = factory(Comment::class)->create([
			'user_id' => $auth->id,
			'post_id' => $post->id,
		]);
		$this->assertDatabaseHas('comments', [
			'body' => $comment->body
		]);
		$this->from(route('posts.show', $post))
			->delete(route('posts.comments.destroy', ['post' => $post, 'comment' => $comment]))
			->assertStatus(302)
			->assertRedirect(route('posts.show', $post));
	}

	/**
	 *@test
	 */
	function it_update_comment_from_post()
	{
		// $this->withoutExceptionHandling();
		Role::generate_roles();

		$auth = factory(User::class)->create();
		$image = Image::create();
		$auth->createProfile($image);

		$this->actingAs($auth);

		$post = $auth->posts()->create([
			'title' => 'Post 1',
			'body' => 'This is content Post 1',
			'slug' => Str::slug('Post 1'),
		]);

		$comment = factory(Comment::class)->create([
			'user_id' => $auth->id,
			'post_id' => $post->id,
		]);
		$this->assertDatabaseHas('comments', [
			'body' => $comment->body
		]);
		$this->from(route('posts.show', $post))
			->put(route('posts.comments.update', ['post' => $post, 'comment' => $comment]), [
				'body' => 'Se actualizo el Comentari de este Post'
			])
			->assertStatus(302)
			->assertSessionHasNoErrors()
			->assertRedirect(route('posts.show', $post));
	}
	/**
	 *@test
	 */
	function it_has_error_the_comment_validated_body()
	{
		$auth = factory(User::class)->create();
		$image = Image::create();
		$auth->createProfile($image);

		$this->actingAs($auth);

		$post = $auth->posts()->create([
			'title' => 'Post 1',
			'body' => 'This is content Post 1',
			'slug' => Str::slug('Post 1'),
		]);

		$this->from(route('posts.show', $post))
			->post(route('posts.comments.store', $post), [
				'body' => ''
			])
			->assertRedirect(route('posts.show', $post))
			->assertSessionHasErrors(['body']);
	}
}
