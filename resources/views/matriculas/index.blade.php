@extends('layouts.app')

@section('title', 'Nueva Matrícula')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-clipboard-plus-fill"></i> Proceso de Matrícula - Paso 1: Seleccionar Curso</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert alert-info">
        <i class="bi bi-info-circle-fill"></i> <strong>Instrucciones:</strong> Seleccione el curso en el cual desea matricular a un estudiante. Solo se muestran cursos activos con cupos disponibles.
    </div>

    @if($cursos->count() > 0)
        <div class="row">
            @foreach($cursos as $curso)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--vinotinto-oscuro);">
                                <i class="bi bi-book-fill"></i> {{ $curso->nombre }}
                            </h5>
                            <hr>
                            <p class="mb-2">
                                <strong>Nivel:</strong> {{ $curso->nivel }}<br>
                                <strong>Año Académico:</strong> {{ $curso->anio_academico }}<br>
                                <strong>Sala:</strong> {{ $curso->sala ?? 'N/A' }}
                            </p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <small class="text-muted">Capacidad</small>
                                    <p class="mb-0"><strong>{{ $curso->capacidad_maxima }}</strong></p>
                                </div>
                                <div>
                                    <small class="text-muted">Matriculados</small>
                                    <p class="mb-0"><strong>{{ $curso->estudiantes_matriculados }}</strong></p>
                                </div>
                                <div>
                                    <small class="text-muted">Disponibles</small>
                                    <p class="mb-0">
                                        <span class="badge bg-success">{{ $curso->cupos_disponibles }}</span>
                                    </p>
                                </div>
                            </div>
                            
                            @if($curso->cupos_disponibles > 0)
                                <a href="{{ route('matriculas.seleccionar', $curso->id) }}" 
                                   class="btn btn-primary w-100">
                                    <i class="bi bi-arrow-right-circle-fill"></i> Seleccionar Curso
                                </a>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="bi bi-x-circle-fill"></i> Sin Cupos
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                <p class="mt-3 text-muted">No hay cursos activos disponibles para matrícula.</p>
                <a href="{{ route('cursos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Crear Curso
                </a>
            </div>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Dashboard
        </a>
        <a href="{{ route('matriculas.listar') }}" class="btn btn-info">
            <i class="bi bi-list-check"></i> Ver Todas las Matrículas
        </a>
    </div>
</div>
@endsection
