@extends('layouts.app')

@section('title', 'Gestión de Docentes')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary"><i class="bi bi-person-badge me-2"></i>Gestión de Docentes</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
                <i class="bi bi-house me-2"></i>Dashboard
            </a>
            <a href="{{ route('docentes.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Docente
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('password_temporal'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="bi bi-key me-2"></i>Usuario Creado</h5>
            <p class="mb-0"><strong>Docente:</strong> {{ session('docente_nombre') }}</p>
            <p class="mb-0"><strong>Email:</strong> {{ session('docente_email') ?? 'Ver en la tabla' }}</p>
            <p class="mb-0"><strong>Contraseña Temporal:</strong> <code class="text-dark">{{ session('password_temporal') }}</code></p>
            <hr>
            <small>Por favor, anote esta contraseña y entréguela al docente. No se volverá a mostrar.</small>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('docentes.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por DNI, nombre, email o especialidad..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="estado" class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ request('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i>Buscar
                    </button>
                    <a href="{{ route('docentes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Limpiar
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover" style="min-width: 900px;">
                    <thead class="table-light">
                        <tr>
                            <th>DNI</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Especialidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($docentes as $docente)
                        <tr>
                            <td>{{ $docente->dni }}</td>
                            <td>{{ $docente->nombre_completo }}</td>
                            <td>{{ $docente->email }}</td>
                            <td><span class="badge bg-info">{{ $docente->especialidad }}</span></td>
                            <td>
                                <span class="badge {{ $docente->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $docente->estado }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('docentes.show', $docente) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('docentes.edit', $docente) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('docentes.destroy', $docente) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" 
                                            onclick="return confirm('¿Estás seguro de eliminar este docente?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No se encontraron docentes
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $docentes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
