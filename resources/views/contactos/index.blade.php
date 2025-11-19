@extends('layouts.app')
@section('title', 'Mensajes de Contacto')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-envelope-fill me-2"></i>Mensajes de Contacto</h2>
        @if($noLeidos > 0)
        <span class="badge bg-danger fs-5">{{ $noLeidos }} sin leer</span>
        @endif
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre, email o asunto..." value="{{ request('buscar') }}">
                </div>
                <div class="col-md-4">
                    <select name="estado" class="form-select">
                        <option value="">Todos los mensajes</option>
                        <option value="no_leidos" {{ request('estado') == 'no_leidos' ? 'selected' : '' }}>No leídos</option>
                        <option value="leidos" {{ request('estado') == 'leidos' ? 'selected' : '' }}>Leídos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if($contactos->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Asunto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactos as $contacto)
                        <tr class="{{ !$contacto->leido ? 'table-warning' : '' }}">
                            <td>
                                @if($contacto->leido)
                                <span class="badge bg-secondary"><i class="bi bi-envelope-open"></i> Leído</span>
                                @else
                                <span class="badge bg-primary"><i class="bi bi-envelope"></i> Nuevo</span>
                                @endif
                            </td>
                            <td>{{ $contacto->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $contacto->nombre }}</td>
                            <td>{{ $contacto->email }}</td>
                            <td>{{ Str::limit($contacto->asunto, 40) }}</td>
                            <td>
                                <a href="{{ route('contactos.show', $contacto->id) }}" class="btn btn-sm btn-info" title="Ver mensaje">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('contactos.destroy', $contacto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este mensaje?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver al Dashboard
                    </a>
                </div>                
            </div>
            <div class="mt-3">
                {{ $contactos->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No hay mensajes de contacto.</p>
            </div>
            @endif
        </div>
        
    </div>
    
</div>
@endsection
