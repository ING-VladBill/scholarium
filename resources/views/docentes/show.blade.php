@extends('layouts.app')

@section('title', 'Dashboard del Docente')

@section('content')
<div class="container my-5">
    <!-- Encabezado con información del docente -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="text-primary">
                <i class="bi bi-person-badge me-2"></i>
                {{ $docente->nombres }} {{ $docente->apellidos }}
            </h2>
            <p class="text-muted mb-0">
                <i class="bi bi-envelope me-2"></i>{{ $docente->email }}
                <span class="mx-2">|</span>
                <i class="bi bi-card-text me-2"></i>DNI: {{ $docente->dni }}
                <span class="mx-2">|</span>
                <span class="badge {{ $docente->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $docente->estado }}
                </span>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('docentes.edit', $docente) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Editar
            </a>
            <a href="{{ route('docentes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-primary">
                <div class="card-body">
                    <i class="bi bi-calendar-check text-primary" style="font-size: 2.5rem;"></i>
                    <h3 class="mt-2 mb-0">{{ $totalAsignaciones }}</h3>
                    <p class="text-muted mb-0">Asignaciones</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-info">
                <div class="card-body">
                    <i class="bi bi-people text-info" style="font-size: 2.5rem;"></i>
                    <h3 class="mt-2 mb-0">{{ $cursosUnicos }}</h3>
                    <p class="text-muted mb-0">Cursos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-warning">
                <div class="card-body">
                    <i class="bi bi-clock text-warning" style="font-size: 2.5rem;"></i>
                    <h3 class="mt-2 mb-0">{{ $horasSemanales }}</h3>
                    <p class="text-muted mb-0">Horas/Semana</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-success">
                <div class="card-body">
                    <i class="bi bi-book text-success" style="font-size: 2.5rem;"></i>
                    <h3 class="mt-2 mb-0">{{ $docente->especialidad }}</h3>
                    <p class="text-muted mb-0">Especialidad</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Horario Semanal -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i>Horario Semanal</h5>
        </div>
        <div class="card-body">
            @if($totalAsignaciones > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="15%">Día</th>
                                <th>Clases</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($horarioPorDia as $dia => $asignaciones)
                                <tr>
                                    <td class="fw-bold">{{ $dia }}</td>
                                    <td>
                                        @if(count($asignaciones) > 0)
                                            @foreach($asignaciones as $asignacion)
                                                <div class="mb-2 p-2 border-start border-primary border-3 bg-light">
                                                    <strong>{{ $asignacion->hora_inicio }} - {{ $asignacion->hora_fin }}</strong>
                                                    <br>
                                                    <span class="text-primary">{{ $asignacion->asignatura->nombre }}</span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="bi bi-people me-1"></i>{{ $asignacion->curso->nombre }}
                                                    </small>
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Sin clases</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Resumen de distribución -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h6 class="text-primary">Distribución de Clases por Día</h6>
                        <div class="progress" style="height: 30px;">
                            @php
                                $colores = ['bg-primary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];
                                $index = 0;
                            @endphp
                            @foreach($horarioPorDia as $dia => $asignaciones)
                                @if(count($asignaciones) > 0)
                                    @php
                                        $porcentaje = ($totalAsignaciones > 0) ? (count($asignaciones) / $totalAsignaciones) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar {{ $colores[$index % 5] }}" 
                                         role="progressbar" 
                                         style="width: {{ $porcentaje }}%"
                                         title="{{ $dia }}: {{ count($asignaciones) }} clases">
                                        {{ $dia }}: {{ count($asignaciones) }}
                                    </div>
                                    @php $index++; @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Este docente no tiene asignaciones registradas aún.
                </div>
            @endif
        </div>
    </div>

    <!-- Información Adicional -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-person me-2"></i>Información Personal</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
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
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0"><i class="bi bi-briefcase me-2"></i>Información Laboral</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="40%">Especialidad:</th>
                            <td><span class="badge bg-info">{{ $docente->especialidad }}</span></td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <span class="badge {{ $docente->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $docente->estado }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Asignaciones:</th>
                            <td>{{ $totalAsignaciones }}</td>
                        </tr>
                        <tr>
                            <th>Cursos Asignados:</th>
                            <td>{{ $cursosUnicos }}</td>
                        </tr>
                        <tr>
                            <th>Carga Horaria:</th>
                            <td>{{ $horasSemanales }} horas/semana</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
