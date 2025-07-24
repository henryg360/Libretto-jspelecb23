<?php

use App\Http\Controllers\Api\AuthorApiController;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\GenreApiController;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\RegisterApiController;
use App\Http\Controllers\Api\ReviewApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginApiController::class, 'login']);
Route::post('/register', [RegisterApiController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('books', BookApiController::class);
    Route::apiResource('reviews', ReviewApiController::class);
    Route::apiResource('genres', GenreApiController::class);
    Route::apiResource('authors', AuthorApiController::class);

    // ✅ Custom routes to fetch only reviews or genres of a book
    Route::get('/books/{book}/reviews', [BookApiController::class, 'reviews']);
    Route::get('/books/{book}/genres', [BookApiController::class, 'genres']);
});
