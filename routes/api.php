<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return 'pong';
});

use App\Http\Controllers\BibliotecaController;
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/carpetas', [BibliotecaController::class, 'apiCarpetas']);
    Route::post('/carpeta', [BibliotecaController::class, 'apiCrearCarpeta']);
});