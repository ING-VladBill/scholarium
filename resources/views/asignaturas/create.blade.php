@extends('layouts.app')

@section('title', 'Nueva Asignatura')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-book-half me-2"></i>Nueva Asignatura</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('asignaturas.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="codigo" class="form-label">Código <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('codigo') is-invalid @enderror" 
                                       id="codigo" name="codigo" value="{{ old('codigo') }}" 
                                       placeholder="MAT101" required>
                                @error('codigo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                       id="nombre" name="nombre" value="{{ old('nombre') }}" 
                                       placeholder="Matemáticas I" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
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

                            <div class="col-md-4 mb-3">
                                <label for="horas_semanales" class="form-label">Horas/Semana <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('horas_semanales') is-invalid @enderror" 
                                       id="horas_semanales" name="horas_semanales" value="{{ old('horas_semanales', 2) }}" 
                                       min="1" max="10" required>
                                @error('horas_semanales')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="creditos" class="form-label">Créditos <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('creditos') is-invalid @enderror" 
                                       id="creditos" name="creditos" value="{{ old('creditos', 3) }}" 
                                       min="1" max="10" required>
                                @error('creditos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="">Seleccione...</option>
                                <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('asignaturas.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
