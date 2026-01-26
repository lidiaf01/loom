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

    // Forzar timestamps personalizados
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->fecha_creacion)) {
                $model->fecha_creacion = now();
            }
        });
        static::updating(function ($model) {
            $model->fecha_modif = now();
        });
    }

    protected $fillable = ['nombre', 'color', 'biblioteca_id'];

    public function biblioteca() {
        return $this->belongsTo(Biblioteca::class, 'biblioteca_id');
    }

    public function publicaciones() {
        return $this->belongsToMany(Publicacion::class, 'carpeta_publicacion', 'carpeta_id', 'publicacion_id')
            ->withPivot('usuario_id', 'fecha_añadido');
    }
}