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
        // Verificar si la columna no existe antes de agregarla
        if (!Schema::hasColumn('users', 'docente_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('docente_id')->nullable()->after('role');
                $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'docente_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['docente_id']);
                $table->dropColumn('docente_id');
            });
        }
    }
};
