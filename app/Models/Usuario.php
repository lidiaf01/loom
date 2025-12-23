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
        'nombre', 'email', 'contrasenha', 'fecha_nac', 'biografia', 'foto_perfil', 'fecha_registro'
    ];
}