<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DocenteController extends Controller
{
    // Especialidades predefinidas basadas en Innova Schools
    private $especialidades = [
        // Primaria
        'Comunicación',
        'Matemática',
        'Personal Social',
        'Ciencia y Tecnología',
        'Arte y Cultura',
        'Educación Física',
        'Inglés',
        // Secundaria
        'Ciencias Sociales',
        'Educación para el Trabajo',
        'Desarrollo Personal, Ciudadanía y Cívica',
    ];

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
        $especialidades = $this->especialidades;
        return view('docentes.create', compact('especialidades'));
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
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        // Crear el docente
        $docente = Docente::create($validated);

        // Generar contraseña temporal
        $passwordTemporal = 'Scholarium' . rand(1000, 9999);

        // Crear usuario automáticamente
        $user = User::create([
            'name' => $validated['nombres'] . ' ' . $validated['apellidos'],
            'email' => $validated['email'],
            'password' => Hash::make($passwordTemporal),
            'role' => 'profesor',
            'docente_id' => $docente->id,
        ]);

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado exitosamente.')
            ->with('password_temporal', $passwordTemporal)
            ->with('docente_nombre', $user->name);
    }

    public function show(Docente $docente)
    {
        $docente->load('asignaciones.curso', 'asignaciones.asignatura');
        
        // Calcular estadísticas
        $totalAsignaciones = $docente->asignaciones->count();
        $cursosUnicos = $docente->asignaciones->pluck('curso_id')->unique()->count();
        $horasSemanales = $docente->asignaciones->sum(function($asignacion) {
            return $asignacion->asignatura->horas_semanales ?? 0;
        });

        // Organizar horario por día y hora
        $horarioPorDia = [
            'Lunes' => [],
            'Martes' => [],
            'Miércoles' => [],
            'Jueves' => [],
            'Viernes' => [],
        ];

        foreach ($docente->asignaciones as $asignacion) {
            $dia = $asignacion->dia_semana;
            if (isset($horarioPorDia[$dia])) {
                $horarioPorDia[$dia][] = $asignacion;
            }
        }

        return view('docentes.show', compact('docente', 'totalAsignaciones', 'cursosUnicos', 'horasSemanales', 'horarioPorDia'));
    }

    public function edit(Docente $docente)
    {
        $especialidades = $this->especialidades;
        return view('docentes.edit', compact('docente', 'especialidades'));
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
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $docente->update($validated);

        // Actualizar usuario si existe
        $user = User::where('docente_id', $docente->id)->first();
        if ($user) {
            $user->update([
                'name' => $validated['nombres'] . ' ' . $validated['apellidos'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy(Docente $docente)
    {
        // Eliminar usuario asociado si existe
        $user = User::where('docente_id', $docente->id)->first();
        if ($user) {
            $user->delete();
        }

        $docente->delete();
        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}
