@extends('layouts.app')

@section('title', 'Seleccionar Estudiante')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-clipboard-plus-fill"></i> Proceso de Matrícula - Paso 2: Seleccionar Estudiante</h2>

    <!-- Información del Curso Seleccionado -->
    <div class="card mb-4" style="border-left: 4px solid var(--vinotinto-oscuro);">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2" style="color: var(--vinotinto-oscuro);">
                        <i class="bi bi-book-fill"></i> {{ $curso->nombre }}
                    </h4>
                    <p class="mb-0">
                        <strong>Nivel:</strong> {{ $curso->nivel }} | 
                        <strong>Año:</strong> {{ $curso->anio_academico }} | 
                        <strong>Sala:</strong> {{ $curso->sala ?? 'N/A' }}
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <p class="mb-1"><strong>Cupos Disponibles:</strong></p>
                    <span class="badge bg-success" style="font-size: 1.2rem;">
                        {{ $curso->cupos_disponibles }} de {{ $curso->capacidad_maxima }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert alert-info">
        <i class="bi bi-info-circle-fill"></i> <strong>Instrucciones:</strong> Seleccione el estudiante que desea matricular en este curso. Solo se muestran estudiantes activos.
    </div>

    @if($estudiantes->count() > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-people-fill"></i> Estudiantes Disponibles</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>Nombre Completo</th>
                                <th>Fecha Nacimiento</th>
                                <th>Email</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->rut }}</td>
                                    <td><strong>{{ $estudiante->nombre_completo }}</strong></td>
                                    <td>{{ $estudiante->fecha_nacimiento->format('d/m/Y') }}</td>
                                    <td>{{ $estudiante->email ?? 'N/A' }}</td>
                                    <td>
                                        <form action="{{ route('matriculas.store') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                                            <input type="hidden" name="estudiante_id" value="{{ $estudiante->id }}">
                                            <input type="hidden" name="fecha_matricula" value="{{ date('Y-m-d') }}">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                    onclick="return confirm('¿Confirma la matrícula de {{ $estudiante->nombre_completo }} en {{ $curso->nombre }}?');">
                                                <i class="bi bi-check-circle-fill"></i> Matricular
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                <p class="mt-3 text-muted">No hay estudiantes activos disponibles para matricular.</p>
                <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Crear Estudiante
                </a>
            </div>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('matriculas.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a Selección de Curso
        </a>
    </div>

    <div class="alert alert-warning mt-4">
        <i class="bi bi-info-circle-fill"></i> <strong>Nota para Entrega 1:</strong> Este flujo está parcialmente implementado. En la Entrega Final se agregará una página de confirmación con más detalles antes de completar la matrícula.
    </div>
</div>
@endsection
