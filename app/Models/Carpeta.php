<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carpeta extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_Carpeta';
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modif';

    protected $fillable = ['nombre', 'biblioteca_id'];

    public function biblioteca() {
        return $this->belongsTo(Biblioteca::class, 'biblioteca_id');
    }

    public function publicaciones() {
        return $this->belongsToMany(Publicacion::class, 'carpeta_publicacion', 'carpeta_id', 'publicacion_id')
                    ->withPivot('usuario_id', 'fecha_añadido')
                    ->withTimestamps();
    }
}