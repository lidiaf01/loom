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

    protected $fillable = ['titulo', 'subtitulo', 'contenido', 'fecha_subida', 'contenido_visual', 'usuario_id', 'categoria', 'visibilidad'];

    protected $casts = [
        'fecha_subida' => 'datetime',
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con Carpeta
    public function carpetas() {
        return $this->belongsToMany(Carpeta::class, 'carpeta_publicacion', 'publicacion_id', 'carpeta_id')
                    ->withPivot('usuario_id', 'fecha_añadido')
                    ->withTimestamps();
    }

    public function guardadaPor()
    {
        return $this->belongsToMany(Usuario::class, 'carpeta_publicacion', 'publicacion_id', 'usuario_id')
            ->withPivot('carpeta_id', 'fecha_añadido')
            ->withTimestamps();
    }

    public function scopeVisiblesPara($query, ?Usuario $viewer)
    {
        if (!$viewer) {
            return $query->where('visibilidad', 'publica');
        }

        return $query->where(function ($q) use ($viewer) {
            $q->where('visibilidad', 'publica')
              ->orWhere(function ($qPrivadas) use ($viewer) {
                  $qPrivadas->where('visibilidad', 'privada')
                      ->where(function ($qAccess) use ($viewer) {
                          $qAccess->where('usuario_id', $viewer->id)
                              ->orWhereExists(function ($qFollow) use ($viewer) {
                                  $qFollow->selectRaw(1)
                                      ->from('seguidores')
                                      ->whereColumn('seguidores.seguido_id', 'publicaciones.usuario_id')
                                      ->where('seguidores.seguidor_id', $viewer->id)
                                      ->where('seguidores.estado', 'accepted');
                              });
                      });
              });
        });
    }

    public function getColorClasses() {
        $colorMap = [
            'Salud & Bienestar' => ['bg' => 'bg-emerald-200', 'border' => 'border-emerald-300'],
            'Ejercicio & Movimiento' => ['bg' => 'bg-orange-200', 'border' => 'border-orange-300'],
            'Hobbies & Creatividad' => ['bg' => 'bg-violet-200', 'border' => 'border-violet-300'],
            'Cocina & Nutrición' => ['bg' => 'bg-amber-200', 'border' => 'border-amber-300'],
            'Desarrollo Personal' => ['bg' => 'bg-sky-200', 'border' => 'border-sky-300'],
            'Meditación & Mindfulness' => ['bg' => 'bg-rose-200', 'border' => 'border-rose-300'],
            'Relaciones & Familia' => ['bg' => 'bg-pink-200', 'border' => 'border-pink-300'],
            'Finanzas & Productividad' => ['bg' => 'bg-yellow-100', 'border' => 'border-yellow-200'],
            'Viajes & Aventuras' => ['bg' => 'bg-cyan-200', 'border' => 'border-cyan-300'],
            'Arte & Cultura' => ['bg' => 'bg-indigo-200', 'border' => 'border-indigo-300'],
        ];

        return $colorMap[$this->categoria] ?? ['bg' => 'bg-blue-200', 'border' => 'border-blue-300'];
    }
}