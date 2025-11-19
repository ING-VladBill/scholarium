@extends('layouts.app')
@section('title', 'Editar Matrícula')
@section('content')
<div class="container py-4">
    <div class="card card-dorado">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Matrícula</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('matriculas.update', $matricula->id) }}">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estudiante</label>
                        <select name="estudiante_id" class="form-select" required>
                            @foreach($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}" {{ $matricula->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                    {{ $estudiante->dni }} - {{ $estudiante->apellidos }}, {{ $estudiante->nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Curso</label>
                        <select name="curso_id" class="form-select" required>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ $matricula->curso_id == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre }} - {{ $curso->nivel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha de Matrícula</label>
                        <input type="date" name="fecha_matricula" class="form-control" value="{{ $matricula->fecha_matricula }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="Matriculado" {{ $matricula->estado == 'Matriculado' ? 'selected' : '' }}>Matriculado</option>
                            <option value="Retirado" {{ $matricula->estado == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3">{{ $matricula->observaciones }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dorado">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('matriculas.listar') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
