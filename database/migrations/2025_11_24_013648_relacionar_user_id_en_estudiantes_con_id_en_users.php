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
        // Actualiza estudiantes.user_id según users.id donde coincida el email
        DB::statement("
            UPDATE estudiantes e
            INNER JOIN users u ON e.email = u.email
            SET e.user_id = u.id
            WHERE e.user_id IS NULL;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revierte el cambio: pone NULL donde coincida por email
        DB::statement("
            UPDATE estudiantes
            SET user_id = NULL
            WHERE user_id IS NOT NULL;
        ");
    }
};
