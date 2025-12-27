<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $primaryKey = 'id_publicacion';
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = ['titulo', 'contenido', 'fecha_subida', 'contenido_visual', 'usuario_id'];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con Carpeta
    public function carpetas() {
        return $this->belongsToMany(Carpeta::class, 'carpeta_publicacion', 'id_publicacion', 'id_Carpeta')
                    ->withPivot('fecha_añadido');
    }
}