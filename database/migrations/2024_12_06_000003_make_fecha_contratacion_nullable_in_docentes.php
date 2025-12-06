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
        // Verificar si la columna existe antes de modificarla
        if (Schema::hasColumn('docentes', 'fecha_contratacion')) {
            Schema::table('docentes', function (Blueprint $table) {
                $table->date('fecha_contratacion')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('docentes', 'fecha_contratacion')) {
            Schema::table('docentes', function (Blueprint $table) {
                $table->date('fecha_contratacion')->nullable(false)->change();
            });
        }
    }
};
