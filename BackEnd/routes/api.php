<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('list-cart', [CartController::class, 'getAllCart']);
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::get('remove-to-cart/{id}', [CartController::class, 'removeToCart']);
Route::get('remove-all-cart', [CartController::class, 'removeAllCart']);
Route::get('update-cart/{id}/{quantity}', [CartController::class, 'updateCart']);

Route::get('order/create', [OrderController::class, 'create']);
Route::get('order/list-province', [OrderController::class, 'getAllProvince']);
Route::get('order/list-district/{id}', [OrderController::class, 'getAllDistrictByProvinceId']);
Route::get('order/list-ward/{id}', [OrderController::class, 'getAllWardByDistrictId']);
Route::post('order/store', [OrderController::class, 'store']);
Route::get('order/show/{id}', [OrderController::class, 'show']);

Route::get('order/show/{id}', [ProductController::class, 'show']);
