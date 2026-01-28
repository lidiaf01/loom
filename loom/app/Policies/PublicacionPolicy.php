<?php

namespace App\Policies;

use App\Models\Publicacion;
use App\Models\Usuario;

class PublicacionPolicy
{
    public function view(Usuario $user, Publicacion $publicacion): bool
    {
        if ($publicacion->visibilidad === 'publica') {
            return true;
        }

        if ($publicacion->usuario_id === $user->id) {
            return true;
        }

        return $publicacion->usuario
            ->seguidores()
            ->where('seguidor_id', $user->id)
            ->wherePivot('estado', 'accepted')
            ->exists();
    }
}
