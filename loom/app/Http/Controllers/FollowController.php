<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function solicitar(Usuario $usuario): RedirectResponse
    {
        $viewer = Auth::user();
        if ($usuario->id === $viewer->id) {
            return back()->with('error', 'No puedes seguirte a ti mismo.');
        }

        $estado = $usuario->perfil_privado ? 'pending' : 'accepted';

        $exists = $viewer->seguidos()->where('seguido_id', $usuario->id)->first();
        if ($exists) {
            $viewer->seguidos()->updateExistingPivot($usuario->id, ['estado' => $estado]);
        } else {
            $viewer->seguidos()->attach($usuario->id, ['estado' => $estado]);
        }

        return back()->with('success', $estado === 'pending' ? 'Solicitud enviada.' : 'Ahora sigues a este usuario.');
    }

    public function aceptar(Usuario $seguidor): RedirectResponse
    {
        $usuario = Auth::user();
        \Log::info('[ACEPTAR] Intentando aceptar solicitud', [
            'auth_id' => $usuario->id,
            'seguidor_id' => $seguidor->id,
        ]);
        $pivot = \DB::table('seguidores')
            ->where('seguidor_id', $seguidor->id)
            ->where('seguido_id', $usuario->id)
            ->where('estado', 'pending')
            ->first();
        \Log::info('[ACEPTAR] Resultado consulta pivot', [
            'pivot' => $pivot
        ]);
        if ($pivot) {
            \DB::table('seguidores')
                ->where('seguidor_id', $seguidor->id)
                ->where('seguido_id', $usuario->id)
                ->update(['estado' => 'accepted']);
            \Log::info('[ACEPTAR] Solicitud aceptada', [
                'seguidor_id' => $seguidor->id,
                'seguido_id' => $usuario->id
            ]);
            return back()->with('success', 'Solicitud aceptada.');
        }
        \Log::warning('[ACEPTAR] No hay solicitud pendiente', [
            'seguidor_id' => $seguidor->id,
            'seguido_id' => $usuario->id
        ]);
        return back()->with('error', 'No hay solicitud pendiente.');
    }

    public function rechazar(Usuario $seguidor): RedirectResponse
    {
        $usuario = Auth::user();
        $usuario->seguidores()->wherePivot('estado', 'pending')->detach($seguidor->id);

        return back()->with('success', 'Solicitud eliminada.');
    }

    public function dejar(Usuario $usuario): RedirectResponse
    {
        $viewer = Auth::user();
        $viewer->seguidos()->detach($usuario->id);
        return back()->with('success', 'Has dejado de seguir a este usuario.');
    }
}
