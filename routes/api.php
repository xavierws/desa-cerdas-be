<?php

use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\WisataController;
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

//route that doesn't use sanctum middleware
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [LoginController::class, 'show']);
    Route::post('/logout', [LoginController::class, 'destroy']);

    //user management
    Route::prefix('/user')->group(function () {
        Route::put('/update-email', [UserController::class, 'update']);
        Route::delete('/delete', [UserController::class, 'destroy']);
    });

    //Resident Profile Management
    Route::prefix('/resident')->group(function () {

    });
});

Route::get('/wisata', [WisataController::class, 'show']);
