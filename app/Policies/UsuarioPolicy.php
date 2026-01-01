<?php

namespace App\Policies;

use App\Models\Usuario;

class UsuarioPolicy
{
    public function view(Usuario $user, Usuario $target): bool
    {
        if ($user->id === $target->id) {
            return true;
        }

        if (!$target->perfil_privado) {
            return true;
        }

        return $target->seguidores()
            ->where('seguidor_id', $user->id)
            ->wherePivot('estado', 'accepted')
            ->exists();
    }
}
