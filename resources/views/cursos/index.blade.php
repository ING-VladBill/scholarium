@extends('layouts.app')

@section('title', 'Gestión de Cursos')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-book-fill"></i> Gestión de Cursos</h2>
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Curso
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
            <form action="{{ route('cursos.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="search" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Nombre del curso o sala">
                </div>
                <div class="col-md-3">
                    <label for="nivel" class="form-label">Nivel</label>
                    <select class="form-select" id="nivel" name="nivel">
                        <option value="">Todos</option>
                        <option value="Básica" {{ request('nivel') == 'Básica' ? 'selected' : '' }}>Básica</option>
                        <option value="Media" {{ request('nivel') == 'Media' ? 'selected' : '' }}>Media</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="">Todos</option>
                        <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ request('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
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

    <!-- Tabla de Cursos -->
    <div class="card">
        <div class="card-body">
            @if($cursos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nivel</th>
                                <th>Año Académico</th>
                                <th>Capacidad</th>
                                <th>Cupos Disponibles</th>
                                <th>Sala</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cursos as $curso)
                                <tr>
                                    <td><strong>{{ $curso->nombre }}</strong></td>
                                    <td>{{ $curso->nivel }}</td>
                                    <td>{{ $curso->anio_academico }}</td>
                                    <td>{{ $curso->capacidad_maxima }}</td>
                                    <td>
                                        @if($curso->estaLleno())
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle-fill"></i> LLENO (0/{{ $curso->capacidad_maxima }})
                                            </span>
                                        @elseif($curso->cupos_disponibles <= 5)
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-exclamation-triangle-fill"></i> {{ $curso->cupos_disponibles }}/{{ $curso->capacidad_maxima }}
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle-fill"></i> {{ $curso->cupos_disponibles }}/{{ $curso->capacidad_maxima }}
                                            </span>
                                        @endif
                                        <small class="text-muted d-block mt-1">{{ $curso->porcentaje_ocupacion }}% ocupado</small>
                                    </td>
                                    <td>{{ $curso->sala ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $curso->estado == 'Activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                            {{ $curso->estado }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('cursos.show', $curso) }}" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a href="{{ route('cursos.edit', $curso) }}" 
                                               class="btn btn-sm btn-warning" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('cursos.destroy', $curso) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('¿Está seguro de eliminar este curso?');"
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
                    {{ $cursos->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                    <p class="mt-3 text-muted">No se encontraron cursos.</p>
                    <a href="{{ route('cursos.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Crear Primer Curso
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
