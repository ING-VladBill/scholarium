@extends('layouts.app')

@section('title', 'Gestión de Asignaturas')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="text-primary"><i class="bi bi-book me-2"></i>Gestión de Asignaturas</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('asignaturas.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nueva Asignatura
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('asignaturas.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por código o nombre..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="nivel" class="form-select">
                        <option value="">Todos los niveles</option>
                        <option value="Básica" {{ request('nivel') == 'Básica' ? 'selected' : '' }}>Básica</option>
                        <option value="Media" {{ request('nivel') == 'Media' ? 'selected' : '' }}>Media</option>
                    </select>
                </div>
                <div class="col-md-2">
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
                    <a href="{{ route('asignaturas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Limpiar
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Nivel</th>
                            <th>Horas/Semana</th>
                            <th>Créditos</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asignaturas as $asignatura)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $asignatura->codigo }}</span></td>
                            <td>{{ $asignatura->nombre }}</td>
                            <td><span class="badge {{ $asignatura->nivel == 'Básica' ? 'bg-info' : 'bg-warning' }}">{{ $asignatura->nivel }}</span></td>
                            <td>{{ $asignatura->horas_semanales }}</td>
                            <td>{{ $asignatura->creditos }}</td>
                            <td>
                                <span class="badge {{ $asignatura->estado == 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $asignatura->estado }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('asignaturas.show', $asignatura) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('asignaturas.edit', $asignatura) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('asignaturas.destroy', $asignatura) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta asignatura?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No se encontraron asignaturas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $asignaturas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
