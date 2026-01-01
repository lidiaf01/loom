<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carpeta_publicacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publicacion_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('carpeta_id')->nullable();
            $table->timestamp('fecha_añadido')->useCurrent();
            $table->timestamps();

            $table->foreign('publicacion_id')->references('id_publicacion')->on('publicaciones')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('carpeta_id')->references('id_Carpeta')->on('carpetas')->onDelete('set null');
            $table->unique(['usuario_id', 'publicacion_id'], 'carpeta_publicacion_unica');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carpeta_publicacion');
    }
};
