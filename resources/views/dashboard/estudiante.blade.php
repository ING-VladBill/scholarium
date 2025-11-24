@extends('layouts.app')
@section('title', 'Dashboard Estudiante')
@section('content')
<div class="container py-4">
    @php
        // Obtener estudiante asociado
        $est = \App\Models\Estudiante::where('user_id', auth()->id())->first();

        // Determinar el saludo
        $saludo = match($est->genero ?? 'Masculino') {
            'Femenino' => 'Bienvenida',
            'Masculino' => 'Bienvenido',
            default => 'Bienvenid@', // Para "Otro"
        };
    @endphp

    <h2 class="title-dorado">{{ $saludo }}, {{ auth()->user()->name }}</h2>

    
    {{-- Notificaciones de aprobación/rechazo --}}
    @php
        $notificacion_key = 'notificacion_estudiante_' . auth()->id();
        $notificacion = session()->get($notificacion_key);
    @endphp
    @if($notificacion)
        <div class="alert alert-{{ $notificacion['tipo'] }} alert-dismissible fade show" role="alert">
            <i class="bi bi-{{ $notificacion['tipo'] == 'success' ? 'check-circle' : 'x-circle' }}"></i>
            <strong>{{ $notificacion['mensaje'] }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @php
            session()->forget($notificacion_key);
        @endphp
    @endif
    
    {{-- Notificación de solicitud enviada --}}
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
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-dorado">
                <div class="card-header bg-primary text-white"><h5><i class="bi bi-journal-plus"></i> Solicitar Matrícula</h5></div>
                <div class="card-body">
                    <form action="{{ route('matriculas.solicitar') }}" method="post">
                        @csrf
                        <label>Selecciona una Sección:</label>
                        <select name="curso_id" class="form-select mb-3" required>
                            @foreach(\App\Models\Curso::where('estado', 'Activo')->get() as $curso)
                                <option value="{{ $curso->id }}" {{ $curso->estaLleno() ? 'disabled' : '' }}>
                                    {{ $curso->nombre }} - {{ $curso->nivel }} 
                                    ({{ $curso->cupos_disponibles }} cupos disponibles)
                                    @if($curso->estaLleno())
                                        - LLENO
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-dorado"><i class="bi bi-send"></i> Enviar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-dorado">
                <div class="card-header bg-info text-white"><h5><i class="bi bi-list"></i> Mis Solicitudes</h5></div>
                <div class="card-body">
                    @php
                        $estudiante = \App\Models\Estudiante::where('user_id', auth()->id())->first();
                        $misSolicitudes = $estudiante ? \App\Models\Matricula::where('estudiante_id', $estudiante->id)->latest()->take(5)->get() : collect();
                    @endphp
                    @if($misSolicitudes->count() > 0)
                        <ul class="list-group">
                            @foreach($misSolicitudes as $mat)
                                <li class="list-group-item d-flex justify-content-between matricula-item" 
                                    data-id="{{ $mat->id }}" 
                                    data-nueva="{{ session('nueva_matricula_id') == $mat->id ? 'true' : 'false' }}">
                                    <span>{{ $mat->curso->nombre }}</span>
                                    <span class="badge bg-{{ $mat->estado == 'Aprobada' ? 'success' : ($mat->estado == 'Pendiente' ? 'warning' : 'danger') }}">{{ $mat->estado }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No tienes solicitudes aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<style>
.matricula-destacada {
    background: linear-gradient(90deg, #FFD700, #FFA500) !important;
    color: #000 !important;
    font-weight: bold;
    transition: all 0.5s ease;
    animation: pulso 1s ease-in-out infinite;
}

@keyframes pulso {
    0%, 100% { box-shadow: 0 0 10px rgba(255, 215, 0, 0.5); }
    50% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.8); }
}

.matricula-destacada .badge {
    background-color: #000 !important;
    color: #FFD700 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Buscar el elemento recién creado
    const itemNuevo = document.querySelector('.matricula-item[data-nueva="true"]');
    
    if (itemNuevo) {
        // Agregar clase de resaltado
        itemNuevo.classList.add('matricula-destacada');
        
        // Remover después de 5 segundos
        setTimeout(function() {
            itemNuevo.classList.remove('matricula-destacada');
        }, 5000);
    }
});
</script>
