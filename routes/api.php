<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\ProvidersController;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\Api\V1\WarehousesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::resource('proveedores', ProvidersController::class)->except(['create', 'edit']);
    Route::resource('usuarios', UsersController::class)->except(['create', 'edit', 'destroy']);
    Route::resource('bodegas', WarehousesController::class)->except(['create', 'edit']);
    Route::resource('productos', ProductsController::class)->except(['create', 'edit']);
});

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
