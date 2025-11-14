@extends('layouts.app')

@section('title', 'Detalle del Curso')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-book-fill"></i> Detalle del Curso</h2>
        <div>
            <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning">
                <i class="bi bi-pencil-fill"></i> Editar
            </a>
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill"></i> Información del Curso</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nombre:</strong>
                            <p class="h4">{{ $curso->nombre }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <p>
                                <span class="badge {{ $curso->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                    {{ $curso->estado }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nivel:</strong>
                            <p>{{ $curso->nivel }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Grado:</strong>
                            <p>{{ $curso->grado }}°</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Sección:</strong>
                            <p>{{ $curso->seccion }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Año Académico:</strong>
                            <p>{{ $curso->anio_academico }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Sala:</strong>
                            <p>{{ $curso->sala ?? 'No asignada' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <strong>Capacidad Máxima:</strong>
                            <p>{{ $curso->capacidad_maxima }} estudiantes</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Estudiantes Matriculados:</strong>
                            <p>{{ $curso->estudiantes_matriculados }} estudiantes</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Cupos Disponibles:</strong>
                            <p>
                                <span class="badge bg-info">
                                    {{ $curso->cupos_disponibles }} cupos
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-people-fill"></i> Estudiantes Matriculados</h5>
                </div>
                <div class="card-body">
                    @if($curso->matriculas->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>RUT</th>
                                        <th>Nombre Completo</th>
                                        <th>Fecha Matrícula</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($curso->matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->estudiante->rut }}</td>
                                            <td>{{ $matricula->estudiante->nombre_completo }}</td>
                                            <td>{{ $matricula->fecha_matricula->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $matricula->estado == 'Matriculado' ? 'badge-activo' : 'badge-inactivo' }}">
                                                    {{ $matricula->estado }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-3">
                            <i class="bi bi-inbox"></i> Este curso no tiene estudiantes matriculados.
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-gear-fill"></i> Acciones</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-fill"></i> Editar Curso
                        </a>
                        <form action="{{ route('cursos.destroy', $curso) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿Está seguro de eliminar este curso? Esta acción no se puede deshacer.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash-fill"></i> Eliminar Curso
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Información del Registro</h6>
                    <small class="text-muted">
                        <strong>Creado:</strong><br>
                        {{ $curso->created_at->format('d/m/Y H:i') }}<br><br>
                        <strong>Última actualización:</strong><br>
                        {{ $curso->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
