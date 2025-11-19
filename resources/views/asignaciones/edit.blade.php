@extends('layouts.app')
@section('title', 'Editar Asignación')
@section('content')
<div class="container py-4">
    <div class="card card-dorado">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Asignación</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('asignaciones.update', $asignacion->id) }}">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Curso</label>
                        <select name="curso_id" class="form-select" required>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ $asignacion->curso_id == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Asignatura</label>
                        <select name="asignatura_id" class="form-select" required>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id }}" {{ $asignacion->asignatura_id == $asignatura->id ? 'selected' : '' }}>
                                    {{ $asignatura->codigo }} - {{ $asignatura->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Docente</label>
                        <select name="docente_id" class="form-select" required>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}" {{ $asignacion->docente_id == $docente->id ? 'selected' : '' }}>
                                    {{ $docente->dni }} - {{ $docente->apellidos }}, {{ $docente->nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Horario</label>
                        <input type="text" name="horario" class="form-control" value="{{ $asignacion->horario }}" placeholder="Ej: Lunes 8:00-10:00" required>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dorado">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('asignaciones.listar') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
