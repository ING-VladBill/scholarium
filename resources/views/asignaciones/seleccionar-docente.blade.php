@extends('layouts.app')
@section('title', 'Seleccionar Docente')
@section('content')
<div class="container my-5">
    <h2 class="text-primary mb-4">Paso 3: Asignar Docente y Horario</h2>
    <div class="alert alert-info">
        <strong>Curso:</strong> {{ $curso->nombre }} | <strong>Asignatura:</strong> {{ $asignatura->nombre }}
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('asignaciones.store') }}" method="POST">
                @csrf
                <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                <input type="hidden" name="asignatura_id" value="{{ $asignatura->id }}">
                <input type="hidden" name="estado" value="Activo">
                
                <div class="mb-3">
                    <label class="form-label">Docente *</label>
                    <select name="docente_id" class="form-select" required>
                        <option value="">Seleccione...</option>
                        @foreach($docentes as $docente)
                        <option value="{{ $docente->id }}">{{ $docente->nombre_completo }} ({{ $docente->especialidad }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Día *</label>
                        <select name="dia_semana" class="form-select" required>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hora Inicio *</label>
                        <input type="time" name="hora_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hora Fin *</label>
                        <input type="time" name="hora_fin" class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Crear Asignación</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
