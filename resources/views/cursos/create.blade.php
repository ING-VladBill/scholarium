@extends('layouts.app')

@section('title', 'Crear Curso')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-plus-circle-fill"></i> Crear Nuevo Curso</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('cursos.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre del Curso <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" name="nombre" value="{{ old('nombre') }}" 
                               placeholder="1° Básico A" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nivel" class="form-label">Nivel <span class="text-danger">*</span></label>
                        <select class="form-select @error('nivel') is-invalid @enderror" 
                                id="nivel" name="nivel" required>
                            <option value="">Seleccione...</option>
                            <option value="Básica" {{ old('nivel') == 'Básica' ? 'selected' : '' }}>Básica</option>
                            <option value="Media" {{ old('nivel') == 'Media' ? 'selected' : '' }}>Media</option>
                        </select>
                        @error('nivel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="grado" class="form-label">Grado <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('grado') is-invalid @enderror" 
                               id="grado" name="grado" value="{{ old('grado') }}" 
                               min="1" max="8" placeholder="1-8" required>
                        @error('grado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">1-8 para Básica, 1-4 para Media</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="seccion" class="form-label">Sección <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('seccion') is-invalid @enderror" 
                               id="seccion" name="seccion" value="{{ old('seccion') }}" 
                               placeholder="A, B, C..." required>
                        @error('seccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="anio_academico" class="form-label">Año Académico <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('anio_academico') is-invalid @enderror" 
                               id="anio_academico" name="anio_academico" 
                               value="{{ old('anio_academico', date('Y')) }}" 
                               min="2020" max="2030" required>
                        @error('anio_academico')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="capacidad_maxima" class="form-label">Capacidad Máxima <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('capacidad_maxima') is-invalid @enderror" 
                               id="capacidad_maxima" name="capacidad_maxima" 
                               value="{{ old('capacidad_maxima', 40) }}" 
                               min="1" max="50" required>
                        @error('capacidad_maxima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="sala" class="form-label">Sala</label>
                        <input type="text" class="form-control @error('sala') is-invalid @enderror" 
                               id="sala" name="sala" value="{{ old('sala') }}" 
                               placeholder="Sala 101">
                        @error('sala')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                        <select class="form-select @error('estado') is-invalid @enderror" 
                                id="estado" name="estado" required>
                            <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Curso
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
