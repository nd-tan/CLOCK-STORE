<?php

use App\Http\Controllers\Admin\CategoryController;
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
Route::delete('/delete/{id}',[CategoryController::class,'force_destroy'])->name('category.delete');
Route::get('/getTrashed',[CategoryController::class,'getTrashed'])->name('category.getTrashed');
Route::get('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
Route::resource('category', CategoryController::class);
