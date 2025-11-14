<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Curso;
use App\Models\Asignatura;
use App\Models\Docente;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('estado', 'Activo')->orderBy('nivel')->orderBy('grado')->get();
        return view('asignaciones.index', compact('cursos'));
    }

    public function seleccionarAsignatura($cursoId)
    {
        $curso = Curso::findOrFail($cursoId);
        $asignaturas = Asignatura::where('estado', 'Activo')
                                 ->where('nivel', $curso->nivel)
                                 ->orderBy('nombre')
                                 ->get();
        return view('asignaciones.seleccionar-asignatura', compact('curso', 'asignaturas'));
    }

    public function seleccionarDocente($cursoId, $asignaturaId)
    {
        $curso = Curso::findOrFail($cursoId);
        $asignatura = Asignatura::findOrFail($asignaturaId);
        
        $existe = Asignacion::where('curso_id', $cursoId)
                           ->where('asignatura_id', $asignaturaId)
                           ->where('estado', 'Activo')
                           ->exists();
        
        if ($existe) {
            return redirect()->route('asignaciones.index')
                           ->with('error', 'Esta asignatura ya está asignada en este curso.');
        }
        
        $docentes = Docente::where('estado', 'Activo')->orderBy('apellidos')->get();
        return view('asignaciones.seleccionar-docente', compact('curso', 'asignatura', 'docentes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'docente_id' => 'required|exists:docentes,id',
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $existe = Asignacion::where('curso_id', $validated['curso_id'])
                          ->where('asignatura_id', $validated['asignatura_id'])
                          ->where('estado', 'Activo')
                          ->exists();
        
        if ($existe) {
            return back()->with('error', 'Esta asignatura ya está asignada en este curso.');
        }

        Asignacion::create($validated);
        return redirect()->route('asignaciones.listar')->with('success', 'Asignación creada exitosamente.');
    }

    public function listar()
    {
        $asignaciones = Asignacion::with(['curso', 'asignatura', 'docente'])
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(15);
        return view('asignaciones.listar', compact('asignaciones'));
    }

    // Ver detalle de asignación
    public function show($id)
    {
        $asignacion = Asignacion::with(['docente', 'asignatura', 'curso'])->findOrFail($id);
        return view('asignaciones.show', compact('asignacion'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $cursos = Curso::where('estado', 'Activo')->get();
        $asignaturas = Asignatura::where('estado', 'Activo')->get();
        $docentes = Docente::where('estado', 'Activo')->get();
        
        return view('asignaciones.edit', compact('asignacion', 'cursos', 'asignaturas', 'docentes'));
    }
    
    // Actualizar asignación
    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);
        
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'docente_id' => 'required|exists:docentes,id',
            'horario' => 'required|string'
        ]);

        $asignacion->update($validated);

        return redirect()->route('asignaciones.listar')
                        ->with('success', 'Asignación actualizada exitosamente.');
    }

    public function destroy(Asignacion $asignacion)
    {
        $asignacion->delete();
        return redirect()->route('asignaciones.listar')->with('success', 'Asignación eliminada exitosamente.');
    }
}
