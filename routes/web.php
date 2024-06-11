<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UploadController;
use App\Http\Services\UploadService;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImportOrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ExportController;

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
    Route::get('/unit/create/{id?}', [UnitController::class, 'upsert'])->name('unit.create')->middleware('admin');
    Route::get('/unit/update/{id?}', [UnitController::class, 'upsert'])->name('unit.update')->middleware('admin');
    Route::post('/unit/upsert/store/{id?}', [UnitController::class, 'upsertStore'])->name('unit.upsert.store')->middleware('admin');
    Route::get('/unit/upsert/index', [UnitController::class, 'index'])->name('unit.index')->middleware('admin');
    Route::delete('/unit/upsert/delete/{id}', [UnitController::class, 'delete'])->name('unit.delete')->middleware('admin');
    // Unit

    // Suppeliers
    Route::get('/supplier/create/{id?}', [SupplierController::class, 'upsert'])->name('supplier.create')->middleware('admin');
    Route::get('/supplier/update/{id?}', [SupplierController::class, 'upsert'])->name('supplier.update')->middleware('admin');
    Route::post('/supplier/upsert/store/{id?}', [SupplierController::class, 'upsertStore'])->name('supplier.upsert.store')->middleware('admin');
    Route::get('/supplier/upsert/index', [SupplierController::class, 'index'])->name('supplier.index')->middleware('admin');
    Route::delete('/supplier/upsert/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete')->middleware('admin');

    // Suppeliers

    // Customer
    Route::get('/customer/create/{id?}', [CustomerController::class, 'upsert'])->name('customer.create')->middleware('admin');
    Route::get('/customer/update/{id?}', [CustomerController::class, 'upsert'])->name('customer.update')->middleware('admin');
    Route::post('/customer/upsert/store/{id?}', [CustomerController::class, 'upsertStore'])->name('customer.upsert.store')->middleware('admin');
    Route::get('/customer/upsert/index', [CustomerController::class, 'index'])->name('customer.index')->middleware('admin');
    Route::delete('/customer/upsert/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete')->middleware('admin');
    // Customer
    // Product

    Route::get('/product/index', [ProductsController::class, 'index'])->name('product.index')->middleware('admin');
    Route::get('/product/create/{id?}', [ProductsController::class, 'upsert'])->name('product.create')->middleware('admin');
    Route::get('/product/update/{id?}', [ProductsController::class, 'upsert'])->name('product.update')->middleware('admin');
    Route::post('/product/upsert/store/{id?}', [ProductsController::class, 'upsertStore'])->name('product.upsert.store')->middleware('admin');
    Route::delete('/product/upsert/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete')->middleware('admin');
    Route::get('/get-product-detail/{id?}', [ProductsController::class, 'getProductDetail'])->name('product.get-product')->middleware('admin');
    
    // Product

    // User
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('/user/create/{id?}', [UserController::class, 'upsert'])->name('user.create')->middleware('admin');
    Route::get('/user/update/{id?}', [UserController::class, 'upsert'])->name('user.update')->middleware('admin');
    Route::post('/user/upsert/store/{id?}', [UserController::class, 'upsertStore'])->name('user.upsert.store')->middleware('admin');
    Route::delete('/user/upsert/delete/{id}', [UserController::class, 'delete'])->name('user.delete')->middleware('admin');

    Route::get('/user/update-profile/{id?}', [UserController::class, 'upsert'])->name('user.update-profile');
    Route::post('/user/update-profile/store/{id?}', [UserController::class, 'updateProfile'])->name('user.update-profile.store');
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.change.store');


    // User

    // Import Order
    Route::get('/order-import/create/{id?}', [ImportOrderController::class, 'create'])->name('import.create')->middleware('admin');
    Route::post('/order-import/store', [ImportOrderController::class, 'store'])->name('import.store')->middleware('admin');
    Route::get('/order-import/index', [ImportOrderController::class, 'index'])->name('import.index')->middleware('admin');
    Route::get('/order-import/detail/{id?}', [ImportOrderController::class, 'detail'])->name('import.detail')->middleware('admin');
    Route::delete('/order-import/delete/{id?}', [ImportOrderController::class, 'delete'])->name('import.delete')->middleware('admin');
    // Import Order

    // Export Order
    Route::get('/order-export/create', [ExportController::class, 'create'])->name('export.create')->middleware('admin');
    Route::post('/order-export/store', [ExportController::class, 'store'])->name('export.store')->middleware('admin');
    Route::get('/order-export/index', [ExportController::class, 'index'])->name('export.index')->middleware('admin');
    Route::get('/order-export/detail/{id?}', [ExportController::class, 'detail'])->name('export.detail')->middleware('admin');
    Route::delete('/order-export/delete/{id?}', [ExportController::class, 'delete'])->name('export.delete')->middleware('admin');

    // Export Order

    // Upload
    Route::post('upload/services', [UploadController::class, 'store'])->name('upload.services');
    // Upload
    Route::get('/unauthorized', function () {
        return view('layouts.unauthorize');
    })->name('unauthorized');
});
