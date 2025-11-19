@extends('layouts.app')
@section('title', 'Solicitudes de Matrícula')
@section('content')
<div class="container py-4">
    <h2 class="title-dorado"><i class="bi bi-clipboard-check"></i> Solicitudes de Matrícula Pendientes</h2>
    
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
    @if($solicitudes->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Estudiante</th><th>DNI</th><th>Curso</th><th>Fecha Solicitud</th><th>Acciones</th></tr></thead>
                <tbody>
                    @foreach($solicitudes as $sol)
                    <tr>
                        <td>{{ $sol->estudiante->nombre_completo }}</td>
                        <td>{{ $sol->estudiante->dni }}</td>
                        <td>{{ $sol->curso->nombre }}</td>
                        <td>{{ $sol->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('matriculas.aprobar', $sol->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success"><i class="bi bi-check"></i> Aprobar</button>
                            </form>
                            <form action="{{ route('matriculas.rechazar', $sol->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-danger"><i class="bi bi-x"></i> Rechazar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $solicitudes->links() }}
    @else
        <p class="text-muted">No hay solicitudes pendientes.</p>
    @endif
</div>
@endsection
