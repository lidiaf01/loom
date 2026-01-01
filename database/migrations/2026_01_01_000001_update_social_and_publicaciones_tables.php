<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seguidores', function (Blueprint $table) {
            if (!Schema::hasColumn('seguidores', 'estado')) {
                $table->enum('estado', ['pending', 'accepted'])->default('pending')->after('seguido_id');
            }
            $table->unique(['seguidor_id', 'seguido_id'], 'seguidores_unicos');
        });

        Schema::table('publicaciones', function (Blueprint $table) {
            if (!Schema::hasColumn('publicaciones', 'visibilidad')) {
                $table->enum('visibilidad', ['publica', 'privada'])->default('publica')->after('categoria');
            }
        });

        Schema::table('usuarios', function (Blueprint $table) {
            if (!Schema::hasColumn('usuarios', 'perfil_privado')) {
                $table->boolean('perfil_privado')->default(false)->after('biografia');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seguidores', function (Blueprint $table) {
            $table->dropUnique('seguidores_unicos');
            if (Schema::hasColumn('seguidores', 'estado')) {
                $table->dropColumn('estado');
            }
        });

        Schema::table('publicaciones', function (Blueprint $table) {
            if (Schema::hasColumn('publicaciones', 'visibilidad')) {
                $table->dropColumn('visibilidad');
            }
        });

        Schema::table('usuarios', function (Blueprint $table) {
            if (Schema::hasColumn('usuarios', 'perfil_privado')) {
                $table->dropColumn('perfil_privado');
            }
        });
    }
};
