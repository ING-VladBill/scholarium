<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'nivel',
        'grado',
        'seccion',
        'anio_academico',
        'capacidad_maxima',
        'sala',
        'estado'
    ];

    // Relación: Un curso puede tener muchas matrículas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    // Relación: Un curso puede tener muchos estudiantes a través de matrículas
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'matriculas')
                    ->withPivot('fecha_matricula', 'estado', 'observaciones')
                    ->withTimestamps();
    }

    // Accessor para cupos disponibles
    public function getCuposDisponiblesAttribute()
    {
        $matriculados = $this->matriculas()->where('estado', 'Matriculado')->count();
        return $this->capacidad_maxima - $matriculados;
    }

    // Accessor para cantidad de estudiantes matriculados
    public function getEstudiantesMatriculadosAttribute()
    {
        return $this->matriculas()->where('estado', 'Matriculado')->count();
    }

    // Verificar si el curso está lleno
    public function estaLleno()
    {
        return $this->cupos_disponibles <= 0;
    }

    // Obtener porcentaje de ocupación
    public function getPorcentajeOcupacionAttribute()
    {
        if ($this->capacidad_maxima == 0) {
            return 0;
        }
        return round(($this->estudiantes_matriculados / $this->capacidad_maxima) * 100);
    }
}
