<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publicaciones', function (Blueprint $table) {
    $table->id('id_publicacion');
    $table->string('titulo');
    $table->text('contenido');
    $table->dateTime('fecha_subida');
    
    // Campo LONGBLOB
    $table->binary('contenido_visual')->nullable(); 
    
    // Relación 1:N con Usuario
    $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
    
    $table->timestamp('fecha_creacion')->nullable();
    $table->timestamp('fecha_actualizacion')->nullable();
});

// Opcional: Si necesitas asegurarte que sea LONGBLOB en MySQL:
// DB::statement("ALTER TABLE publicaciones MODIFY contenido_visual LONGBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
