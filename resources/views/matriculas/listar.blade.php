@extends('layouts.app')

@section('title', 'Listado de Matrículas')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-list-check"></i> Listado de Matrículas</h2>
        <a href="{{ route('matriculas.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Matrícula
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($matriculas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estudiante</th>
                                <th>DNI</th>
                                <th>Curso</th>
                                <th>Fecha Matrícula</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matriculas as $matricula)
                                <tr>
                                    <td>{{ $matricula->id }}</td>
                                    <td>
                                        <a href="{{ route('estudiantes.show', $matricula->estudiante) }}" 
                                           class="text-decoration-none">
                                            <strong>{{ $matricula->estudiante->nombre_completo }}</strong>
                                        </a>
                                    </td>
                                    <td>{{ $matricula->estudiante->dni }}</td>
                                    <td>
                                        <a href="{{ route('cursos.show', $matricula->curso) }}" 
                                           class="text-decoration-none">
                                            {{ $matricula->curso->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $matricula->estado == 'Matriculado' ? 'success' : 'secondary' }}">
                                            {{ $matricula->estado }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('matriculas.show', $matricula->id) }}" class="btn btn-sm btn-info" title="Ver Detalle">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('matriculas.edit', $matricula->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('matriculas.destroy', $matricula->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta matrícula?');">
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
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $matriculas->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gris-oscuro); opacity: 0.3;"></i>
                    <p class="mt-3 text-muted">No hay matrículas registradas en el sistema.</p>
                    <a href="{{ route('matriculas.index') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Crear Primera Matrícula
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
