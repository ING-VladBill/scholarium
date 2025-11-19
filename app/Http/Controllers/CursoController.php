<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Curso::query();

        // Filtro por nivel
        if ($request->has('nivel') && $request->nivel != '') {
            $query->where('nivel', $request->nivel);
        }

        // Filtro por estado
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        // Búsqueda
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('sala', 'like', "%{$search}%");
            });
        }

        $cursos = $query->orderBy('nivel', 'asc')
                       ->orderBy('grado', 'asc')
                       ->orderBy('seccion', 'asc')
                       ->paginate(10);
        
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'nivel' => 'required|in:Básica,Media',
            'grado' => 'required|integer|min:1|max:8',
            'seccion' => 'required|string|max:10',
            'anio_academico' => 'required|integer|min:2020|max:2030',
            'capacidad_maxima' => 'required|integer|min:1|max:50',
            'sala' => 'nullable|string|max:50',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        Curso::create($validated);

        return redirect()->route('cursos.index')
                        ->with('success', 'Curso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        $curso->load('matriculas.estudiante');
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'nivel' => 'required|in:Básica,Media',
            'grado' => 'required|integer|min:1|max:8',
            'seccion' => 'required|string|max:10',
            'anio_academico' => 'required|integer|min:2020|max:2030',
            'capacidad_maxima' => 'required|integer|min:1|max:50',
            'sala' => 'nullable|string|max:50',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $curso->update($validated);

        return redirect()->route('cursos.index')
                        ->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        // Verificar si tiene estudiantes matriculados
        $matriculasActivas = $curso->matriculas()->where('estado', 'Matriculado')->count();
        
        if ($matriculasActivas > 0) {
            return redirect()->route('cursos.index')
                           ->with('error', 'No se puede eliminar el curso porque tiene estudiantes matriculados.');
        }

        $curso->delete();

        return redirect()->route('cursos.index')
                        ->with('success', 'Curso eliminado exitosamente.');
    }
}
