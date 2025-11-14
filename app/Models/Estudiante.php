<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'email',
        'genero',
        'foto',
        'estado',
        'fecha_ingreso'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
    ];

    // Relación: Un estudiante puede tener muchas matrículas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    // Relación: Un estudiante puede estar en muchos cursos a través de matrículas
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'matriculas')
                    ->withPivot('fecha_matricula', 'estado', 'observaciones')
                    ->withTimestamps();
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}
