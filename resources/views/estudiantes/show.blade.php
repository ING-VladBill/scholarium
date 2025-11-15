@extends('layouts.app')

@section('title', 'Detalle del Estudiante')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-fill"></i> Detalle del Estudiante</h2>
        <div>
            <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-warning">
                <i class="bi bi-pencil-fill"></i> Editar
            </a>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill"></i> Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>DNI:</strong>
                            <p>{{ $estudiante->dni }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Nombre Completo:</strong>
                            <p>{{ $estudiante->nombre_completo }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Fecha de Nacimiento:</strong>
                            <p>{{ $estudiante->fecha_nacimiento->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Género:</strong>
                            <p>{{ $estudiante->genero }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Email:</strong>
                            <p>{{ $estudiante->email ?? 'No registrado' }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Teléfono:</strong>
                            <p>{{ $estudiante->telefono ?? 'No registrado' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Dirección:</strong>
                            <p>{{ $estudiante->direccion ?? 'No registrada' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Fecha de Ingreso:</strong>
                            <p>{{ $estudiante->fecha_ingreso->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <p>
                                <span class="badge {{ $estudiante->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                    {{ $estudiante->estado }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-clipboard-check-fill"></i> Matrículas</h5>
                </div>
                <div class="card-body">
                    @if($estudiante->matriculas->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Curso</th>
                                        <th>Fecha Matrícula</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($estudiante->matriculas as $matricula)
                                        <tr>
                                            <td>{{ $matricula->curso->nombre }}</td>
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
                            <i class="bi bi-inbox"></i> Este estudiante no tiene matrículas registradas.
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
                        <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-fill"></i> Editar Estudiante
                        </a>
                        <form action="{{ route('estudiantes.destroy', $estudiante) }}" 
                              method="POST" 
                              onsubmit="return confirm('¿Está seguro de eliminar este estudiante? Esta acción no se puede deshacer.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash-fill"></i> Eliminar Estudiante
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
                        {{ $estudiante->created_at->format('d/m/Y H:i') }}<br><br>
                        <strong>Última actualización:</strong><br>
                        {{ $estudiante->updated_at->format('d/m/Y H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
