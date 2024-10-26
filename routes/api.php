<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;


Route::apiResource('animes', AnimeController::class);
    
// Пользователи
Route::apiResource('users', UserController::class)->except(['store', 'destroy']);
Route::post('users/{user}/lists/{listType}', [UserController::class, 'addToList']);
Route::delete('users/{user}/lists/{listType}', [UserController::class, 'removeFromList']);

// Комментарии
Route::get('animes/{anime}/comments', [CommentController::class, 'index']);
Route::post('animes/{anime}/comments', [CommentController::class, 'store']);
Route::put('comments/{comment}', [CommentController::class, 'update']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);


// Route::middleware('auth:sanctum')->group(function () {
//     // Аниме
//     Route::apiResource('animes', AnimeController::class);
    
//     // Пользователи
//     Route::apiResource('users', UserController::class)->except(['store', 'destroy']);
//     Route::post('users/{user}/lists/{listType}', [UserController::class, 'addToList']);
//     Route::delete('users/{user}/lists/{listType}', [UserController::class, 'removeFromList']);
    
//     // Комментарии
//     Route::get('animes/{anime}/comments', [CommentController::class, 'index']);
//     Route::post('animes/{anime}/comments', [CommentController::class, 'store']);
//     Route::put('comments/{comment}', [CommentController::class, 'update']);
//     Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
// });


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
