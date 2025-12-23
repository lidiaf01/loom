<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    use HasFactory;

    // Si no definiste nombres de timestamps para este, Laravel usará created_at/updated_at
    // o puedes desactivarlos con public $timestamps = false;

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function carpetas() {
        return $this->hasMany(Carpeta::class, 'biblioteca_id');
    }
}