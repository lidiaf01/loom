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
      Schema::create('carpetas', function (Blueprint $table) {
    $table->id('id_Carpeta');
    $table->string('nombre');
    
    // Relación 1:N con Biblioteca
    $table->foreignId('biblioteca_id')->constrained('bibliotecas')->onDelete('cascade');
    
    $table->timestamp('fecha_creacion')->nullable();
    $table->timestamp('fecha_modif')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};
