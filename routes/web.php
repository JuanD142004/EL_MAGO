<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\auth;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('customer', App\Http\Controllers\CustomerController::class);
Route::resource('user', App\Http\Controllers\UserController::class);


// Rutas de autenticación
Auth::routes();
Route::resource('user', App\Http\Controllers\UserController::class);
Route::get('/users', [UserController::class, 'index']);
Route::patch('/user/{id}/update_status', 'UserController@updateStatus')->name('user.update_status');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas para los Productos
Route::resource('product', App\Http\Controllers\ProductController::class);
Route::patch('/product/disable/{id}', [App\Http\Controllers\ProductController::class, 'disable'])->name('product.disable');
Route::patch('/product/enable/{id}', [App\Http\Controllers\ProductController::class, 'enable'])->name('product.enable');
Route::patch('/product/{id}/update_status', [App\Http\Controllers\ProductController::class, 'updateStatus'])->name('product.update_status');


// Rutas para los Proveedores
Route::resource('supplier', App\Http\Controllers\SupplierController::class);
Route::patch('/supplier/disable/{id}', [App\Http\Controllers\SupplierController::class, 'disable'])->name('supplier.disable');
Route::patch('/supplier/enable/{id}', [App\Http\Controllers\SupplierController::class, 'enable'])->name('supplier.enable');
Route::patch('/supplier/{id}/update_status', [App\Http\Controllers\SupplierController::class, 'updateStatus'])->name('supplier.update_status');

// Rutas para los tipos de Camion
use App\Http\Controllers\TruckTypeController;

Route::resource('truck_type', TruckTypeController::class);
Route::patch('/truck_type/disable/{id}', [TruckTypeController::class, 'disable'])->name('truck_type.disable');
Route::patch('/truck_type/enable/{id}', [TruckTypeController::class, 'enable'])->name('truck_type.enable');
Route::patch('/truck_type/{id}/update_status', [TruckTypeController::class, 'updateStatus'])->name('truck_type.update_status');
Route::delete('/truck_type/{id}', [TruckTypeController::class, 'destroy'])->name('truck_type.destroy');
Route::get('/truck_type/{id}/edit', [TruckTypeController::class, 'edit'])->name('truck_type.edit');


Route::resource('load', App\Http\Controllers\LoadController::class);
Route::post('/enviar-formulario', [LoadController::class, 'enviarFormulario'])->name('tu.ruta.de.envio');