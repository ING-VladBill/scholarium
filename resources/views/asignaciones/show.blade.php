@extends('layouts.app')
@section('title', 'Detalle de Asignación')
@section('content')
<div class="container py-4">
    <div class="card card-dorado">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-file-text"></i> Detalle de Asignación</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="bi bi-person-badge"></i> Docente</h5>
                    <hr>
                    <p><strong>DNI:</strong> {{ $asignacion->docente->dni }}</p>
                    <p><strong>Nombre:</strong> {{ $asignacion->docente->nombres }} {{ $asignacion->docente->apellidos }}</p>
                    <p><strong>Especialidad:</strong> {{ $asignacion->docente->especialidad }}</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="bi bi-book"></i> Asignatura</h5>
                    <hr>
                    <p><strong>Código:</strong> {{ $asignacion->asignatura->codigo }}</p>
                    <p><strong>Nombre:</strong> {{ $asignacion->asignatura->nombre }}</p>
                    <p><strong>Nivel:</strong> {{ $asignacion->asignatura->nivel }}</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-primary"><i class="bi bi-calendar"></i> Curso y Horario</h5>
                    <hr>
                    <p><strong>Curso:</strong> {{ $asignacion->curso->nombre }}</p>
                    <p><strong>Horario:</strong> {{ $asignacion->horario }}</p>
                    <p><strong>Registrada:</strong> {{ $asignacion->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('asignaciones.listar') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
                <a href="{{ route('asignaciones.edit', $asignacion->id) }}" class="btn btn-dorado">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
