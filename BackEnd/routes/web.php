<?php

use App\Http\Controllers\Admin\CustomerController;
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
Route::get('customer/trash', [CustomerController::class, 'getTrash'])->name('customer.trash');
Route::post('customer/trash/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore');
Route::delete('customer/trash/force-delete/{id}', [CustomerController::class, 'forceDelete'])->name('customer.forceDelete');
Route::get('searchCustomers', [CustomerController::class, 'searchByName'])->name('customer.searchKey');
Route::get('searchCustomer', [CustomerController::class, 'searchCustomer'])->name('customer.search');
Route::resource('customer', CustomerController::class);
