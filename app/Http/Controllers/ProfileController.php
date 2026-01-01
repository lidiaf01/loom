<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Mostrar el perfil del usuario autenticado
     */
    public function show(Request $request)
    {
        $user = auth()->user();
        $publicaciones = Publicacion::visiblesPara($user)
            ->where('usuario_id', $user->id)
            ->orderBy('fecha_creacion', 'desc')
            ->get();

        $solicitudes = $user->solicitudesRecibidas()->get();
        $seguidoresCount = $user->seguidores()->wherePivot('estado', 'accepted')->count();
        $seguidosCount = $user->seguidos()->wherePivot('estado', 'accepted')->count();

        // Si es una solicitud AJAX, retornar JSON
        if ($request->expectsJson()) {
            return response()->json([
                'user' => $user,
                'publicaciones' => $publicaciones,
                'publicaciones_count' => $publicaciones->count(),
                'solicitudes' => $solicitudes,
                'seguidores' => $seguidoresCount,
                'seguidos' => $seguidosCount,
            ]);
        }

        return view('profile.index', [
            'user' => $user,
            'publicaciones' => $publicaciones,
            'solicitudes' => $solicitudes,
            'isOwner' => true,
            'estadoSeguimiento' => 'owner',
            'seguidores' => $seguidoresCount,
            'seguidos' => $seguidosCount,
        ]);
    }

    public function showUsuario(Request $request, Usuario $usuario)
    {
        $viewer = auth()->user();
        $this->authorize('view', $usuario);

        $publicaciones = Publicacion::visiblesPara($viewer)
            ->where('usuario_id', $usuario->id)
            ->orderBy('fecha_creacion', 'desc')
            ->get();

        $seguidoresCount = $usuario->seguidores()->wherePivot('estado', 'accepted')->count();
        $seguidosCount = $usuario->seguidos()->wherePivot('estado', 'accepted')->count();

        $estado = null;
        if ($viewer->id === $usuario->id) {
            $estado = 'owner';
        } elseif ($viewer->sigueA($usuario->id)) {
            $estado = 'accepted';
        } elseif ($viewer->solicitudPendienteA($usuario->id)) {
            $estado = 'pending';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'user' => $usuario,
                'publicaciones' => $publicaciones,
                'estado' => $estado,
                'seguidores' => $seguidoresCount,
                'seguidos' => $seguidosCount,
            ]);
        }

        return view('profile.index', [
            'user' => $usuario,
            'publicaciones' => $publicaciones,
            'solicitudes' => collect(),
            'isOwner' => false,
            'estadoSeguimiento' => $estado,
            'seguidores' => $seguidoresCount,
            'seguidos' => $seguidosCount,
        ]);
    }

    public function seguidoresLista(Usuario $usuario)
    {
        $viewer = auth()->user();
        $this->authorize('view', $usuario);

        $seguidores = $usuario->seguidores()->wherePivot('estado', 'accepted')->get();
        $solicitudes = collect();

        if ($viewer->id === $usuario->id && $usuario->perfil_privado) {
            $solicitudes = $usuario->solicitudesRecibidas()->get();
        }

        return view('followers.index', [
            'user' => $usuario,
            'seguidores' => $seguidores,
            'solicitudes' => $solicitudes,
            'isOwner' => $viewer->id === $usuario->id,
        ]);
    }
}
