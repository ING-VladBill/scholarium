<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $query = Docente::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                  ->orWhere('nombres', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('especialidad', 'like', "%{$search}%");
            });
        }

        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        $docentes = $query->orderBy('apellidos')->paginate(10);
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|digits:8|unique:docentes,dni',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:docentes,email',
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'required|string|max:100',
            'fecha_contratacion' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        Docente::create($validated);
        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente.');
    }

    public function show(Docente $docente)
    {
        $docente->load('asignaciones.curso', 'asignaciones.asignatura');
        return view('docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $validated = $request->validate([
            'dni' => 'required|digits:8|unique:docentes,dni,' . $docente->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|email|unique:docentes,email,' . $docente->id,
            'telefono' => 'nullable|string|max:20',
            'especialidad' => 'required|string|max:100',
            'fecha_contratacion' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $docente->update($validated);
        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
