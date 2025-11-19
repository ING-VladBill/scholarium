@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1 class="display-5"><i class="bi bi-speedometer2"></i> Dashboard Administrador</h1>
        <p class="lead">Bienvenido, {{ Auth::user()->name }}</p>
    </div>
</div>

<div class="container">
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

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-people-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    <h2 class="mt-3">{{ $totalEstudiantes }}</h2>
                    <p class="text-muted mb-0">Estudiantes Registrados</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-book-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    <h2 class="mt-3">{{ $totalCursos }}</h2>
                    <p class="text-muted mb-0">Cursos Activos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-clipboard-check-fill" style="font-size: 3rem; color: var(--vinotinto-oscuro);"></i>
                    <h2 class="mt-3">{{ $totalMatriculas }}</h2>
                    <p class="text-muted mb-0">Matrículas Activas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('estudiantes.index', ['datos' => 'incompletos']) }}" class="text-decoration-none">
                <div class="card text-center border-warning hover-card">
                    <div class="card-body">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem; color: #ffc107;"></i>
                        <h2 class="mt-3 text-warning">{{ $estudiantesIncompletos }}</h2>
                        <p class="text-muted mb-0">Datos Incompletos</p>
                        @if($estudiantesIncompletos > 0)
                            <small class="text-warning"><i class="bi bi-arrow-right"></i> Ver listado</small>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Accesos Rápidos -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-3" style="color: var(--vinotinto-oscuro);">
                <i class="bi bi-lightning-fill"></i> Accesos Rápidos
            </h3>
        </div>
        
        <div class="col-md-3 mb-3">
            <a href="{{ route('estudiantes.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Gestionar Estudiantes</h5>
                        <p class="text-muted small">Ver, crear, editar y eliminar estudiantes</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('cursos.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-book-fill" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Gestionar Cursos</h5>
                        <p class="text-muted small">Ver, crear, editar y eliminar cursos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('matriculas.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard-plus-fill" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Nueva Matrícula</h5>
                        <p class="text-muted small">Matricular estudiante en un curso</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('matriculas.listar') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-list-check" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Ver Matrículas</h5>
                        <p class="text-muted small">Listar todas las matrículas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Segunda fila de accesos rápidos -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <a href="{{ route('docentes.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge-fill" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Gestionar Docentes</h5>
                        <p class="text-muted small">Ver, crear, editar y eliminar docentes</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('asignaturas.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-book-half" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Gestionar Asignaturas</h5>
                        <p class="text-muted small">Ver, crear, editar y eliminar asignaturas</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('asignaciones.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-week" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Nueva Asignación</h5>
                        <p class="text-muted small">Asignar docente a asignatura en curso</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('matriculas.solicitudes') }}" class="text-decoration-none">
                <div class="card h-100 hover-card position-relative">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard-check" style="font-size: 2.5rem; color: var(--dorado);"></i>
                        <h5 class="mt-3">Solicitudes de Matrícula</h5>
                        <p class="text-muted small">Aprobar o rechazar solicitudes</p>
                        @php
                            $pendientes = \App\Models\Matricula::where('estado', 'Pendiente')->count();
                        @endphp
                        @if($pendientes > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $pendientes }}
                            </span>
                        @endif
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('asignaciones.listar') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-list-ul" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Ver Asignaciones</h5>
                        <p class="text-muted small">Listar todas las asignaciones</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('contactos.index') }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-envelope-fill" style="font-size: 2.5rem; color: var(--vinotinto-oscuro);"></i>
                        <h5 class="mt-3">Mensajes de Contacto</h5>
                        <p class="text-muted small">Ver mensajes recibidos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('admin.register') }}" class="text-decoration-none">
                <div class="card h-100 hover-card border-warning">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-fill-plus" style="font-size: 2.5rem; color: var(--dorado);"></i>
                        <h5 class="mt-3">Registrar Administrador</h5>
                        <p class="text-muted small">Crear nuevo usuario administrador</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Información del Sistema -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill"></i> Información del Sistema</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Versión:</strong> Scholarium v1.0 - Entrega 1</p>
                            <p><strong>Usuario:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Rol:</strong> Administrador</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Última sesión:</strong> {{ now()->format('d/m/Y H:i') }}</p>
                            <p><strong>Estado del sistema:</strong> <span class="badge bg-success">Operativo</span></p>
                            <p><strong>Año académico:</strong> 2025</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
</style>
@endpush
@endsection
