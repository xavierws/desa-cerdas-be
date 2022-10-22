<?php

use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Controllers\api\infrastructure\InfrastrukturController;
use App\Http\Controllers\api\market\MerchantController;
use App\Http\Controllers\api\market\OrderController;
use App\Http\Controllers\api\market\ProductController;
use App\Http\Controllers\api\ResidentController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\api\facility\FasumController;
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
        Route::put('/update', [ResidentController::class, 'update']);
    });

    //Merchant Management
    Route::prefix('/merchant')->group(function () {
        Route::post('/store', [MerchantController::class, 'store']);
        Route::put('/update', [MerchantController::class, 'update']);
        Route::get('/list', [MerchantController::class, 'index']);
        Route::get('/', [MerchantController::class, 'showByMerchant']);
        Route::get('/{merchantId}', [MerchantController::class, 'show']);

        //only used by admin
        Route::put('/approve', [MerchantController::class, 'approve']);
    });

    //Product Management
    Route::prefix('/product')->group(function () {
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/list/{merchantId}', [ProductController::class, 'index']);
    });

    //Order Management
    Route::prefix('/order')->group(function () {
        Route::post('/checkout', [OrderController::class, 'store']);

        //used by merchant
        Route::post('/accept', [OrderController::class, 'acceptOrder']);
        Route::post('/reject', [OrderController::class, 'rejectOrder']);

        //used by buyer
        Route::post('/finish', [OrderController::class, 'finishOrder']);

        //show order
        Route::get('/show/{orderId}', [OrderController::class, 'show']);

        //list order for merchant
        //filter using status key
        Route::get('/merchant', [OrderController::class, 'indexByMerchant']);

        //list Order for resident
        //filter using status key
        Route::get('/resident', [OrderController::class, 'indexByResident']);
    });

    Route::prefix('/facility')->group(function () {
        Route::prefix('/category')->group(function () {
            Route::post('/store', [FasumController::class, 'storeCategory']);
            Route::post('/image/store', [FasumController::class, 'storeCategoryImage']);
            Route::get('/', [FasumController::class, 'indexCategory']);
            Route::put('/update', [FasumController::class, 'updateCategory']);
            Route::delete('/delete', [FasumController::class, 'destroyCategory']);
        });
    });
});

Route::get('/wisata', [WisataController::class, 'pageShow']);
Route::post('/wisata/store', [WisataController::class, 'pageStore']);

Route::get('/wisata/category', [WisataController::class, 'categoryList']);
Route::post('/wisata/category/store', [WisataController::class, 'categoryStore']);
Route::put('/wisata/category/update', [WisataController::class, 'categoryUpdate']);
Route::delete('/wisata/category/delete', [WisataController::class, 'categoryDelete']);

Route::get('/wisata/list', [WisataController::class, 'wisataList']);
Route::get('/wisata/list/{id}', [WisataController::class, 'wisataListEdit']);
Route::post('/wisata/list/store', [WisataController::class, 'wisataListStore']);
Route::put('/wisata/list/update', [WisataController::class, 'wisataListUpdate']);
Route::delete('/wisata/list/delete', [WisataController::class, 'wisataListDelete']);

Route::post('/wisata/images/store', [WisataController::class, 'wisataImagesStore']);
Route::put('/wisata/images/update', [WisataController::class, 'wisataImagesUpdate']);
Route::delete('/wisata/images/delete', [WisataController::class, 'wisataImagesDelete']);
Route::get('/wisata/images/{id}', [WisataController::class, 'wisataImagesList']);

Route::get('/infrastruktur/category', [InfrastrukturController::class, 'infrastrukturCategory']);
Route::post('/infrastruktur/category/store', [InfrastrukturController::class, 'infrastrukturStore']);
Route::put('/infrastruktur/category/update', [InfrastrukturController::class, 'infrastrukturUpdate']);
Route::delete('/infrastruktur/category/delete', [InfrastrukturController::class, 'infrastrukturDelete']);

Route::post('/infrastruktur/list', [InfrastrukturController::class, 'infrastrukturList']);
Route::post('/infrastruktur/list/store', [InfrastrukturController::class, 'infrastrukturListStore']);
Route::put('/infrastruktur/list/update', [InfrastrukturController::class, 'infrastrukturListUpdate']);
Route::delete('/infrastruktur/list/delete', [InfrastrukturController::class, 'infrastrukturListDelete']);
Route::get('/infrastruktur/list/{id}', [InfrastrukturController::class, 'infrastrukturListEdit']);

Route::get('/infrastruktur/images/{id}', [InfrastrukturController::class, 'infrastrukturImagesList']);
Route::post('/infrastruktur/images/store', [InfrastrukturController::class, 'infrastrukturImagesStore']);
Route::put('/infrastruktur/images/update', [InfrastrukturController::class, 'infrastrukturImagesUpdate']);
Route::delete('/infrastruktur/images/delete', [InfrastrukturController::class, 'infrastrukturImagesDelete']);
