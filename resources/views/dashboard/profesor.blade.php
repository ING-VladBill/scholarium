@extends('layouts.app')
@section('title', 'Dashboard Profesor')
@section('content')
<div class="container py-4">
    <h2 class="title-dorado">Bienvenido, Profesor {{ auth()->user()->name }}</h2>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i>
                <strong>Panel de Profesor en Desarrollo</strong>
                <p class="mb-0">Esta sección está en construcción. Pronto podrás gestionar tus cursos, calificaciones y asistencias.</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Tarjeta: Mis Cursos -->
        <div class="col-md-4">
            <div class="card card-dorado">
                <div class="card-header bg-primary text-white">
                    <h5><i class="bi bi-book"></i> Mis Cursos</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="display-4">0</h2>
                    <p class="text-muted">Cursos asignados</p>
                    <a href="#" class="btn btn-outline-primary disabled">Ver Cursos</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Estudiantes -->
        <div class="col-md-4">
            <div class="card card-dorado">
                <div class="card-header bg-success text-white">
                    <h5><i class="bi bi-people"></i> Estudiantes</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="display-4">0</h2>
                    <p class="text-muted">Total de estudiantes</p>
                    <a href="#" class="btn btn-outline-success disabled">Ver Estudiantes</a>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Calificaciones -->
        <div class="col-md-4">
            <div class="card card-dorado">
                <div class="card-header bg-warning text-dark">
                    <h5><i class="bi bi-clipboard-check"></i> Calificaciones</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="display-4">0</h2>
                    <p class="text-muted">Pendientes de registro</p>
                    <a href="#" class="btn btn-outline-warning disabled">Registrar Notas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Horario Semanal -->
        <div class="col-md-6">
            <div class="card card-dorado">
                <div class="card-header bg-info text-white">
                    <h5><i class="bi bi-calendar-week"></i> Horario Semanal</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted text-center">No hay horarios asignados</p>
                </div>
            </div>
        </div>

        <!-- Próximas Clases -->
        <div class="col-md-6">
            <div class="card card-dorado">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="bi bi-clock"></i> Próximas Clases</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted text-center">No hay clases programadas</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-dorado {
    border: 2px solid #FFD700;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(255, 215, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-dorado:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(255, 215, 0, 0.2);
}

.title-dorado {
    color: #FFD700;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    font-weight: bold;
    margin-bottom: 20px;
}
</style>
@endsection
