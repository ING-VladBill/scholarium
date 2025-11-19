@extends('layouts.app')

@section('title', 'Registrar Administrador')

@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-md-8">
            <div class="card shadow-lg border-warning">
                <div class="card-header text-center bg-warning text-dark">
                    <h3 class="mb-0">
                        <i class="bi bi-shield-fill-plus"></i> Registrar Nuevo Administrador
                    </h3>
                    <small>Solo administradores pueden acceder a esta función</small>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.register.post') }}">
                        @csrf

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle-fill"></i> 
                            <strong>Nota:</strong> Este formulario crea un usuario con rol de <strong>Administrador</strong>. 
                            Tendrá acceso completo al sistema.
                        </div>

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
                                       placeholder="María Elena">
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
                                       placeholder="González Martínez">
                                @error('apellidos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope-fill"></i> Correo Electrónico <span class="text-danger">*</span>
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

                        <div class="row">
                            <div class="col-md-6 mb-3">
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
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="bi bi-lock-fill"></i> Confirmar Contraseña <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required
                                       placeholder="Repite la contraseña">
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i> 
                            <strong>Importante:</strong> Asegúrate de guardar las credenciales de forma segura. 
                            El nuevo administrador podrá gestionar todo el sistema.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="bi bi-shield-fill-plus"></i> Crear Administrador
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver al Dashboard
                            </a>
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
@endsection
