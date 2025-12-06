<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Actualizar todos los usuarios con rol 'docente' a 'profesor'
        DB::table('users')
            ->where('role', 'docente')
            ->update(['role' => 'profesor']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir: cambiar 'profesor' de vuelta a 'docente'
        DB::table('users')
            ->where('role', 'profesor')
            ->update(['role' => 'docente']);
    }
};
