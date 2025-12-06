@extends('layouts.app')

@section('title', 'Nuevo Docente')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Nuevo Docente</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('docentes.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                                @error('nombres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                                @error('apellidos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Institucional <span class="text-muted">(Generado automáticamente)</span></label>
                            <input type="email" class="form-control bg-light" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   readonly required>
                            <small class="text-muted">El email se genera automáticamente a partir del nombre y apellido</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('dni') is-invalid @enderror" 
                                       id="dni" name="dni" value="{{ old('dni') }}" 
                                       placeholder="12345678" maxlength="8" required>
                                @error('dni')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                       placeholder="+51 987654321">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="especialidad" class="form-label">Especialidad / Área <span class="text-danger">*</span></label>
                                <select class="form-select @error('especialidad') is-invalid @enderror" 
                                        id="especialidad" name="especialidad" required>
                                    <option value="">Seleccione una especialidad...</option>
                                    @foreach($especialidades as $esp)
                                        <option value="{{ $esp }}" {{ old('especialidad') == $esp ? 'selected' : '' }}>
                                            {{ $esp }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('especialidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
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
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Nota:</strong> Al guardar el docente, se creará automáticamente un usuario para acceder al sistema. 
                            La contraseña temporal se mostrará después de crear el registro.
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('docentes.index') }}" class="btn btn-secondary">
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

<script>
// Generar email automáticamente
function generarEmail() {
    const nombres = document.getElementById('nombres').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    
    if (nombres && apellidos) {
        // Tomar primer nombre y primer apellido
        const primerNombre = nombres.split(' ')[0].toLowerCase();
        const primerApellido = apellidos.split(' ')[0].toLowerCase();
        
        // Remover tildes y caracteres especiales
        const nombreLimpio = primerNombre
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z]/g, '');
        
        const apellidoLimpio = primerApellido
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z]/g, '');
        
        // Generar email
        const email = `${nombreLimpio}.${apellidoLimpio}@scholarium.edu.pe`;
        document.getElementById('email').value = email;
    } else {
        document.getElementById('email').value = '';
    }
}

// Escuchar cambios en nombres y apellidos
document.getElementById('nombres').addEventListener('input', generarEmail);
document.getElementById('apellidos').addEventListener('input', generarEmail);

// Generar email al cargar si hay valores previos (old values)
document.addEventListener('DOMContentLoaded', generarEmail);
</script>
@endsection
