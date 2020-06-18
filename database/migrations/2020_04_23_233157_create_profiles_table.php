<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();
      $table->string('direccion', 60)->nullable();
      $table->text('historial')->nullable();
      $table->foreignId('user_id')
        ->constrained()
        ->onDelete('cascade');
      $table->foreignId('image_id')
        ->constrained();
      $table->string('slug')
        ->unique();
      $table->timestamps();
      $table->index(['image_id', 'user_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('profiles');
  }
}
