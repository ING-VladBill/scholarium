@extends('layouts.app')
@section('title', 'Seleccionar Asignatura')
@section('content')
<div class="container my-5">
    <h2 class="text-primary mb-4">Paso 2: Seleccione una Asignatura</h2>
    <div class="alert alert-info">
        <strong>Curso:</strong> {{ $curso->nombre }} ({{ $curso->nivel }})
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                @forelse($asignaturas as $asignatura)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $asignatura->nombre }}</h5>
                            <p class="small text-muted">{{ $asignatura->codigo }} - {{ $asignatura->horas_semanales }} hrs/semana</p>
                            <a href="{{ route('asignaciones.seleccionar-docente', [$curso->id, $asignatura->id]) }}" class="btn btn-primary btn-sm">
                                Continuar
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted">No hay asignaturas disponibles para este nivel.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
