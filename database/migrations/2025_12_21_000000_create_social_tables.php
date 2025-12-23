<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // 1. Relación SIGUE (N:M entre Usuarios)
        Schema::create('seguidores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seguidor_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('seguido_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });

        // 2. MENSAJES (1:N)
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->text('contenido');
            $table->foreignId('emisor_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('receptor_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamp('fecha_envio')->useCurrent();
        });

        // 3. CATEGORÍAS
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        // 4. LISTAS (1:N con Usuario)
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });

        // 5. Tabla Pivot: CATEGORIA - PUBLICACIÓN (N:M)
        Schema::create('categoria_publicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacion_id')->constrained('publicaciones', 'id_publicacion');
            $table->foreignId('categoria_id')->constrained('categorias');
        });

        // 6. Tabla Pivot: LISTA - PUBLICACIÓN (N:M "Contiene")
        Schema::create('lista_publicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lista_id')->constrained('listas')->onDelete('cascade');
            $table->foreignId('publicacion_id')->constrained('publicaciones', 'id_publicacion')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('lista_publicacion');
        Schema::dropIfExists('categoria_publicacion');
        Schema::dropIfExists('listas');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('mensajes');
        Schema::dropIfExists('seguidores');
    }
};