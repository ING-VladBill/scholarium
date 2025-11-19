<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Estudiante::query();

        // Búsqueda
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                  ->orWhere('nombres', 'like', "%{$search}%")
                  ->orWhere('apellidos', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        // Filtro por datos incompletos/completos
        if ($request->has('datos') && $request->datos != '') {
            if ($request->datos == 'incompletos') {
                // Estudiantes con DNI temporal O sin teléfono O sin dirección
                $query->where(function($q) {
                    $q->where('dni', 'like', '00000%')
                      ->orWhereNull('telefono')
                      ->orWhere('telefono', '')
                      ->orWhereNull('direccion')
                      ->orWhere('direccion', '');
                });
            } elseif ($request->datos == 'completos') {
                // Estudiantes con todos los datos completos
                $query->where('dni', 'not like', '00000%')
                      ->whereNotNull('telefono')
                      ->where('telefono', '!=', '')
                      ->whereNotNull('direccion')
                      ->where('direccion', '!=', '');
            }
        }

        $estudiantes = $query->orderBy('apellidos', 'asc')->paginate(10)->appends($request->query());
        
        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estudiantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:12|unique:estudiantes,dni',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date|before:today',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_ingreso' => 'required|date',
        ]);

        Estudiante::create($validated);

        return redirect()->route('estudiantes.index')
                        ->with('success', 'Estudiante creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        $estudiante->load('matriculas.curso');
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $validated = $request->validate([
            'dni' => 'required|string|max:12|unique:estudiantes,dni,' . $estudiante->id,
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date|before:today',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_ingreso' => 'required|date',
        ]);

        $estudiante->update($validated);

        return redirect()->route('estudiantes.index')
                        ->with('success', 'Estudiante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        // Verificar si tiene matrículas activas
        $matriculasActivas = $estudiante->matriculas()->where('estado', 'Matriculado')->count();
        
        if ($matriculasActivas > 0) {
            return redirect()->route('estudiantes.index')
                           ->with('error', 'No se puede eliminar el estudiante porque tiene matrículas activas.');
        }

        $estudiante->delete();

        return redirect()->route('estudiantes.index')
                        ->with('success', 'Estudiante eliminado exitosamente.');
    }
}
