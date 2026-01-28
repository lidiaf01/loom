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
        Schema::table('publicaciones', function (Blueprint $table) {
            $table->enum('categoria', [
                'Salud & Bienestar',
                'Ejercicio & Movimiento',
                'Hobbies & Creatividad',
                'Cocina & Nutrición',
                'Desarrollo Personal',
                'Meditación & Mindfulness',
                'Relaciones & Familia',
                'Finanzas & Productividad',
                'Viajes & Aventuras',
                'Arte & Cultura',
            ])->nullable()->after('contenido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicaciones', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};
