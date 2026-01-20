<?php
// Limpieza de imports y rutas
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Publicacion;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\DiarioController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;


// Menú de entrada (landing principal)
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// Inspiración rápida: redirige a una publicación pública aleatoria
Route::get('/inspiracion-rapida', function () {
    $publicacion = Publicacion::where('visibilidad', 'publica')
        ->inRandomOrder()
        ->first();
    if (!$publicacion) {
        return redirect('/')->with('status', 'No hay publicaciones públicas disponibles.');
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


use App\Http\Controllers\AjustesController;

// Home - solo para autenticados
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('layouts.home');
    })->name('home');

    // Ajustes
    Route::post('/ajustes/cambiar-cuenta', [AjustesController::class, 'cambiarCuenta'])->name('ajustes.cambiarCuenta');
    Route::post('/ajustes/cambiar-contrasena', [AjustesController::class, 'cambiarContrasena'])->name('ajustes.cambiarContrasena');
    Route::post('/ajustes/eliminar-cuenta', [AjustesController::class, 'eliminarCuenta'])->name('ajustes.eliminarCuenta');
    Route::post('/ajustes/actualizar-perfil', [AjustesController::class, 'actualizarPerfil'])->name('ajustes.actualizarPerfil');
    Route::post('/ajustes/visibilidad', [AjustesController::class, 'cambiarVisibilidad'])->name('ajustes.cambiarVisibilidad');

    // Ruta de perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile');
        // Página de ajustes
        Route::view('/ajustes', 'ajustes')->name('ajustes');
        Route::post('/cuenta/eliminar', function() {
            $user = Auth::user();
            if ($user) {
                // Eliminar usuario y cerrar sesión
                $user->delete();
                Auth::logout();
                return redirect('/')->with('status', 'Cuenta eliminada correctamente');
            }
            return redirect('/ajustes')->with('error', 'No se pudo eliminar la cuenta');
        })->name('cuenta.eliminar');
        // Logout
        Route::post('/logout', function() {
            \Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/inicio');
        })->name('logout');
    Route::get('/usuarios/{usuario}', [ProfileController::class, 'showUsuario'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/seguidores', [ProfileController::class, 'seguidoresLista'])->name('usuarios.seguidores');

    // Publicaciones - flujo de creación
    Route::get('/publicaciones/crear', [PublicacionController::class, 'create'])->name('publicaciones.crear');
    Route::post('/publicaciones/continuar', [PublicacionController::class, 'continue'])->name('publicaciones.continuar');
    Route::get('/publicaciones/opciones', [PublicacionController::class, 'opciones'])->name('publicaciones.opciones');
    Route::post('/publicaciones/cancelar', [PublicacionController::class, 'cancelar'])->name('publicaciones.cancelar');
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

// Biblioteca - solo para autenticados
Route::middleware(['auth'])->group(function () {
    Route::get('/biblioteca', [BibliotecaController::class, 'index'])->name('biblioteca.index');
    Route::post('/biblioteca/carpeta', [BibliotecaController::class, 'storeCarpeta'])->name('biblioteca.carpeta.store');
    Route::put('/biblioteca/carpeta/{id}', [BibliotecaController::class, 'updateCarpeta'])->name('biblioteca.carpeta.update');
    Route::delete('/biblioteca/carpeta/{id}', [BibliotecaController::class, 'destroyCarpeta'])->name('biblioteca.carpeta.destroy');
    Route::get('/biblioteca/carpeta/{id}', [BibliotecaController::class, 'showCarpeta'])->name('biblioteca.carpeta.show');
});

// Diario
Route::middleware(['auth'])->group(function () {
    Route::get('/diario', [DiarioController::class, 'index'])->name('diario.index');
    Route::post('/diario', [DiarioController::class, 'store'])->name('diario.store');
    Route::delete('/diario/{id}', [DiarioController::class, 'destroy'])->name('diario.destroy');
    Route::post('/ajustes/diario-privacidad', [DiarioController::class, 'setPrivacidad'])->name('diario.setPrivacidad');
});
Route::get('/usuario/{usuario_id}/diario', [DiarioController::class, 'showUser'])->name('diario.showUser');