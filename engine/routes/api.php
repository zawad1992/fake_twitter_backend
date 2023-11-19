<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetsController;

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
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);


    Route::get('/tweets', [TweetsController::class, 'index']);
    Route::post('/tweets', [TweetsController::class, 'store']);
    Route::get('/tweets/{id}', [TweetsController::class, 'show']);
    Route::put('/tweets/{id}', [TweetsController::class, 'update']);
    Route::delete('/tweets/{id}', [TweetsController::class, 'destroy']);
});
