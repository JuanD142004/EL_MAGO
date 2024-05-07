<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Autenticación de Laravel
Auth::routes();

// Rutas para el resto de los controladores

Route::resource('user', App\Http\Controllers\UserController::class);

// Ruta para la página de inicio
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

