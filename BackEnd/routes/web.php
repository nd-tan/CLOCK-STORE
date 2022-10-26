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
Route::resource('customer', CustomerController::class);
Route::controller(CustomerController::class)->group(function (){
    Route::get('customer/trash', 'getTrash')->name('customer.trash');
    Route::get('customer/trash/restore/{id}', 'restore')->name('customer.restore');
    Route::delete('customer/trash/force-delete/{id}', 'forceDelete')->name('customer.forceDelete');
    Route::get('searchCustomers', 'searchByName')->name('customer.searchKey');
    Route::get('searchCustomer', 'searchCustomer')->name('customer.search');
});
