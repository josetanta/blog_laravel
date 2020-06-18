<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController')->name('home');
// Rutas para los administradores
Route::prefix('admin')->name('admin.')->group(function () {
	Route::get('dashboard','AdminController@dashboard')->name('dashboard');
	Route::get('users', 'AdminController@indexUsers')->name('users.index');
  Route::get('posts', 'AdminController@indexPosts')->name('posts.index');
  Route::get('comments', 'AdminController@indexComments')->name('comments.index');

	Route::resource('posts','PostController')
		->except(['index','create','store','update']);

	Route::resource('profile','ProfileController')
		->except(['index','create','store','update']);

	Route::resource('comments','CommentController')
		->except(['index','create','store','update']);
});

// Route for User registrados
Route::prefix('auth')->group(function () {
  Route::get('account/{profile:slug}', 'ProfileController@show')->name('account.show');
  Route::get('account/{profile:slug}/edit', 'ProfileController@edit')->name('account.edit');
	Route::put('account/{profile:slug}','ProfileController@update')->name('account.update');
});

// Routes for Posts created for User(Auth)
Route::resource('auth.posts', 'PostController')
  ->shallow()
  ->parameters([
      'auth' => 'user:slug'
    ])
	->except(['index','show','edit']);
Route::get('posts/{post:slug}','PostController@show')
	->name('posts.show');
Route::get('posts/{post:slug}/edit','PostController@edit')
	->name('posts.edit');

Route::resource('posts.comments', 'CommentController')
	->parameters([
		'posts' => 'post:slug',
		'comments' => 'comment'
	])
	->only(['store','update','destroy']);


Route::post('message','MessagesController@send')
	->name('message.send');
Route::get('message','MessagesController@show')
	->name('message.show');

Auth::routes();
