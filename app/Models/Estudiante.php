<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'user_id',
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

    // Relación: Un estudiante pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    // Verificar si el DNI es temporal (comienza con 00000)
    public function tieneDniTemporal()
    {
        return substr($this->dni, 0, 5) === '00000';
    }

    // Verificar si tiene datos incompletos
    public function tieneDatosIncompletos()
    {
        return $this->tieneDniTemporal() 
            || empty($this->telefono) 
            || empty($this->direccion);
    }

    // Obtener lista de campos faltantes
    public function getCamposFaltantes()
    {
        $faltantes = [];
        
        if ($this->tieneDniTemporal()) {
            $faltantes[] = 'DNI real';
        }
        
        if (empty($this->telefono)) {
            $faltantes[] = 'Teléfono';
        }
        
        if (empty($this->direccion)) {
            $faltantes[] = 'Dirección';
        }
        
        return $faltantes;
    }

    // Obtener porcentaje de completitud de datos
    public function getPorcentajeCompletitud()
    {
        $camposObligatorios = ['dni', 'telefono', 'direccion'];
        $camposCompletos = 0;
        
        if (!$this->tieneDniTemporal()) {
            $camposCompletos++;
        }
        
        if (!empty($this->telefono)) {
            $camposCompletos++;
        }
        
        if (!empty($this->direccion)) {
            $camposCompletos++;
        }
        
        return round(($camposCompletos / count($camposObligatorios)) * 100);
    }
}
