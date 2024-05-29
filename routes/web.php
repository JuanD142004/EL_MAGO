<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\auth;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\DetailsLoadController;


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
Route::patch('/customer/{id}/update_status', [App\Http\Controllers\CustomerController::class, 'updateStatus'])->name('customer.update_status');
Route::resource('user', App\Http\Controllers\UserController::class);

// Rutas de autenticación
Auth::routes();

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
Route::resource('truck_type', App\Http\Controllers\TruckTypeController::class);
Route::patch('/truck_type/disable/{id}', [App\Http\Controllers\TruckTypeController::class, 'disable'])->name('truck_type.disable');
Route::patch('/truck_type/enable/{id}', [App\Http\Controllers\TruckTypeController::class, 'enable'])->name('truck_type.enable');
Route::patch('/truck_type/{id}/update_status', [App\Http\Controllers\TruckTypeController::class, 'updateStatus'])->name('update_status');

  // Rutas para las cargas
  Route::resource('load', LoadController::class);
  Route::post('/enviar-formulario', [LoadController::class, 'enviarFormulario'])->name('tu.ruta.de.envio');

  // Rutas para los detalles de carga
  Route::resource('details_load', DetailsLoadController::class);
  Route::get('/details-loads', [DetailsLoadController::class, 'index'])->name('details-loads.index');
  Route::delete('/details_loads/{id}', [DetailsLoadController::class, 'destroy'])->name('details_loads.destroy');
  Route::post('/details', 'DetailController@store')->name('details.store');


  Route::get('/details-loads/crear', [DetailsLoadController::class, 'crear'])->name('details-loads.crear');
  Route::get('details-loads/{id}', 'DetailsLoadController@show')->name('details-loads.show');

  Route::get('/loads/create', [LoadController::class, 'create'])->name('loads.create');
  Route::delete('/loads/{id}', [LoadController::class, 'destroy'])->name('loads.destroy');
  Route::get('/loads/{id}', [LoadController::class, 'show'])->name('loads.show');
  Route::get('/loads/{id}/edit', [LoadController::class, 'edit'])->name('loads.edit');
  Route::post('/loads', [LoadController::class, 'store'])->name('loads.store');
  Route::get('/loads', [LoadController::class, 'index'])->name('loads.index');
  Route::patch('/loads/{load}', [LoadController::class, 'update'])->name('loads.update');
  Route::patch('/load/{id}/update_status', [LoadController::class, 'updateStatus'])->name('load.update_status');
  Route::get('/loads/create/{loadId}', 'LoadController@create')->name('loads.create');
  Route::get('loads/create/{loadId?}', 'LoadController@create')->name('loads.create');
  





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
