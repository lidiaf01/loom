<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
// Registro
Route::get('/registro-1', [LoginController::class, 'showRegistro1'])->name('registro.1');
Route::post('/registro-1', [LoginController::class, 'storePaso1']);
Route::get('/registro-2', [LoginController::class, 'showRegistro2'])->name('registro.2');
Route::post('/registro-finalizar', [LoginController::class, 'finalizarRegistro'])->name('registro.finalizar');

// Resultados
Route::view('/exito', 'auth.registro_exito')->name('registro.exito');
Route::view('/fallo', 'auth.registro_fallo')->name('registro.fallo');

// Home
Route::middleware('auth')->get('/home', function () {
    return view('layouts.home');
})->name('home');