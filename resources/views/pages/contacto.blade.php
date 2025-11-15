@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4">Contáctanos</h1>
        <p class="lead">Estamos aquí para ayudarte</p>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-envelope-fill"></i> Envíanos un Mensaje</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('contacto.enviar') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control @error('asunto') is-invalid @enderror" 
                                   id="asunto" name="asunto" value="{{ old('asunto') }}" required>
                            @error('asunto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control @error('mensaje') is-invalid @enderror" 
                                      id="mensaje" name="mensaje" rows="5" required>{{ old('mensaje') }}</textarea>
                            @error('mensaje')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-send-fill"></i> Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-info-circle-fill"></i> Información de Contacto</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5><i class="bi bi-geo-alt-fill" style="color: var(--vinotinto-oscuro);"></i> Dirección</h5>
                        <p class="ms-4">Av. Libertador Bernardo O'Higgins 1234<br>
                        Lima Centro, Lima<br>
                        Perú</p>
                    </div>

                    <div class="mb-4">
                        <h5><i class="bi bi-telephone-fill" style="color: var(--vinotinto-oscuro);"></i> Teléfono</h5>
                        <p class="ms-4">+51 2 1234 5678<br>
                        +51 9 8765 4321 (WhatsApp)</p>
                    </div>

                    <div class="mb-4">
                        <h5><i class="bi bi-envelope-fill" style="color: var(--vinotinto-oscuro);"></i> Correo Electrónico</h5>
                        <p class="ms-4">contacto@scholarium.pe<br>
                        admision@scholarium.pe</p>
                    </div>

                    <div class="mb-4">
                        <h5><i class="bi bi-clock-fill" style="color: var(--vinotinto-oscuro);"></i> Horario de Atención</h5>
                        <p class="ms-4">Lunes a Viernes: 08:00 - 18:00<br>
                        Sábados: 09:00 - 13:00</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body text-center">
                    <h5 class="mb-3">Síguenos en Redes Sociales</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="#" class="btn btn-outline-info rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="#" class="btn btn-outline-success rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
