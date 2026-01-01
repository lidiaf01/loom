<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Models\Publicacion;
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
        $ultimaPublicacion = null;
        $ultimaPublicacionId = session('ultima_publicacion_id');

        if ($ultimaPublicacionId) {
            $ultimaPublicacion = Publicacion::find($ultimaPublicacionId);
        }

        return view('layouts.home', [
            'ultimaPublicacion' => $ultimaPublicacion,
        ]);
    })->name('home');

    // Ruta de perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile');

    // Publicaciones - flujo de creación
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.crear');
    Route::post('/publicaciones/continuar', [PublicacionController::class, 'continue'])->name('publicaciones.continuar');
    Route::get('/publicaciones/opciones', [PublicacionController::class, 'opciones'])->name('publicaciones.opciones');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::get('/publicaciones/{publicacion}', [PublicacionController::class, 'show'])->name('publicaciones.show');
    Route::delete('/publicaciones/{publicacion}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');
    Route::post('/publicaciones/{publicacion}/guardar', [PublicacionController::class, 'guardar'])->name('publicaciones.guardar');
});