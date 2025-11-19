<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'nivel',
        'horas_semanales',
        'creditos',
        'estado'
    ];

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }
}
