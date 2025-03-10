<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::middleware('auth:sanctum')->group(function () {
    // Posts endpoints
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/following', [PostController::class, 'following']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}/liked', [PostController::class, 'checkLiked']);

    // Likes endpoints
    Route::post('/posts/{post}/likes', [PostController::class, 'like']);
    Route::delete('/posts/{post}/likes', [PostController::class, 'unlike']);

    // Comments endpoints
    Route::post('/posts/{post}/comments', [PostController::class, 'comment']);
    Route::delete('/comments/{comment}', [PostController::class, 'deleteComment']);

    // Users endpoints
    Route::get('/users', [UserController::class, 'index']);
//});
