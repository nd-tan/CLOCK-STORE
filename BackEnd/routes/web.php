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
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
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
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'postlogin'])->name('postlogin');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
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
        Route::delete('group/delete/{id}', 'force_destroy')->name('group.delete');
        Route::get('group/getTrashed', 'getTrashed')->name('group.getTrashed');
        Route::get('group/restore/{id}', 'restore')->name('group.restore');
    });
    Route::resource('groups', GroupController::class);

    Route::controller(UserController::class)->group(function () {
        Route::get('user/GetDistricts', 'GetDistricts')->name('user.GetDistricts');
        Route::get('user/getWards', 'getWards')->name('user.getWards');
        Route::delete('user/delete/{id}', 'force_destroy')->name('user.delete');
        Route::get('user/getTrashed', 'getTrashed')->name('user.getTrashed');
        Route::get('user/restore/{id}', 'restore')->name('user.restore');
        Route::get('user/info', 'info')->name('user.info');
        Route::post('user/updateInfo/{id}', 'update_info')->name('user.update_info');
        Route::post('user/updatePass/{id}', 'change_password')->name('user.change_password');
        Route::post('user/PassByEmail/{id}', 'password_by_email')->name('user.mailPassword');
        
    });
    Route::resource('users', UserController::class);
Route::controller(CustomerController::class)->group(function () {
Route::get('customers/trash','getTrash')->name('customer.trash');
Route::get('customers/trash/restore/{id}','restore')->name('customer.restore');
Route::delete('customers/trash/force-delete/{id}','forceDelete')->name('customer.forceDelete');
});
Route::resource('customer', CustomerController::class);
Route::delete('/delete/{id}',[CategoryController::class,'force_destroy'])->name('category.delete');
Route::get('/getTrashed',[CategoryController::class,'getTrashed'])->name('category.getTrashed');
Route::get('/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
Route::controller(CategoryController::class)->group(function () {
    Route::get('category/getTrashed','getTrashed')->name('category.getTrashed');
    Route::delete('category/delete/{id}','force_destroy')->name('category.delete');
    Route::get('category/restore/{id}','restore')->name('category.restore');
});
Route::resource('category', CategoryController::class);


});
Route::get('/export-order',[OrdersExport::class,'exportOrder'] )->name('export-order');
Route::get('/export-orderdetail/{id}',[OrderDetailsExport::class,'exportOrderDetail'] )->name('export-orderdetail');
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
    Route::get('products/showStatus/{id}','showStatus')->name('products.showStatus');
    Route::get('products/hideStatus/{id}', 'hideStatus')->name('products.hideStatus');
    Route::get('products/exportExcel', 'exportExcel')->name('products.exportExcel');
});
Route::resource('product', ProductController::class);
