@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="min-height: 70vh; align-items: center;">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <div class="card-header text-center">
                    <h3 class="mb-0"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</h3>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope-fill"></i> Correo Electrónico
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   placeholder="tu@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock-fill"></i> Contraseña
                            </label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required
                                   placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right"></i> Ingresar
                        </button>

                        <div class="text-center">
                            <p class="mb-0">¿No tienes una cuenta? 
                                <a href="{{ route('register') }}" style="color: var(--vinotinto-oscuro);">Regístrate aquí</a>
                            </p>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="alert alert-info mb-0">
                        <strong><i class="bi bi-info-circle-fill"></i> Credenciales de prueba:</strong><br>
                        <small>
                            <strong>Admin:</strong> admin@scholarium.pe / admin123<br>
                            <strong>Docente:</strong> profesor@scholarium.pe / profesor123
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
