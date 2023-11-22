<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LikesController;

use Illuminate\Support\Facades\DB;

// Public routes
Route::get('/health', function () {
    return 'ok';
});

Route::get('/ping', function (Request $request) {    
    $connection = DB::connection('mongodb');
    $msg = 'MongoDB is accessible!';
    try {  
        $connection->command(['ping' => 1]);  
    } catch (\Exception $e) {  
        $msg = 'MongoDB is not accessible. Error: ' . $e->getMessage();
    }
    return ['msg' => $msg];
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Protected routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/authcheck', function () {
        return 'ok';
    });

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    
    Route::get('/users', [UsersController::class, 'index']);

    Route::get('/tweets', [TweetsController::class, 'index']);
    Route::get('/tweets/user/{userid}', [TweetsController::class, 'usertweets']);
    Route::post('/tweets', [TweetsController::class, 'store']);
    Route::get('/tweets/{id}', [TweetsController::class, 'show']);
    Route::put('/tweets/{id}', [TweetsController::class, 'update']);
    Route::delete('/tweets/{id}', [TweetsController::class, 'destroy']);

    Route::get('/followers', [FollowersController::class, 'index']);
    Route::get('/followers/{id}', [FollowersController::class, 'followers']);
    Route::post('/follow/{id}/{status}', [FollowersController::class, 'follow']); // 1 = follow, 0 = unfollow

    Route::get('/likes', [LikesController::class, 'index']);
    Route::get('/likes/{tweetid}', [LikesController::class, 'likes']);
    Route::post('/like/{tweetidid}/{status}', [LikesController::class, 'like']); // 1 = like, 0 = unlike
   
});
