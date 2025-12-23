<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        // 1. Apuntamos al archivo JSON en la carpeta 'data'
        $rutaArchivo = database_path('seeders/data/usuarios.json');

        // 2. Comprobamos si el archivo existe
        if (!File::exists($rutaArchivo)) {
            $this->command->error("El archivo usuarios_prueba.json no existe en: $rutaArchivo");
            return;
        }

        // 3. Obtenemos el contenido y lo decodificamos a un array asociativo
        $json = File::get($rutaArchivo);
        $usuarios = json_decode($json, true);

        // 4. Verificamos que el JSON sea válido
        if (is_null($usuarios)) {
            $this->command->error("El formato del archivo JSON no es válido.");
            return;
        }

        // 5. Iteramos sobre cada usuario del archivo
        foreach ($usuarios as $u) {
            Usuario::create([
                'nombre'         => $u['nombre'],
                'email'          => $u['email'],
                // Encriptamos la contraseña para que el login funcione
                'contrasenha'    => Hash::make($u['contrasenha']),
                'fecha_nac'      => $u['fecha_nac'],
                'biografia'      => $u['biografia'] ?? null,
                'foto_perfil'    => $u['foto_perfil'] ?? null,
                'fecha_registro' => now(), // Campo adicional si lo necesitas
            ]);
        }
        
        $this->command->info("Se han cargado " . count($usuarios) . " usuarios desde el archivo JSON.");
    }
}