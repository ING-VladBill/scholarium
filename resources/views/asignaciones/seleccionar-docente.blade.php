@extends('layouts.app')
@section('title', 'Asignar Docente y Horarios')
@section('content')
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-primary mb-4">
                <i class="fas fa-calendar-alt"></i> Paso 3: Asignar Docente y Horarios
            </h2>
        </div>
    </div>

    {{-- Información del curso y asignatura --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info">
                <div class="row">
                    <div class="col-md-4">
                        <strong><i class="fas fa-school"></i> Curso:</strong> {{ $curso->nombre }}
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fas fa-book"></i> Asignatura:</strong> {{ $asignatura->nombre }}
                    </div>
                    <div class="col-md-4">
                        <strong><i class="fas fa-clock"></i> Horas Semanales:</strong> 
                        <span class="badge bg-primary">{{ $horasRestantes }} hora(s) por asignar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('asignaciones.store-multiple') }}" method="POST" id="formAsignaciones">
        @csrf
        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
        <input type="hidden" name="asignatura_id" value="{{ $asignatura->id }}">

        <div class="row">
            {{-- Columna Izquierda: Formulario --}}
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user-tie"></i> Seleccionar Docente</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Docente <span class="text-danger">*</span></label>
                            <select name="docente_id" id="docente_id" class="form-select" required>
                                <option value="">Seleccione un docente...</option>
                                @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}">
                                    {{ $docente->nombres }} {{ $docente->apellidos }} - {{ $docente->especialidad }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="horarioDocenteInfo" class="alert alert-warning d-none">
                            <i class="fas fa-info-circle"></i> Selecciona un docente para ver su horario actual
                        </div>
                    </div>
                </div>

                {{-- Asignaciones de Horarios --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Asignar Horarios</h5>
                        <span class="badge bg-light text-dark" id="contadorHoras">
                            0 / {{ $horasRestantes }} horas asignadas
                        </span>
                    </div>
                    <div class="card-body">
                        <div id="asignacionesContainer">
                            {{-- Las filas se generarán dinámicamente con JavaScript --}}
                        </div>

                        <div class="alert alert-info mt-3">
                            <i class="fas fa-lightbulb"></i> 
                            <strong>Instrucciones:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Debes asignar <strong>exactamente {{ $horasRestantes }} hora(s)</strong></li>
                                <li>Cada fila representa 1 hora de clase</li>
                                <li>El sistema validará automáticamente los conflictos de horario</li>
                                <li>Puedes distribuir las horas en diferentes días</li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success" id="btnGuardar" disabled>
                                <i class="fas fa-save"></i> Guardar Asignaciones
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Columna Derecha: Horario del Docente --}}
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-week"></i> Horario del Docente</h5>
                    </div>
                    <div class="card-body" id="horarioDocente">
                        <p class="text-muted text-center">
                            <i class="fas fa-arrow-left"></i> Selecciona un docente para ver su horario
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
const horasRequeridas = {{ $horasRestantes }};
const cursoId = {{ $curso->id }};
let horasAsignadas = 0;

// Generar filas de asignación
function generarFilasAsignacion() {
    const container = document.getElementById('asignacionesContainer');
    container.innerHTML = '';

    for (let i = 0; i < horasRequeridas; i++) {
        const fila = `
            <div class="row mb-3 asignacion-fila" data-index="${i}">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-light">
                            <strong>Hora ${i + 1}</strong>
                            <span class="badge bg-secondary float-end" id="status-${i}">Pendiente</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-label small">Día <span class="text-danger">*</span></label>
                                    <select name="asignaciones[${i}][dia_semana]" class="form-select form-select-sm dia-select" data-index="${i}" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Lunes">Lunes</option>
                                        <option value="Martes">Martes</option>
                                        <option value="Miércoles">Miércoles</option>
                                        <option value="Jueves">Jueves</option>
                                        <option value="Viernes">Viernes</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label small">Hora Inicio <span class="text-danger">*</span></label>
                                    <input type="time" name="asignaciones[${i}][hora_inicio]" class="form-control form-control-sm hora-input" data-index="${i}" required>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label small">Hora Fin <span class="text-danger">*</span></label>
                                    <input type="time" name="asignaciones[${i}][hora_fin]" class="form-control form-control-sm hora-input" data-index="${i}" required>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-sm d-none mt-2" id="error-${i}"></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', fila);
    }

    // Agregar event listeners
    document.querySelectorAll('.dia-select, .hora-input').forEach(input => {
        input.addEventListener('change', validarFila);
    });
}

// Cargar horario del docente
document.getElementById('docente_id').addEventListener('change', function() {
    const docenteId = this.value;
    
    if (!docenteId) {
        document.getElementById('horarioDocente').innerHTML = '<p class="text-muted text-center"><i class="fas fa-arrow-left"></i> Selecciona un docente</p>';
        document.getElementById('horarioDocenteInfo').classList.add('d-none');
        return;
    }

    // Mostrar loading
    document.getElementById('horarioDocente').innerHTML = '<p class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando...</p>';
    
    // Cargar horario
    fetch(`/asignaciones/horario-docente/${docenteId}`)
        .then(response => response.json())
        .then(data => {
            mostrarHorarioDocente(data);
            document.getElementById('horarioDocenteInfo').classList.remove('d-none');
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('horarioDocente').innerHTML = '<p class="text-danger">Error al cargar horario</p>';
        });
});

// Mostrar horario del docente
function mostrarHorarioDocente(horario) {
    const container = document.getElementById('horarioDocente');
    
    if (horario.length === 0) {
        container.innerHTML = '<p class="text-success"><i class="fas fa-check-circle"></i> El docente no tiene clases asignadas</p>';
        return;
    }

    let html = '<div class="table-responsive"><table class="table table-sm table-bordered">';
    html += '<thead class="table-light"><tr><th>Día</th><th>Horario</th><th>Clase</th></tr></thead><tbody>';

    const dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    dias.forEach(dia => {
        const clasesDia = horario.filter(h => h.dia === dia);
        if (clasesDia.length > 0) {
            clasesDia.forEach((clase, index) => {
                html += `<tr>`;
                if (index === 0) {
                    html += `<td rowspan="${clasesDia.length}"><strong>${dia}</strong></td>`;
                }
                html += `<td class="small">${clase.hora_inicio} - ${clase.hora_fin}</td>`;
                html += `<td class="small">${clase.asignatura}<br><span class="text-muted">${clase.curso}</span></td>`;
                html += `</tr>`;
            });
        }
    });

    html += '</tbody></table></div>';
    container.innerHTML = html;
}

// Validar fila individual
function validarFila(event) {
    const index = event.target.dataset.index;
    const docenteId = document.getElementById('docente_id').value;
    
    if (!docenteId) {
        alert('Primero selecciona un docente');
        return;
    }

    const dia = document.querySelector(`select[name="asignaciones[${index}][dia_semana]"]`).value;
    const horaInicio = document.querySelector(`input[name="asignaciones[${index}][hora_inicio]"]`).value;
    const horaFin = document.querySelector(`input[name="asignaciones[${index}][hora_fin]"]`).value;

    if (!dia || !horaInicio || !horaFin) return;

    // Validar que hora_fin > hora_inicio
    if (horaFin <= horaInicio) {
        mostrarError(index, 'La hora de fin debe ser posterior a la hora de inicio');
        return;
    }

    // Validar disponibilidad
    fetch('/asignaciones/verificar-disponibilidad', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            docente_id: docenteId,
            curso_id: cursoId,
            dia_semana: dia,
            hora_inicio: horaInicio,
            hora_fin: horaFin
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.disponible) {
            marcarFilaValida(index);
        } else {
            mostrarError(index, data.mensaje);
        }
        actualizarContador();
    });
}

// Mostrar error en fila
function mostrarError(index, mensaje) {
    const errorDiv = document.getElementById(`error-${index}`);
    const statusBadge = document.getElementById(`status-${index}`);
    
    errorDiv.textContent = mensaje;
    errorDiv.classList.remove('d-none');
    statusBadge.textContent = 'Conflicto';
    statusBadge.className = 'badge bg-danger float-end';
}

// Marcar fila como válida
function marcarFilaValida(index) {
    const errorDiv = document.getElementById(`error-${index}`);
    const statusBadge = document.getElementById(`status-${index}`);
    
    errorDiv.classList.add('d-none');
    statusBadge.textContent = 'Válido';
    statusBadge.className = 'badge bg-success float-end';
}

// Actualizar contador y habilitar botón
function actualizarContador() {
    let filasValidas = 0;
    
    for (let i = 0; i < horasRequeridas; i++) {
        const statusBadge = document.getElementById(`status-${i}`);
        if (statusBadge && statusBadge.textContent === 'Válido') {
            filasValidas++;
        }
    }

    document.getElementById('contadorHoras').textContent = `${filasValidas} / ${horasRequeridas} horas asignadas`;
    
    // Habilitar botón solo si todas las filas son válidas
    document.getElementById('btnGuardar').disabled = (filasValidas !== horasRequeridas);
}

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    generarFilasAsignacion();
});
</script>
@endpush
@endsection
