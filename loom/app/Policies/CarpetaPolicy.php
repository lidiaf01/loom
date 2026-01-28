<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Carpeta;

class CarpetaPolicy
{
    public function view(Usuario $user, Carpeta $carpeta)
    {
        // Permitir ver si la carpeta pertenece a la biblioteca del usuario
        return $carpeta->biblioteca && $carpeta->biblioteca->usuario_id === $user->id;
    }

    public function update(Usuario $user, Carpeta $carpeta)
    {
        return $carpeta->biblioteca && $carpeta->biblioteca->usuario_id === $user->id;
    }

    public function delete(Usuario $user, Carpeta $carpeta)
    {
        return $carpeta->biblioteca && $carpeta->biblioteca->usuario_id === $user->id;
    }
}
