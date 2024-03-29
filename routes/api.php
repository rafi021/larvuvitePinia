<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


Route::controller(AuthController::class)->prefix('v1/auth')->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
