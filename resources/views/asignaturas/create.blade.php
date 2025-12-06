@extends('layouts.app')

@section('title', 'Nueva Asignatura')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-book-half me-2"></i>Nueva Asignatura</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('asignaturas.store') }}" method="POST">
                        @csrf
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Nota:</strong> El código de la asignatura se generará automáticamente según el nombre y nivel seleccionados.
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Asignatura <span class="text-danger">*</span></label>
                            <select class="form-select @error('nombre') is-invalid @enderror" 
                                    id="nombre" name="nombre" required>
                                <option value="">Seleccione una asignatura...</option>
                                @foreach($asignaturasPredefinidas as $nombreAsig => $info)
                                    <option value="{{ $nombreAsig }}" 
                                            data-descripcion="{{ $info['descripcion'] }}"
                                            data-nivel="{{ $info['nivel'] }}"
                                            data-horas="{{ $info['horas'] }}"
                                            data-creditos="{{ $info['creditos'] }}"
                                            {{ old('nombre') == $nombreAsig ? 'selected' : '' }}>
                                        {{ $nombreAsig }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción <span class="text-muted">(Editable)</span></label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                            <small class="text-muted">La descripción se genera automáticamente, pero puedes editarla si lo deseas.</small>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nivel" class="form-label">Nivel <span class="text-danger">*</span></label>
                                <select class="form-select @error('nivel') is-invalid @enderror" 
                                        id="nivel" name="nivel" required>
                                    <option value="">Seleccione...</option>
                                    <option value="Básica" {{ old('nivel') == 'Básica' ? 'selected' : '' }}>Básica (Primaria)</option>
                                    <option value="Media" {{ old('nivel') == 'Media' ? 'selected' : '' }}>Media (Secundaria)</option>
                                </select>
                                @error('nivel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="horas_semanales" class="form-label">Horas/Semana <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('horas_semanales') is-invalid @enderror" 
                                       id="horas_semanales" name="horas_semanales" value="{{ old('horas_semanales', 3) }}" 
                                       min="1" max="10" required>
                                @error('horas_semanales')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="creditos" class="form-label">Créditos <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('creditos') is-invalid @enderror" 
                                       id="creditos" name="creditos" value="{{ old('creditos', 3) }}" 
                                       min="1" max="10" required>
                                @error('creditos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="">Seleccione...</option>
                                <option value="Activo" {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('asignaturas.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Autocompletar campos al seleccionar asignatura
document.getElementById('nombre').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    
    if (selectedOption.value) {
        // Autocompletar descripción
        const descripcion = selectedOption.getAttribute('data-descripcion');
        document.getElementById('descripcion').value = descripcion;
        
        // Autocompletar nivel
        const nivel = selectedOption.getAttribute('data-nivel');
        document.getElementById('nivel').value = nivel;
        
        // Autocompletar horas
        const horas = selectedOption.getAttribute('data-horas');
        document.getElementById('horas_semanales').value = horas;
        
        // Autocompletar créditos
        const creditos = selectedOption.getAttribute('data-creditos');
        document.getElementById('creditos').value = creditos;
    } else {
        // Limpiar campos si se deselecciona
        document.getElementById('descripcion').value = '';
        document.getElementById('nivel').value = '';
        document.getElementById('horas_semanales').value = '3';
        document.getElementById('creditos').value = '3';
    }
});

// Autocompletar al cargar si hay valores previos (old values)
document.addEventListener('DOMContentLoaded', function() {
    const nombreSelect = document.getElementById('nombre');
    if (nombreSelect.value) {
        nombreSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
