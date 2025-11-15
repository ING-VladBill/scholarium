@extends('layouts.app')

@section('title', 'Detalle de Matrícula')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-dorado">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-file-text"></i> Detalle de Matrícula</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary"><i class="bi bi-person-circle"></i> Información del Estudiante</h5>
                            <hr>
                            <p><strong>DNI:</strong> {{ $matricula->estudiante->dni }}</p>
                            <p><strong>Nombres:</strong> {{ $matricula->estudiante->nombres }}</p>
                            <p><strong>Apellidos:</strong> {{ $matricula->estudiante->apellidos }}</p>
                            <p><strong>Edad:</strong> {{ \Carbon\Carbon::parse($matricula->estudiante->fecha_nacimiento)->age }} años</p>
                            <p><strong>Email:</strong> {{ $matricula->estudiante->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary"><i class="bi bi-book"></i> Información del Curso</h5>
                            <hr>
                            <p><strong>Curso:</strong> {{ $matricula->curso->nombre }}</p>
                            <p><strong>Nivel:</strong> {{ $matricula->curso->nivel }}</p>
                            <p><strong>Grado:</strong> {{ $matricula->curso->grado }}</p>
                            <p><strong>Sección:</strong> {{ $matricula->curso->seccion }}</p>
                            <p><strong>Año Académico:</strong> {{ $matricula->curso->anio_academico }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary"><i class="bi bi-calendar-check"></i> Información de la Matrícula</h5>
                            <hr>
                            <p><strong>Fecha de Matrícula:</strong> {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}</p>
                            <p><strong>Estado:</strong> 
                                <span class="badge bg-{{ $matricula->estado == 'Matriculado' ? 'success' : 'secondary' }}">
                                    {{ $matricula->estado }}
                                </span>
                            </p>
                            @if($matricula->observaciones)
                            <p><strong>Observaciones:</strong> {{ $matricula->observaciones }}</p>
                            @endif
                            <p><strong>Registrada el:</strong> {{ $matricula->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('matriculas.listar') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Volver al Listado
                        </a>
                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-dorado">
                            <i class="bi bi-pencil"></i> Editar Matrícula
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
