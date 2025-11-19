@extends('layouts.app')

@section('title', 'Registro de Estudiante')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-7">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="mb-0"><i class="bi bi-person-plus-fill"></i> Registro de Estudiante</h3>
                    <small>Completa tus datos para crear tu cuenta institucional</small>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register.post') }}" id="formRegistro">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label">
                                    <i class="bi bi-person-fill"></i> Nombres <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" 
                                       name="nombres" 
                                       value="{{ old('nombres') }}" 
                                       required 
                                       autofocus
                                       placeholder="Juan Carlos">
                                @error('nombres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label">
                                    <i class="bi bi-person-fill"></i> Apellidos <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" 
                                       name="apellidos" 
                                       value="{{ old('apellidos') }}" 
                                       required
                                       placeholder="Pérez García">
                                @error('apellidos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">
                                <i class="bi bi-calendar-fill"></i> Fecha de Nacimiento <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                   id="fecha_nacimiento" 
                                   name="fecha_nacimiento" 
                                   value="{{ old('fecha_nacimiento') }}" 
                                   required
                                   max="{{ date('Y-m-d') }}">
                            @error('fecha_nacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Debes tener entre 6 y 17 años para registrarte.</small>
                        </div>

                        <div class="mb-3">
                            <label for="email_display" class="form-label">
                                <i class="bi bi-envelope-fill"></i> Correo Institucional (Generado Automáticamente)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-at"></i></span>
                                <input type="text" 
                                       class="form-control bg-light" 
                                       id="email_display" 
                                       readonly
                                       placeholder="Se generará automáticamente al escribir tu nombre">
                            </div>
                            <input type="hidden" id="email" name="email" value="">
                            <small class="form-text text-muted">
                                <i class="bi bi-info-circle"></i> Tu correo se generará como: <strong>nombre.apellido@scholarium.edu.pe</strong>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock-fill"></i> Contraseña <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required
                                   placeholder="Mínimo 6 caracteres">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">La contraseña debe tener al menos 6 caracteres.</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                <i class="bi bi-lock-fill"></i> Confirmar Contraseña <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   placeholder="Repite tu contraseña">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-person-plus-fill"></i> Registrarse como Estudiante
                        </button>

                        <div class="text-center">
                            <p class="mb-0">¿Ya tienes una cuenta? 
                                <a href="{{ route('login') }}" style="color: var(--vinotinto-oscuro);">Inicia sesión aquí</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nombresInput = document.getElementById('nombres');
    const apellidosInput = document.getElementById('apellidos');
    const emailDisplay = document.getElementById('email_display');
    const emailHidden = document.getElementById('email');

    function generarEmail() {
        const nombres = nombresInput.value.trim();
        const apellidos = apellidosInput.value.trim();

        if (nombres && apellidos) {
            // Tomar primer nombre y primer apellido
            const primerNombre = nombres.split(' ')[0].toLowerCase();
            const primerApellido = apellidos.split(' ')[0].toLowerCase();

            // Remover acentos y caracteres especiales
            const email = `${primerNombre}.${primerApellido}@scholarium.edu.pe`
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9.@]/g, '');

            emailDisplay.value = email;
            emailHidden.value = email;
        } else {
            emailDisplay.value = '';
            emailHidden.value = '';
        }
    }

    nombresInput.addEventListener('input', generarEmail);
    apellidosInput.addEventListener('input', generarEmail);

    // Generar email si hay valores previos (old input)
    if (nombresInput.value || apellidosInput.value) {
        generarEmail();
    }
});
</script>

<style>
.bg-light {
    background-color: #f8f9fa !important;
    cursor: not-allowed;
}
</style>
@endsection
