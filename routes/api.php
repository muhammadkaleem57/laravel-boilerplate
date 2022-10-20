<?php

use App\Http\Controllers\Api;
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

Route::middleware('force-json')->group(function(){
    Route::prefix('auth')->as('.auth')->group(function (){
        Route::post('/register', [Api\AuthController::class, 'signup'])->name('signup');
        Route::post('/verify-account', [Api\AuthController::class, 'verifyAccount'])->name('verify.account');
        Route::post('/login', [Api\AuthController::class, 'login'])->name('login');
    });

    Route::middleware('auth:api')->group(function (){
        Route::get('/user', [Api\AuthController::class, 'user'])->name('user');
    });
});
