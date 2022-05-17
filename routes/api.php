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
        Route::put('/update-password', [UserController::class, 'updatePassword']);
    });

    //Resident Profile Management
    Route::prefix('/resident')->group(function () {
        Route::put('/update', [\App\Http\Controllers\api\ResidentController::class, 'update']);
    });
});

Route::get('/wisata', [WisataController::class, 'pageShow']);
Route::post('/wisata/store', [WisataController::class, 'pageStore']);

Route::get('/wisata/category', [WisataController::class, 'categoryList']);
Route::post('/wisata/category/store', [WisataController::class, 'categoryStore']);
Route::put('/wisata/category/update', [WisataController::class, 'categoryUpdate']);
Route::delete('/wisata/category/delete', [WisataController::class, 'categoryDelete']);

Route::get('/wisata/list', [WisataController::class, 'wisataList']);
Route::post('/wisata/list/store', [WisataController::class, 'wisataListStore']);
Route::put('/wisata/list/update', [WisataController::class, 'wisataListUpdate']);
Route::delete('/wisata/list/delete', [WisataController::class, 'wisataListDelete']);

Route::get('/wisata/images/{id}', [WisataController::class, 'wisataImagesList']);
Route::post('/wisata/images/store', [WisataController::class, 'wisataImagesStore']);
Route::put('/wisata/images/update', [WisataController::class, 'wisataImagesUpdate']);
Route::delete('/wisata/images/delete', [WisataController::class, 'wisataImagesDelete']);




