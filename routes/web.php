<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UnitController;
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
    Route::get('/unit/create/{id?}', [App\Http\Controllers\UnitController::class, 'upsert'])->name('unit.create')->middleware('admin');
    Route::get('/unit/update/{id?}', [App\Http\Controllers\UnitController::class, 'upsert'])->name('unit.update')->middleware('admin');
    Route::post('/unit/upsert/store/{id?}',[App\Http\Controllers\UnitController::class, 'upsertStore'])->name('unit.upsert.store')->middleware('admin');
    Route::get('/unit/upsert/index',[App\Http\Controllers\UnitController::class, 'index'])->name('unit.index')->middleware('admin');
    Route::delete('/unit/upsert/delete/{id}',[App\Http\Controllers\UnitController::class, 'delete'])->name('unit.delete')->middleware('admin');
});