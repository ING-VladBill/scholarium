@extends('layouts.app')
@section('title', 'Ver Mensaje')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-envelope-open me-2"></i>Mensaje de Contacto</h2>
        <a href="{{ route('contactos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ $contacto->asunto }}</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-person"></i> Nombre:</strong> {{ $contacto->nombre }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-envelope"></i> Email:</strong> <a href="mailto:{{ $contacto->email }}">{{ $contacto->email }}</a></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong><i class="bi bi-calendar"></i> Fecha:</strong> {{ $contacto->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="bi bi-check-circle"></i> Estado:</strong>
                        @if($contacto->leido)
                        <span class="badge bg-secondary">Leído</span>
                        @else
                        <span class="badge bg-primary">Nuevo</span>
                        @endif
                    </p>
                </div>
            </div>
            <hr>
            <div class="mb-3">
                <strong><i class="bi bi-chat-left-text"></i> Mensaje:</strong>
                <div class="mt-2 p-3 bg-light rounded">
                    {{ $contacto->mensaje }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('contactos.destroy', $contacto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este mensaje?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Eliminar
                </button>
            </form>
            <a href="mailto:{{ $contacto->email }}?subject=Re: {{ $contacto->asunto }}" class="btn btn-success">
                <i class="bi bi-reply"></i> Responder por Email
            </a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver al Dashboard
            </a>            
            
        </div>
    </div>
</div>
@endsection
