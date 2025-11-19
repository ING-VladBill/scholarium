<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('matriculas', function (Blueprint $table) {
            $table->string('estado')->default('Pendiente')->change();
        });
        
        DB::statement("ALTER TABLE matriculas MODIFY estado ENUM('Pendiente', 'Aprobada', 'Rechazada', 'Retirado') DEFAULT 'Pendiente'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE matriculas MODIFY estado ENUM('Matriculado', 'Retirado') DEFAULT 'Matriculado'");
    }
};
