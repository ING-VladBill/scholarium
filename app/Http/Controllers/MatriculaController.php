<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Estudiante;
use App\Models\Curso;

class MatriculaController extends Controller
{
    // Paso 1: Mostrar cursos disponibles
    public function index()
    {
        $cursos = Curso::where('estado', 'Activo')
                      ->orderBy('nivel')
                      ->orderBy('grado')
                      ->get();
        
        return view('matriculas.index', compact('cursos'));
    }

    // Paso 2: Seleccionar estudiante para el curso
    public function seleccionarEstudiante($cursoId)
    {
        $curso = Curso::findOrFail($cursoId);
        
        // Verificar cupos disponibles
        if ($curso->cupos_disponibles <= 0) {
            return redirect()->route('matriculas.index')
                           ->with('error', 'El curso no tiene cupos disponibles.');
        }
        
        // Obtener estudiantes activos
        $estudiantes = Estudiante::where('estado', 'Activo')
                                ->orderBy('apellidos')
                                ->get();
        
        return view('matriculas.seleccionar-estudiante', compact('curso', 'estudiantes'));
    }

    // Paso 3: Confirmar y crear matrícula
    public function store(Request $request)
    {
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'fecha_matricula' => 'required|date',
            'observaciones' => 'nullable|string'
        ]);

        // Obtener estudiante y curso
        $estudiante = Estudiante::findOrFail($validated['estudiante_id']);
        $curso = Curso::findOrFail($validated['curso_id']);

        // VALIDACIÓN DE EDAD SEGÚN NIVEL
        $edad = \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->age;
        
        if ($curso->nivel === 'Básica' && ($edad < 6 || $edad > 11)) {
            return back()->with('error', 'El estudiante tiene ' . $edad . ' años. Para nivel Básica debe tener entre 6 y 11 años.');
        }
        
        if ($curso->nivel === 'Media' && ($edad < 12 || $edad > 17)) {
            return back()->with('error', 'El estudiante tiene ' . $edad . ' años. Para nivel Media debe tener entre 12 y 17 años.');
        }

        // Verificar que el estudiante NO esté matriculado en NINGÚN curso del mismo año académico
        $yaMatriculado = Matricula::where('estudiante_id', $validated['estudiante_id'])
                                  ->where('estado', 'Aprobada')
                                  ->whereHas('curso', function($query) use ($curso) {
                                      $query->where('anio_academico', $curso->anio_academico);
                                  })
                                  ->with('curso')
                                  ->first();
        
        if ($yaMatriculado) {
            return back()->with('error', 'El estudiante ya está matriculado en el curso "' . $yaMatriculado->curso->nombre . '" para el año académico ' . $curso->anio_academico . '. Un estudiante solo puede estar matriculado en UN curso por año.');
        }

        // Verificar cupos
        if ($curso->cupos_disponibles <= 0) {
            return back()->with('error', 'El curso no tiene cupos disponibles.');
        }

        $validated['estado'] = 'Aprobada';
        $matricula = Matricula::create($validated);

        // Datos para el feedback
        $estudiante = Estudiante::findOrFail($validated['estudiante_id']);
        $mensaje_exito = '¡Matrícula completada exitosamente! ' . 
                        $estudiante->nombres . ' ' . $estudiante->apellidos . 
                        ' ha sido matriculado en ' . $curso->nombre . '. ' .
                        'Cupos restantes: ' . ($curso->cupos_disponibles - 1);

        return redirect()->route('matriculas.listar')
                        ->with('success', $mensaje_exito)
                        ->with('matricula_nueva', $matricula->id);
    }

    // Listar todas las matrículas
    public function listar()
    {
        $matriculas = Matricula::with(['estudiante', 'curso'])
                              ->orderBy('created_at', 'desc')
                              ->paginate(15);
        
        return view('matriculas.listar', compact('matriculas'));
    }

    // Ver detalle de matrícula
    public function show($id)
    {
        $matricula = Matricula::with(['estudiante', 'curso'])->findOrFail($id);
        return view('matriculas.show', compact('matricula'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $matricula = Matricula::findOrFail($id);
        $cursos = Curso::where('estado', 'Activo')->get();
        $estudiantes = Estudiante::where('estado', 'Activo')->get();
        
        return view('matriculas.edit', compact('matricula', 'cursos', 'estudiantes'));
    }

    // Actualizar matrícula
    public function update(Request $request, $id)
    {
        $matricula = Matricula::findOrFail($id);
        
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|in:Matriculado,Retirado',
            'observaciones' => 'nullable|string'
        ]);

        // Obtener estudiante y curso
        $estudiante = Estudiante::findOrFail($validated['estudiante_id']);
        $curso = Curso::findOrFail($validated['curso_id']);

        // VALIDACIÓN DE EDAD SEGÚN NIVEL
        $edad = \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->age;
        
        if ($curso->nivel === 'Básica' && ($edad < 6 || $edad > 11)) {
            return back()->with('error', 'El estudiante tiene ' . $edad . ' años. Para nivel Básica debe tener entre 6 y 11 años.');
        }
        
        if ($curso->nivel === 'Media' && ($edad < 12 || $edad > 17)) {
            return back()->with('error', 'El estudiante tiene ' . $edad . ' años. Para nivel Media debe tener entre 12 y 17 años.');
        }

        // Verificar duplicados (excepto la matrícula actual)
        $existe = Matricula::where('curso_id', $validated['curso_id'])
                          ->where('estudiante_id', $validated['estudiante_id'])
                          ->where('id', '!=', $id)
                          ->where('estado', 'Matriculado')
                          ->exists();
        
        if ($existe) {
            return back()->with('error', 'El estudiante ya está matriculado en este curso.');
        }

        $matricula->update($validated);

        return redirect()->route('matriculas.listar')
                        ->with('success', 'Matrícula actualizada exitosamente.');
    }

    // Eliminar/Anular matrícula
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();

        return redirect()->route('matriculas.listar')
                        ->with('success', 'Matrícula eliminada exitosamente.');
    }

    // ESTUDIANTE: Solicitar matrícula
    public function solicitar(Request $request)
    {
        
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id'
        ]);

        $curso = Curso::findOrFail($validated['curso_id']);
        
        
        $estudiante = Estudiante::where('user_id', auth()->id())->first();
        
        if (!$estudiante) {
            return back()->with('error', 'No se encontró tu perfil de estudiante. Por favor contacta al administrador.');
        }
        
    

        // Validar edad
        $edad = \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->age;

        
        if ($curso->nivel === 'Básica' && ($edad < 6 || $edad > 11)) {
            return back()->with('error', 'Tienes ' . $edad . ' años. Para Básica debes tener entre 6 y 11 años.');
        }
        if ($curso->nivel === 'Media' && ($edad < 12 || $edad > 17)) {
            return back()->with('error', 'Tienes ' . $edad . ' años. Para Media debes tener entre 12 y 17 años.');
        }


        // Verificar que NO esté matriculado en ningún curso del mismo año académico
        $yaMatriculado = Matricula::where('estudiante_id', $estudiante->id)
                                  ->whereIn('estado', ['Pendiente', 'Aprobada'])
                                  ->whereHas('curso', function($query) use ($curso) {
                                      $query->where('anio_academico', $curso->anio_academico);
                                  })
                                  ->with('curso')
                                  ->first();
        
        if ($yaMatriculado) {
            $estadoTexto = $yaMatriculado->estado == 'Pendiente' ? 'tienes una solicitud pendiente' : 'ya estás matriculado';
            return back()->with('error', 'Ya ' . $estadoTexto . ' en el curso "' . $yaMatriculado->curso->nombre . '" para el año académico ' . $curso->anio_academico . '. Solo puedes estar matriculado en UN curso por año.');
        }

        // Verificar cupos disponibles
        if ($curso->cupos_disponibles <= 0) {
            return back()->with('error', 'Lo sentimos, el curso "' . $curso->nombre . '" no tiene cupos disponibles.');
        }



    $matricula = Matricula::create([
        'curso_id' => $validated['curso_id'],
        'estudiante_id' => $estudiante->id,
        'fecha_matricula' => now(),
        'estado' => 'Pendiente'
    ]);

    return redirect('/dashboard/estudiante')
        ->with('success', '¡Solicitud enviada exitosamente!')
        ->with('nueva_matricula_id', $matricula->id);
    }

    // ADMIN: Aprobar solicitud
    public function aprobar($id)
    {
        $matricula = Matricula::with(['estudiante.user', 'curso'])->findOrFail($id);
        
        // Verificar que el estudiante NO esté matriculado en otro curso del mismo año
        $yaMatriculado = Matricula::where('estudiante_id', $matricula->estudiante_id)
                                  ->where('id', '!=', $id) // Excluir la solicitud actual
                                  ->where('estado', 'Aprobada')
                                  ->whereHas('curso', function($query) use ($matricula) {
                                      $query->where('anio_academico', $matricula->curso->anio_academico);
                                  })
                                  ->with('curso')
                                  ->first();
        
        if ($yaMatriculado) {
            return back()->with('error', 'No se puede aprobar. El estudiante ya está matriculado en "' . $yaMatriculado->curso->nombre . '" para el año ' . $matricula->curso->anio_academico . '. Un estudiante solo puede estar en UN curso por año.');
        }
        
        // Verificar cupos disponibles antes de aprobar
        if ($matricula->curso->cupos_disponibles <= 0) {
            return back()->with('error', 'No se puede aprobar la matrícula. El curso "' . $matricula->curso->nombre . '" no tiene cupos disponibles.');
        }
        
        $matricula->update(['estado' => 'Aprobada']);
        
        // Crear notificación para el estudiante
        session()->put('notificacion_estudiante_' . $matricula->estudiante->user_id, [
            'tipo' => 'success',
            'mensaje' => '¡Tu solicitud de matrícula en ' . $matricula->curso->nombre . ' ha sido APROBADA!'
        ]);
        
        return back()->with('success', 'Matrícula aprobada exitosamente. El estudiante será notificado.');
    }

    // ADMIN: Rechazar solicitud
    public function rechazar($id)
    {
        $matricula = Matricula::with(['estudiante.user', 'curso'])->findOrFail($id);
        $matricula->update(['estado' => 'Rechazada']);
        
        // Crear notificación para el estudiante
        session()->put('notificacion_estudiante_' . $matricula->estudiante->user_id, [
            'tipo' => 'danger',
            'mensaje' => 'Tu solicitud de matrícula en ' . $matricula->curso->nombre . ' ha sido rechazada.'
        ]);
        
        return back()->with('success', 'Matrícula rechazada. El estudiante será notificado.');
    }

    // ADMIN: Ver solicitudes pendientes
    public function solicitudes()
    {
        $solicitudes = Matricula::with(['estudiante', 'curso'])
                                ->where('estado', 'Pendiente')
                                ->orderBy('created_at', 'desc')
                                ->paginate(15);
        
        return view('matriculas.solicitudes', compact('solicitudes'));
    }
}