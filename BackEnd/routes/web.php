<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;

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
    return view('admin.home');
});
Route::get('/cate', function () {
    return view('admin.categories.index');
});
Route::resource('category', CategoryController::class);
Route::get('/getTrashed',[CategoryController::class,'getTrashed'])->name('category.getTrashed');
Route::delete('/delete/{id}',[CategoryController::class,'force_destroy'])->name('category.delete');
Route::get('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');

Route::resource('supplier', SupplierController::class);
Route::delete('/delete/{id}',[SupplierController::class,'force_destroy'])->name('supplier.delete');
Route::get('/getTrashed',[SupplierController::class,'getTrashed'])->name('supplier.getTrashed');
Route::get('/restore/{id}',[SupplierController::class,'restore'])->name('supplier.restore');
