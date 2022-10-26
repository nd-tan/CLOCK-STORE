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
Route::prefix('categories')->group(function(){
    Route::get('/',[CategoryController::class,'index'])->name('category.index');
    ////add
    Route::get('/add',[CategoryController::class,'create'])->name('category.add');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    ///edit
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('/update/{id}',[CategoryController::class,'update'])->name('category.update');
    ////xóa
    Route::delete('/delete/{id}',[CategoryController::class,'force_destroy'])->name('category.delete');
    /////xóa mềm
    Route::delete('/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
    Route::get('/getTrashed',[CategoryController::class,'getTrashed'])->name('category.getTrashed');
    Route::get('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
});
