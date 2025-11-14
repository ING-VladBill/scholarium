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

        // Verificar que el estudiante no esté ya matriculado en ese curso
        $existe = Matricula::where('curso_id', $validated['curso_id'])
                          ->where('estudiante_id', $validated['estudiante_id'])
                          ->where('estado', 'Matriculado')
                          ->exists();
        
        if ($existe) {
            return back()->with('error', 'El estudiante ya está matriculado en este curso.');
        }

        // Verificar cupos
        if ($curso->cupos_disponibles <= 0) {
            return back()->with('error', 'El curso no tiene cupos disponibles.');
        }

        $validated['estado'] = 'Matriculado';
        Matricula::create($validated);

        return redirect()->route('matriculas.listar')
                        ->with('success', 'Matrícula realizada exitosamente.');
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
}
