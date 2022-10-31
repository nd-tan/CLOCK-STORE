<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\HomeController;
use App\Exports\OrderDetailsExport;
use App\Exports\OrdersExport;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('admin.home');
// })->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');

Route::prefix('/')->middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('customer', CustomerController::class);
    Route::delete('/delete/{id}', [CategoryController::class, 'force_destroy'])->name('category.delete');
    Route::get('/getTrashed', [CategoryController::class, 'getTrashed'])->name('category.getTrashed');
    Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category/getTrashed', 'getTrashed')->name('category.getTrashed');
        Route::delete('category/delete/{id}', 'force_destroy')->name('category.delete');
        Route::get('category/restore/{id}', 'restore')->name('category.restore');
    });
    Route::resource('category', CategoryController::class);

    Route::controller(SupplierController::class)->group(function () {
        Route::delete('supplier/delete/{id}', 'force_destroy')->name('supplier.delete');
        Route::get('supplier/getTrashed', 'getTrashed')->name('supplier.getTrashed');
        Route::get('supplier/restore/{id}', 'restore')->name('supplier.restore');
    });
    Route::resource('supplier', SupplierController::class);

    Route::controller(BrandController::class)->group(function () {
        Route::delete('brand/delete/{id}', 'force_destroy')->name('brand.delete');
        Route::get('brand/getTrashed', 'getTrashed')->name('brand.getTrashed');
        Route::get('brand/restore/{id}', 'restore')->name('brand.restore');
    });
    Route::resource('brand', BrandController::class);

    Route::controller(GroupController::class)->group(function () {
        Route::delete('groups/delete/{id}', 'force_destroy')->name('group.delete');
        Route::get('groups/getTrashed', 'getTrashed')->name('group.getTrashed');
        Route::get('groups/restore/{id}', 'restore')->name('group.restore');
    });
    Route::resource('groups', GroupController::class);

    Route::controller(UserController::class)->group(function () {
        Route::get('users/GetDistricts', 'GetDistricts')->name('user.GetDistricts');
        Route::get('users/getWards', 'getWards')->name('user.getWards');
        Route::delete('users/delete/{id}', 'destroy')->name('user.delete');
        Route::get('users/getTrashed', 'getTrashed')->name('user.getTrashed');
        Route::get('users/restore/{id}', 'restore')->name('user.restore');
        Route::delete('users/force_destroy/{id}', 'force_destroy')->name('user.force_destroy');
    });
    Route::resource('users', UserController::class);
    Route::get('/', function () {
        return view('admin.home');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers/trash', 'getTrash')->name('customer.trash');
        Route::get('customers/trash/restore/{id}', 'restore')->name('customer.restore');
        Route::delete('customers/trash/force-delete/{id}', 'forceDelete')->name('customer.forceDelete');
        Route::get('searchCustomers', 'searchByName')->name('customer.searchKey');
        Route::get('searchCustomer', 'searchCustomer')->name('customer.search');
    });
    Route::resource('customer', CustomerController::class);
    Route::delete('/delete/{id}', [CategoryController::class, 'force_destroy'])->name('category.delete');
    Route::get('/getTrashed', [CategoryController::class, 'getTrashed'])->name('category.getTrashed');
    Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category/getTrashed', 'getTrashed')->name('category.getTrashed');
        Route::delete('category/delete/{id}', 'force_destroy')->name('category.delete');
        Route::get('category/restore/{id}', 'restore')->name('category.restore');
    });
    Route::resource('category', CategoryController::class);

    Route::get('/export-order', [OrdersExport::class, 'exportOrder'])->name('export-order');
    Route::get('/export-orderdetail', [OrderDetailsExport::class, 'exportOrderDetail'])->name('export-orderdetail');
    Route::controller(OrderController::class)->group(function () {
        Route::put('order/updatesingle/{id}', 'updateSingle')->name('order.updatesingle');
    });
    Route::resource('order', OrderController::class);
    Route::controller(BrandController::class)->group(function () {
        Route::delete('brand/delete/{id}', 'force_destroy')->name('brand.delete');
        Route::get('brand/getTrashed', 'getTrashed')->name('brand.getTrashed');
        Route::get('brand/restore/{id}', 'restore')->name('brand.restore');
    });
    Route::resource('brand', BrandController::class);

    Route::controller(ProductController::class)->group(function () {
        Route::delete('product/delete/{id}', 'force_destroy')->name('product.delete');
        Route::get('product/getTrashed', 'getTrashed')->name('product.getTrashed');
        Route::get('product/restore/{id}', 'restore')->name('product.restore');
        Route::get('products/showStatus/{id}', 'showStatus')->name('products.showStatus');
        Route::get('products/hideStatus/{id}', 'hideStatus')->name('products.hideStatus');
    });
    Route::resource('product', ProductController::class);
});
