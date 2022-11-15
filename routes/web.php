<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', HomeController::class)->name('home');

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'store');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store');
    Route::post('/logout', 'destroy')->name('logout');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/edit-profile', 'index')->name('profile.index');
    Route::post('/edit-profile', 'store')->name('profile.store');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts/create', 'create')->name('post.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/{user:username}/posts/{post}', 'show')->name('posts.show');
    Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    Route::get('/{user:username}', 'index')->name('post.index');
});

Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comments.store');

Route::post('/images', [ImageController::class, 'store'])->name('images.store');

Route::controller(LikeController::class)->group(function () {
    Route::post('/posts/{post}/likes', 'store')->name('posts.likes.store');
    Route::delete('/posts/{post}/likes', 'destroy')->name('posts.likes.destroy');
});

Route::controller(FollowerController::class)->group(function () {
    Route::post('/{user:username}/follow', 'store')->name('users.follow');
    Route::delete('/{user:username}/unfollow', 'destroy')->name('users.unfollow');
});
