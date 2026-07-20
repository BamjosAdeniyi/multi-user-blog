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
        ->middleware('auth')
        ->name('posts.publish');

Route::patch('/posts/{post}/unpublish', [PostController::class, 'unpublish'])
    ->middleware('auth')
    ->name('posts.unpublish');
    
// Resource Route with authentication through middleware
Route::resource('posts', PostController::class)
    ->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
