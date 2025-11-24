@extends('layouts.app')

@section('title', 'Crear Estudiante')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-person-plus-fill"></i> Crear Nuevo Estudiante</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('estudiantes.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('dni') is-invalid @enderror" 
                               id="dni" name="dni" value="{{ old('dni') }}" 
                               placeholder="12.345.678-9" required>
                        @error('dni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                               id="fecha_nacimiento" name="fecha_nacimiento" 
                               value="{{ old('fecha_nacimiento') }}" required>
                        @error('fecha_nacimiento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                               id="nombres" name="nombres" value="{{ old('nombres') }}" 
                               placeholder="Juan Carlos" required>
                        @error('nombres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                               id="apellidos" name="apellidos" value="{{ old('apellidos') }}" 
                               placeholder="Pérez González" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="estudiante@scholarium.pe">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                               id="telefono" name="telefono" value="{{ old('telefono') }}" 
                               placeholder="+51912345678">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <textarea class="form-control @error('direccion') is-invalid @enderror" 
                              id="direccion" name="direccion" rows="2" 
                              placeholder="Av. Libertador 1234, Santiago">{{ old('direccion') }}</textarea>
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="genero" class="form-label">Género <span class="text-danger">*</span></label>
                        <select class="form-select @error('genero') is-invalid @enderror" 
                                id="genero" name="genero" required>
                            <option value="">Seleccione...</option>
                            <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                        @error('genero')
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

                    <div class="col-md-4 mb-3">
                        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('fecha_ingreso') is-invalid @enderror" 
                               id="fecha_ingreso" name="fecha_ingreso" 
                               value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required>
                        @error('fecha_ingreso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Estudiante
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
