@extends('layouts.app')

@section('title', 'Gestión de Estudiantes')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people-fill"></i> Gestión de Estudiantes</h2>
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Estudiante
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filtros y Búsqueda -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('estudiantes.index') }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="DNI, nombre, apellido o email">
                </div>
                <div class="col-md-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="">Todos</option>
                        <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ request('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="datos" class="form-label">Datos</label>
                    <select class="form-select" id="datos" name="datos">
                        <option value="">Todos</option>
                        <option value="incompletos" {{ request('datos') == 'incompletos' ? 'selected' : '' }}>
                            <i class="bi bi-exclamation-triangle"></i> Datos Incompletos
                        </option>
                        <option value="completos" {{ request('datos') == 'completos' ? 'selected' : '' }}>
                            <i class="bi bi-check-circle"></i> Datos Completos
                        </option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Estudiantes -->
    <div class="card">
        <div class="card-body">
            @if($estudiantes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre Completo</th>
                                <th>Email</th>
                                <th>Fecha Nacimiento</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                                <tr>
                                    <td>
                                        {{ $estudiante->dni }}
                                        @if($estudiante->tieneDniTemporal())
                                            <span class="badge bg-secondary" title="DNI temporal">
                                                <i class="bi bi-clock-fill"></i> Temporal
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $estudiante->nombre_completo }}
                                        @if($estudiante->tieneDatosIncompletos())
                                            <span class="badge bg-warning text-dark" title="Faltan datos: {{ implode(', ', $estudiante->getCamposFaltantes()) }}">
                                                <i class="bi bi-exclamation-triangle-fill"></i> Datos Incompletos
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $estudiante->email ?? 'N/A' }}</td>
                                    <td>{{ $estudiante->fecha_nacimiento->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge {{ $estudiante->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                            {{ $estudiante->estado }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('estudiantes.show', $estudiante) }}" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{ route('estudiantes.edit', $estudiante) }}" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('estudiantes.destroy', $estudiante) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('¿Está seguro de eliminar este estudiante?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $estudiantes->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                    <p class="mt-3 text-muted">No se encontraron estudiantes.</p>
                    <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Crear Primer Estudiante
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Dashboard
        </a>
    </div>
</div>
@endsection
