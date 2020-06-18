<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->string('title', 50);
			$table->text('body');
			$table->string('slug')
				->unique();
			$table->foreignId('image_id')
				->nullable()
				->constrained();
			$table->foreignId('user_id')
				->constrained()
				->onDelete('cascade');
			$table->boolean('state')->default(true);
			$table->unsignedInteger('visits')->default(0);
			$table->timestamps();
			$table->index(['title', 'image_id', 'user_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('posts');
	}
}
