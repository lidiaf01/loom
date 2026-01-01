<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    const CREATED_AT = 'fecha_registro'; 
    const UPDATED_AT = null; 

    public function getAuthPassword() {
        return $this->contrasenha;
    }   

    protected $fillable = [
        'nombre', 'email', 'contrasenha', 'fecha_nac', 'biografia', 'foto_perfil', 'perfil_privado', 'fecha_registro'
    ];

    public function publicaciones() {
        return $this->hasMany(Publicacion::class, 'usuario_id');
    }

    public function seguidores()
    {
        return $this->belongsToMany(Usuario::class, 'seguidores', 'seguido_id', 'seguidor_id')
            ->withPivot('estado');
    }

    public function seguidos()
    {
        return $this->belongsToMany(Usuario::class, 'seguidores', 'seguidor_id', 'seguido_id')
            ->withPivot('estado');
    }

    public function solicitudesRecibidas()
    {
        return $this->seguidores()->wherePivot('estado', 'pending');
    }

    public function solicitudesEnviadas()
    {
        return $this->seguidos()->wherePivot('estado', 'pending');
    }

    public function sigueA(int $usuarioId): bool
    {
        return $this->seguidos()->wherePivot('estado', 'accepted')->where('seguido_id', $usuarioId)->exists();
    }

    public function solicitudPendienteA(int $usuarioId): bool
    {
        return $this->seguidos()->wherePivot('estado', 'pending')->where('seguido_id', $usuarioId)->exists();
    }
}