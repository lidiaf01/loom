
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibliotecaController;

Route::get('/ping', function () {
    return 'pong';
});

Route::middleware('auth:web')->get('/user', function () {
    $usuario = auth()->user();
    if (!$usuario) {
        return response()->json(['error' => 'No autenticado'], 401);
    }
    // Solo exponer campos seguros
    return response()->json([
        'id' => $usuario->id,
        'nombre' => $usuario->nombre,
        'email' => $usuario->email ?? null,
        'foto_perfil' => $usuario->foto_perfil ?? null,
    ]);
});

Route::middleware('auth:web')->group(function () {
    Route::get('/carpetas', [BibliotecaController::class, 'apiCarpetas']);
    Route::post('/carpeta', [BibliotecaController::class, 'apiCrearCarpeta']);
});