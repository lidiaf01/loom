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
        Schema::table('carpetas', function (Blueprint $table) {
            if (!Schema::hasColumn('carpetas', 'color')) {
                $table->string('color', 20)->default('pink')->after('nombre');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carpetas', function (Blueprint $table) {
            if (Schema::hasColumn('carpetas', 'color')) {
                $table->dropColumn('color');
            }
        });
    }
};
