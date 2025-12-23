<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_entrada';
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = ['titulo', 'contenido', 'fecha_entrada', 'estado_animo', 'usuario_id'];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}