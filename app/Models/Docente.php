<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'especialidad',
        'fecha_contratacion',
        'estado'
    ];

    protected $casts = [
        'fecha_contratacion' => 'date',
    ];

    // Relación con asignaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}
