<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'estudiante_id',
        'curso_id',
        'fecha_matricula',
        'estado',
        'observaciones'
    ];

    protected $casts = [
        'fecha_matricula' => 'date',
    ];

    // Relación: Una matrícula pertenece a un estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }

    // Relación: Una matrícula pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
