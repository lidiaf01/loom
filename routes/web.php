<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirigir raíz a /inicio
Route::get('/', function () {
    return redirect('/inicio');
});

// Página de inicio (landing) - solo para invitados
Route::middleware('guest')->group(function () {
    Route::view('/inicio', 'welcome')->name('inicio');
    
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    
    // Registro
    Route::get('/registro-1', [RegistroController::class, 'showRegistro1'])->name('registro.1');
    Route::post('/registro-1', [RegistroController::class, 'storePaso1']);
    Route::get('/registro-2', [RegistroController::class, 'showRegistro2'])->name('registro.2');
    Route::post('/registro-finalizar', [RegistroController::class, 'finalizarRegistro'])->name('registro.finalizar');
    
    // Resultados
    Route::view('/exito', 'auth.registro_exito')->name('registro.exito');
    Route::view('/fallo', 'auth.registro_fallo')->name('registro.fallo');
});

// Home - solo para autenticados
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('layouts.home');
    })->name('home');

    // Ruta de perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile');
});