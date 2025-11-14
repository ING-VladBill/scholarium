<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index(Request $request)
    {
        $query = Asignatura::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('nombre', 'like', "%{$search}%");
            });
        }

        if ($request->has('nivel') && $request->nivel != '') {
            $query->where('nivel', $request->nivel);
        }

        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        $asignaturas = $query->orderBy('nombre')->paginate(10);
        return view('asignaturas.index', compact('asignaturas'));
    }

    public function create()
    {
        return view('asignaturas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:asignaturas,codigo',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'nivel' => 'required|in:Básica,Media',
            'horas_semanales' => 'required|integer|min:1|max:10',
            'creditos' => 'required|integer|min:1|max:10',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        Asignatura::create($validated);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada exitosamente.');
    }

    public function show(Asignatura $asignatura)
    {
        $asignatura->load('asignaciones.curso', 'asignaciones.docente');
        return view('asignaturas.show', compact('asignatura'));
    }

    public function edit(Asignatura $asignatura)
    {
        return view('asignaturas.edit', compact('asignatura'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:asignaturas,codigo,' . $asignatura->id,
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'nivel' => 'required|in:Básica,Media',
            'horas_semanales' => 'required|integer|min:1|max:10',
            'creditos' => 'required|integer|min:1|max:10',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $asignatura->update($validated);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada exitosamente.');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }
}
