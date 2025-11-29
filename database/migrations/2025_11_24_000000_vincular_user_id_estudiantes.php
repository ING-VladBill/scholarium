<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Vincular estudiantes con usuarios por email
        DB::statement("
            UPDATE estudiantes e
            INNER JOIN users u ON e.email = u.email
            SET e.user_id = u.id
            WHERE e.user_id IS NULL
        ");
        
        echo "\n✅ Estudiantes vinculados con usuarios exitosamente.\n";
        
        // Mostrar cuántos se vincularon
        $vinculados = DB::table('estudiantes')
                       ->whereNotNull('user_id')
                       ->count();
        
        echo "📊 Total de estudiantes con user_id vinculado: {$vinculados}\n\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No revertir automáticamente por seguridad
        echo "\n⚠️  No se puede revertir automáticamente esta migración.\n";
        echo "Si necesitas deshacer los cambios, hazlo manualmente en la base de datos.\n\n";
    }
};
