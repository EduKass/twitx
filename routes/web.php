<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;

// Redirect the root URL to the home route
Route::get('/', function () {
    return redirect()->route('home');
});

// Authentication routes
Auth::routes();

// Home route to display posts
Route::get('/home', [PostController::class, 'index'])->name('home')->middleware('auth');

// Route to handle post creation
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

// Route to handle post deletion
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
