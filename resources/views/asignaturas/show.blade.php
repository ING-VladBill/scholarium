@extends('layouts.app')

@section('title', 'Detalle de Asignatura')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0"><i class="bi bi-book me-2"></i>Detalle de Asignatura</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Información General</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Código:</th>
                                    <td><span class="badge bg-secondary">{{ $asignatura->codigo }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nombre:</th>
                                    <td>{{ $asignatura->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Nivel:</th>
                                    <td><span class="badge {{ $asignatura->nivel == 'Básica' ? 'bg-info' : 'bg-warning' }}">{{ $asignatura->nivel }}</span></td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        <span class="badge {{ $asignatura->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $asignatura->estado }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-primary">Detalles Académicos</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="50%">Horas Semanales:</th>
                                    <td>{{ $asignatura->horas_semanales }} horas</td>
                                </tr>
                                <tr>
                                    <th>Créditos:</th>
                                    <td>{{ $asignatura->creditos }}</td>
                                </tr>
                                <tr>
                                    <th>Descripción:</th>
                                    <td>{{ $asignatura->descripcion ?? 'Sin descripción' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="mt-4">
                        <h5 class="text-primary mb-3">
                            <i class="bi bi-calendar-check me-2"></i>Asignaciones en Cursos
                        </h5>
                        
                        @if($asignatura->asignaciones->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Curso</th>
                                            <th>Docente</th>
                                            <th>Día</th>
                                            <th>Horario</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($asignatura->asignaciones as $asignacion)
                                        <tr>
                                            <td>{{ $asignacion->curso->nombre }}</td>
                                            <td>{{ $asignacion->docente->nombre_completo }}</td>
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
                                Esta asignatura no está asignada a ningún curso.
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('asignaturas.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Volver
                        </a>
                        <a href="{{ route('asignaturas.edit', $asignatura) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
