@extends('layouts.app')
@section('title', 'Nueva Asignación')
@section('content')
<div class="container my-5">
    <h2 class="text-primary mb-4"><i class="bi bi-calendar-plus me-2"></i>Nueva Asignación Docente-Asignatura</h2>
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Paso 1: Seleccione un Curso</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($cursos as $curso)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $curso->nombre }}</h5>
                            <p class="card-text">
                                <span class="badge bg-info">{{ $curso->nivel }}</span>
                                <span class="badge bg-secondary">{{ $curso->sala }}</span>
                            </p>
                            <a href="{{ route('asignaciones.seleccionar-asignatura', $curso->id) }}" class="btn btn-primary">
                                <i class="bi bi-arrow-right-circle me-2"></i>Seleccionar
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
            <div class="mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver al Dashboard
            </a>
            <a href="{{ route('asignaciones.listar') }}" class="btn btn-info">
                <i class="bi bi-list-check"></i> Ver Todas las Asignaciones
            </a>            
        </div>        
    </div>    
</div>
@endsection
