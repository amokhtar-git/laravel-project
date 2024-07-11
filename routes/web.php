<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

// Users Route
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::post('/user/bulkAction', [UserController::class, 'bulkAction'])->name('user.bulkAction');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Warehouse Route
Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
Route::get('/warehouse/create', [WarehouseController::class, 'create'])->name('warehouse.create');
Route::post('/warehouse/store', [WarehouseController::class, 'store'])->name('warehouse.store');
Route::post('/warehouse/bulkAction', [WarehouseController::class, 'bulkAction'])->name('warehouse.bulkAction');
Route::get('/warehouse/{id}/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
Route::put('/warehouse/{id}', [WarehouseController::class, 'update'])->name('warehouse.update');
Route::delete('/warehouse/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');