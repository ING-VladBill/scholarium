@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-user-circle"></i> Mi Perfil
            </h2>
        </div>
    </div>

    {{-- Mensajes de éxito/error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        {{-- Información Personal --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-id-card"></i> Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">DNI:</label>
                        <p class="text-muted">{{ $docente->dni }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Nombres:</label>
                        <p class="text-muted">{{ $docente->nombres }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Apellidos:</label>
                        <p class="text-muted">{{ $docente->apellidos }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Email:</label>
                        <p class="text-muted">{{ $docente->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Especialidad:</label>
                        <p class="text-muted">{{ $docente->especialidad }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Estado:</label>
                        <span class="badge {{ $docente->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $docente->estado }}
                        </span>
                    </div>

                    <hr>

                    <form action="{{ route('profesor.perfil.actualizar-datos') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="telefono" class="form-label fw-bold">Teléfono:</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                   id="telefono" name="telefono" value="{{ old('telefono', $docente->telefono) }}">
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Teléfono
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Cambiar Contraseña --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-key"></i> Cambiar Contraseña</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Importante:</strong> Si tu contraseña es temporal, te recomendamos cambiarla por una más segura.
                    </div>

                    <form action="{{ route('profesor.perfil.actualizar-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="password_actual" class="form-label fw-bold">Contraseña Actual:</label>
                            <input type="password" class="form-control @error('password_actual') is-invalid @enderror" 
                                   id="password_actual" name="password_actual" required>
                            @error('password_actual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Nueva Contraseña:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            <small class="text-muted">Mínimo 8 caracteres</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Nueva Contraseña:</label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-lock"></i> Cambiar Contraseña
                        </button>
                    </form>
                </div>
            </div>

            {{-- Información de Cuenta --}}
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-cog"></i> Información de Cuenta</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="fw-bold">Usuario:</label>
                        <p class="text-muted">{{ $user->name }}</p>
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold">Rol:</label>
                        <span class="badge bg-info">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold">Cuenta creada:</label>
                        <p class="text-muted">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
