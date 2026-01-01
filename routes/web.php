<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistroController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SearchController;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Route;

// Redirigir raíz a /inicio
Route::get('/', function () {
    return redirect('/inicio');
});

// Inspiración rápida: redirige a una publicación pública aleatoria
Route::get('/inspiracion-rapida', function () {
    $publicacion = Publicacion::where('visibilidad', 'publica')
        ->inRandomOrder()
        ->first();

    if (!$publicacion) {
        return redirect('/inicio')->with('status', 'No hay publicaciones públicas disponibles.');
    }

    if (!auth()->check()) {
        session(['url.intended' => route('publicaciones.show', $publicacion)]);
        return redirect()->route('login');
    }

    return redirect()->route('publicaciones.show', $publicacion);
})->name('inspiracion.rapida');

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
    Route::get('/usuarios/{usuario}', [ProfileController::class, 'showUsuario'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/seguidores', [ProfileController::class, 'seguidoresLista'])->name('usuarios.seguidores');

    // Publicaciones - flujo de creación
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.crear');
    Route::post('/publicaciones/continuar', [PublicacionController::class, 'continue'])->name('publicaciones.continuar');
    Route::get('/publicaciones/opciones', [PublicacionController::class, 'opciones'])->name('publicaciones.opciones');
    Route::post('/publicaciones', [PublicacionController::class, 'store'])->name('publicaciones.store');
    Route::get('/publicaciones/{publicacion}', [PublicacionController::class, 'show'])->name('publicaciones.show');
    Route::delete('/publicaciones/{publicacion}', [PublicacionController::class, 'destroy'])->name('publicaciones.destroy');
    Route::post('/publicaciones/{publicacion}/guardar', [PublicacionController::class, 'guardar'])->name('publicaciones.guardar');

    // Seguidores / solicitudes
    Route::post('/usuarios/{usuario}/seguir', [FollowController::class, 'solicitar'])->name('usuarios.seguir');
    Route::delete('/usuarios/{usuario}/seguir', [FollowController::class, 'dejar'])->name('usuarios.dejar');
    Route::post('/usuarios/{usuario}/aceptar', [FollowController::class, 'aceptar'])->name('usuarios.aceptar');
    Route::post('/usuarios/{usuario}/rechazar', [FollowController::class, 'rechazar'])->name('usuarios.rechazar');

    // Búsqueda y explorar
    Route::get('/buscar', [SearchController::class, 'index'])->name('buscar');
    Route::get('/explorar', [ExploreController::class, 'index'])->name('explorar');
});