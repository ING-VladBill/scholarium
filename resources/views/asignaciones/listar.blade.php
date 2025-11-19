@extends('layouts.app')
@section('title', 'Listado de Asignaciones')
@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary mb-4"><i class="bi bi-list-check me-2"></i>Asignaciones Activas</h2>
        <a href="{{ route('asignaciones.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Asignación
        </a>
    </div>    
    
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Curso</th>
                        <th>Asignatura</th>
                        <th>Docente</th>
                        <th>Horario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->curso->nombre }}</td>
                        <td>{{ $asignacion->asignatura->nombre }}</td>
                        <td>{{ $asignacion->docente->nombre_completo }}</td>
                        <td>{{ $asignacion->dia_semana }} {{ $asignacion->hora_inicio }}-{{ $asignacion->hora_fin }}</td>
                        <td>
                            <a href="{{ route('asignaciones.show', $asignacion->id) }}" class="btn btn-sm btn-info" title="Ver Detalle">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('asignaciones.edit', $asignacion->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('asignaciones.destroy', $asignacion->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar esta asignación?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">No hay asignaciones</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $asignaciones->links() }}
        </div>
    </div>
        <div class="mt-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Dashboard
        </a>
    </div>
</div>
@endsection
