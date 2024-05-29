<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UploadController;
use App\Http\Services\UploadService;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('home.admin')->middleware('admin');
    // Unit
    Route::get('/unit/create/{id?}', [App\Http\Controllers\UnitController::class, 'upsert'])->name('unit.create')->middleware('admin');
    Route::get('/unit/update/{id?}', [App\Http\Controllers\UnitController::class, 'upsert'])->name('unit.update')->middleware('admin');
    Route::post('/unit/upsert/store/{id?}', [App\Http\Controllers\UnitController::class, 'upsertStore'])->name('unit.upsert.store')->middleware('admin');
    Route::get('/unit/upsert/index', [App\Http\Controllers\UnitController::class, 'index'])->name('unit.index')->middleware('admin');
    Route::delete('/unit/upsert/delete/{id}', [App\Http\Controllers\UnitController::class, 'delete'])->name('unit.delete')->middleware('admin');
    // Unit

    // Suppeliers
    Route::get('/supplier/create/{id?}', [App\Http\Controllers\SupplierController::class, 'upsert'])->name('supplier.create')->middleware('admin');
    Route::get('/supplier/update/{id?}', [App\Http\Controllers\SupplierController::class, 'upsert'])->name('supplier.update')->middleware('admin');
    Route::post('/supplier/upsert/store/{id?}', [App\Http\Controllers\SupplierController::class, 'upsertStore'])->name('supplier.upsert.store')->middleware('admin');
    Route::get('/supplier/upsert/index', [App\Http\Controllers\SupplierController::class, 'index'])->name('supplier.index')->middleware('admin');
    Route::delete('/supplier/upsert/delete/{id}', [App\Http\Controllers\SupplierController::class, 'delete'])->name('supplier.delete')->middleware('admin');

    // Suppeliers

    // Customer
    Route::get('/customer/create/{id?}', [App\Http\Controllers\CustomerController::class, 'upsert'])->name('customer.create')->middleware('admin');
    Route::get('/customer/update/{id?}', [App\Http\Controllers\CustomerController::class, 'upsert'])->name('customer.update')->middleware('admin');
    Route::post('/customer/upsert/store/{id?}', [App\Http\Controllers\CustomerController::class, 'upsertStore'])->name('customer.upsert.store')->middleware('admin');
    Route::get('/customer/upsert/index', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index')->middleware('admin');
    Route::delete('/customer/upsert/delete/{id}', [App\Http\Controllers\CustomerController::class, 'delete'])->name('customer.delete')->middleware('admin');
    // Customer
    // Product
    
    Route::get('/product/index', [App\Http\Controllers\ProductsController::class, 'index'])->name('product.index')->middleware('admin');
    Route::get('/product/create/{id?}', [App\Http\Controllers\ProductsController::class, 'upsert'])->name('product.create')->middleware('admin');
    Route::get('/product/update/{id?}', [App\Http\Controllers\ProductsController::class, 'upsert'])->name('product.update')->middleware('admin');
    Route::post('/product/upsert/store/{id?}', [App\Http\Controllers\ProductsController::class, 'upsertStore'])->name('product.upsert.store')->middleware('admin');
    Route::delete('/product/upsert/delete/{id}', [App\Http\Controllers\ProductsController::class, 'delete'])->name('product.delete')->middleware('admin');
    // Product


    // Upload
    Route::post('upload/services',[App\Http\Controllers\UploadController::class, 'store'])->name('upload.services');

});
