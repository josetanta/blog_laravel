<?php

use Illuminate\Database\Seeder;
use App\{User, Profile, Image, Role};
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Role::truncate();
    User::truncate();
    Role::generate_roles();
    // Admin
    $admin = User::create([
      'name' => 'Admin',
      'surname' => 'Admin 1',
      'email' => 'admin@blogadmin.com',
      'password' => bcrypt('admin'),
      'slug' => Str::snake('Admin Admin 1'),
    ]);
    $admin->roles()->attach([3,2,1]);
    $image = Image::create([
      'ruta' => 'default.jpg',
    ]);
    Profile::create([
      'user_id' => $admin->id,
      'image_id' => $image->id,
      'slug' => $admin->generateSlug(),
    ]);

     // Moderator
    $moderator = User::create([
      'name' => 'Moderator',
      'surname' => 'Moderator 1',
      'email' => 'mode@blog.com',
      'password' => bcrypt('admin'),
      'slug' => Str::snake('Moderator Moderator 1'),
    ]);
    $moderator->roles()->attach([2,1]);
    Profile::create([
      'user_id' => $moderator->id,
      'image_id' => $image->id,
      'slug' => $moderator->generateSlug(),
    ]);

    // User
    $user1 = User::create([
      'name' => 'User 1',
      'surname' => 'Profile 1',
      'email' => 'user1@blog.com',
      'password' => bcrypt('admin'),
      'slug' => Str::snake('User 1 Profile 1'),
    ]);
    $user1->roles()->attach(1);
    Profile::create([
      'user_id' => $user1->id,
      'image_id' => $image->id,
      'slug' => $user1->generateSlug(),
    ]);
  }
}
