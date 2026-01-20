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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('contrasenha');
            $table->date('fecha_nac')->nullable();
            $table->text('biografia')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->boolean('diario_privado')->default(true); // true = privado, false = público
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_modif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
