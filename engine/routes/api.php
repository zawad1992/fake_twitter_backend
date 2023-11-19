<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetsController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Protected routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);


    Route::get('/tweets', [TweetsController::class, 'index']);
    Route::post('/tweets', [TweetsController::class, 'store']);
    Route::get('/tweets/{id}', [TweetsController::class, 'show']);
    Route::put('/tweets/{id}', [TweetsController::class, 'update']);
    Route::delete('/tweets/{id}', [TweetsController::class, 'destroy']);
});
