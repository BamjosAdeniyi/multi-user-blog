<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route for showing user's post: Post Dashboard
Route::get('/my-posts', [PostController::class, 'myPosts'])
    ->middleware('auth')
    ->name('posts.mine');

// An extra route for publishing
Route::patch('posts/{post}/publish', [PostController::class, 'publish'])
        ->middleware(['auth', 'verified'])
        ->name('posts.publish');

Route::patch('/posts/{post}/unpublish', [PostController::class, 'unpublish'])
    ->middleware('auth')
    ->name('posts.unpublish');

// Resource Route with authentication through middleware
Route::resource('posts', PostController::class)
    ->middleware('auth')
    ->except(['index', 'show']); // Making posts available to user for viewing and reading

// Public routes for index and show, they both do not have authentication/middleware attached
Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
