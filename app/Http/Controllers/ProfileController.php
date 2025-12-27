<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Mostrar el perfil del usuario autenticado
     */
    public function show(Request $request)
    {
        $user = auth()->user();
        
        // Obtener publicaciones del usuario
        $publicaciones = $user->publicaciones()
            ->orderBy('fecha_creacion', 'desc')
            ->get();

        // Si es una solicitud AJAX, retornar JSON
        if ($request->expectsJson()) {
            return response()->json([
                'user' => $user,
                'publicaciones' => $publicaciones,
                'publicaciones_count' => $publicaciones->count()
            ]);
        }

        // Si no, retornar la vista
        return view('profile.index', [
            'user' => $user,
            'publicaciones' => $publicaciones
        ]);
    }
}
