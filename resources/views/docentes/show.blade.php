@extends('layouts.app')

@section('title', 'Detalle del Docente')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="bi bi-person-badge me-2"></i>Detalle del Docente</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">DNI:</th>
                                    <td>{{ $docente->dni }}</td>
                                </tr>
                                <tr>
                                    <th>Nombres:</th>
                                    <td>{{ $docente->nombres }}</td>
                                </tr>
                                <tr>
                                    <th>Apellidos:</th>
                                    <td>{{ $docente->apellidos }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $docente->email }}</td>
                                </tr>
                                <tr>
                                    <th>Teléfono:</th>
                                    <td>{{ $docente->telefono ?? 'No registrado' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-primary">Información Laboral</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="50%">Especialidad:</th>
                                    <td><span class="badge bg-info">{{ $docente->especialidad }}</span></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Contratación:</th>
                                    <td>{{ $docente->fecha_contratacion->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        <span class="badge {{ $docente->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $docente->estado }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5 class="text-primary mb-3">
                            <i class="bi bi-calendar-check me-2"></i>Asignaciones Actuales
                        </h5>
                        
                        @if($docente->asignaciones->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Curso</th>
                                            <th>Asignatura</th>
                                            <th>Día</th>
                                            <th>Horario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($docente->asignaciones as $asignacion)
                                        <tr>
                                            <td>{{ $asignacion->curso->nombre }}</td>
                                            <td>{{ $asignacion->asignatura->nombre }}</td>
                                            <td>{{ $asignacion->dia_semana }}</td>
                                            <td>{{ $asignacion->hora_inicio }} - {{ $asignacion->hora_fin }}</td>
                                            <td>
                                                <span class="badge {{ $asignacion->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $asignacion->estado }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Este docente no tiene asignaciones registradas.
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('docentes.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Volver
                        </a>
                        <a href="{{ route('docentes.edit', $docente) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
