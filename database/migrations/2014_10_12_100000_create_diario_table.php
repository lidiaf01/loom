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
        Schema::create('diarios', function (Blueprint $table) {
    $table->id('id_entrada');
    $table->string('titulo');
    $table->text('contenido');
    $table->dateTime('fecha_entrada');
    $table->string('estado_animo')->nullable();
    
    // Relación 1:1 con Usuario
    $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
    
    $table->timestamp('fecha_creacion')->nullable();
    $table->timestamp('fecha_actualizacion')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
