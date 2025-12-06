@extends('layouts.app')

@section('title', 'Dashboard Profesor')

@section('content')
<div class="container my-5">
    @php
        $user = auth()->user();
        $docente = \App\Models\Docente::where('id', $user->docente_id)->first();
        
        if ($docente) {
            $asignaciones = $docente->asignaciones()->where('estado', 'Activo')->with(['curso', 'asignatura'])->get();
            $totalAsignaciones = $asignaciones->count();
            $cursosUnicos = $asignaciones->pluck('curso_id')->unique()->count();
            $horasSemanales = $asignaciones->sum(function($asignacion) {
                return $asignacion->asignatura->horas_semanales ?? 0;
            });
            
            // Organizar horario por día
            $horarioPorDia = [
                'Lunes' => [],
                'Martes' => [],
                'Miércoles' => [],
                'Jueves' => [],
                'Viernes' => [],
            ];
            
            foreach ($asignaciones as $asignacion) {
                $dia = $asignacion->dia_semana;
                if (isset($horarioPorDia[$dia])) {
                    $horarioPorDia[$dia][] = $asignacion;
                }
            }
        } else {
            $totalAsignaciones = 0;
            $cursosUnicos = 0;
            $horasSemanales = 0;
            $horarioPorDia = [];
        }
    @endphp

    <!-- Encabezado -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-primary mb-0">
                    <i class="bi bi-person-badge me-2"></i>
                    Bienvenido, Profesor {{ $user->name }}
                </h2>
                <a href="{{ route('profesor.perfil') }}" class="btn btn-outline-primary">
                    <i class="fas fa-user-cog"></i> Mi Perfil
                </a>
            </div>
            @if($docente)
                <p class="text-muted mb-0">
                    <i class="bi bi-envelope me-2"></i>{{ $docente->email }}
                    <span class="mx-2">|</span>
                    <i class="bi bi-book me-2"></i>{{ $docente->especialidad }}
                </p>
            @endif
        </div>
    </div>

    @if(!$docente)
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Perfil Incompleto:</strong> No se encontró tu registro de docente. Contacta al administrador.
        </div>
    @else
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
                        <h3 class="mt-2 mb-0" style="font-size: 1.2rem;">{{ $docente->especialidad }}</h3>
                        <p class="text-muted mb-0">Especialidad</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Horario Semanal -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week me-2"></i>Mi Horario Semanal</h5>
            </div>
            <div class="card-body">
                @if($totalAsignaciones > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="min-width: 900px;">
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

                    <!-- Distribución de Clases -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="text-primary">Distribución de Clases por Día</h6>
                            <div class="progress" style="height: 30px;">
                                @php
                                    $colores = ['bg-primary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];
                                    $index = 0;
                                @endphp
                                @foreach($horarioPorDia as $dia => $asignacionesDia)
                                    @if(count($asignacionesDia) > 0)
                                        @php
                                            $porcentaje = ($totalAsignaciones > 0) ? (count($asignacionesDia) / $totalAsignaciones) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar {{ $colores[$index % 5] }}" 
                                             role="progressbar" 
                                             style="width: {{ $porcentaje }}%"
                                             title="{{ $dia }}: {{ count($asignacionesDia) }} clases">
                                            {{ $dia }}: {{ count($asignacionesDia) }}
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
                        No tienes asignaciones registradas aún. Contacta al administrador para que te asigne clases.
                    </div>
                @endif
            </div>
        </div>

        <!-- Mis Cursos -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-book me-2"></i>Mis Cursos Asignados</h5>
            </div>
            <div class="card-body">
                @if($totalAsignaciones > 0)
                    <div class="table-responsive">
                        <table class="table table-hover" style="min-width: 900px;">
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
                                @foreach($asignaciones as $asignacion)
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
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        No tienes cursos asignados aún.
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection
