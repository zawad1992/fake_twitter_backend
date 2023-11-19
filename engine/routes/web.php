<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerMongoDB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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

Route::get('/unauthorized', function (Request $request) {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('unauthorized');


Route::get('/create_eloquent_mongo/', function (Request $request) {
    $success = CustomerMongoDB::create([
    'guid'=> 'cust_1111',
    'first_name'=> 'John',
    'family_name' => 'Doe',
    'email' => 'j.doe@gmail.com',
    'address' => '123 my street, my city, zip, state, country'
    ]);
});

