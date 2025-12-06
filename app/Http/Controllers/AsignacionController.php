<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Curso;
use App\Models\Asignatura;
use App\Models\Docente;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        
        // Verificar horas ya asignadas para esta asignatura en este curso
        $horasAsignadas = Asignacion::where('curso_id', $cursoId)
                                   ->where('asignatura_id', $asignaturaId)
                                   ->where('estado', 'Activo')
                                   ->count();
        
        $horasRestantes = $asignatura->horas_semanales - $horasAsignadas;
        
        if ($horasRestantes <= 0) {
            return redirect()->route('asignaciones.index')
                           ->with('error', 'Esta asignatura ya tiene todas sus horas asignadas en este curso.');
        }
        
        $docentes = Docente::where('estado', 'Activo')->orderBy('apellidos')->get();
        return view('asignaciones.seleccionar-docente', compact('curso', 'asignatura', 'docentes', 'horasAsignadas', 'horasRestantes'));
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

        // Validar que hora_fin sea mayor que hora_inicio
        if ($validated['hora_fin'] <= $validated['hora_inicio']) {
            return back()->withInput()->with('error', 'La hora de fin debe ser posterior a la hora de inicio.');
        }

        // Validar horas semanales de la asignatura
        $asignatura = Asignatura::findOrFail($validated['asignatura_id']);
        $horasAsignadas = Asignacion::where('curso_id', $validated['curso_id'])
                                   ->where('asignatura_id', $validated['asignatura_id'])
                                   ->where('estado', 'Activo')
                                   ->count();
        
        if ($horasAsignadas >= $asignatura->horas_semanales) {
            return back()->withInput()->with('error', 'Esta asignatura ya tiene todas sus ' . $asignatura->horas_semanales . ' horas semanales asignadas.');
        }

        // Validar conflicto de horario del docente
        $conflictoDocente = $this->verificarConflictoHorario(
            $validated['docente_id'],
            $validated['dia_semana'],
            $validated['hora_inicio'],
            $validated['hora_fin'],
            'docente'
        );

        if ($conflictoDocente) {
            return back()->withInput()->with('error', 'El docente ya tiene una clase asignada en este horario: ' . $conflictoDocente);
        }

        // Validar conflicto de horario del curso (estudiantes)
        $conflictoCurso = $this->verificarConflictoHorario(
            $validated['curso_id'],
            $validated['dia_semana'],
            $validated['hora_inicio'],
            $validated['hora_fin'],
            'curso'
        );

        if ($conflictoCurso) {
            return back()->withInput()->with('error', 'El curso ya tiene una clase asignada en este horario: ' . $conflictoCurso);
        }

        Asignacion::create($validated);
        
        // Verificar si aún quedan horas por asignar
        $horasRestantes = $asignatura->horas_semanales - ($horasAsignadas + 1);
        
        if ($horasRestantes > 0) {
            return redirect()->route('asignaciones.seleccionar-docente', [
                'curso' => $validated['curso_id'],
                'asignatura' => $validated['asignatura_id']
            ])->with('success', 'Asignación creada. Aún quedan ' . $horasRestantes . ' hora(s) por asignar para esta asignatura.');
        }
        
        return redirect()->route('asignaciones.listar')->with('success', 'Asignación creada exitosamente. Todas las horas de la asignatura han sido asignadas.');
    }

    /**
     * Verificar conflictos de horario
     */
    private function verificarConflictoHorario($id, $dia, $horaInicio, $horaFin, $tipo)
    {
        $query = Asignacion::where('dia_semana', $dia)
                          ->where('estado', 'Activo');

        if ($tipo == 'docente') {
            $query->where('docente_id', $id);
        } else {
            $query->where('curso_id', $id);
        }

        $asignaciones = $query->get();

        foreach ($asignaciones as $asignacion) {
            // Verificar si hay solapamiento de horarios
            if ($this->horariosSeSolapan($horaInicio, $horaFin, $asignacion->hora_inicio, $asignacion->hora_fin)) {
                $entidad = $tipo == 'docente' ? $asignacion->docente->nombres : $asignacion->curso->nombre;
                return $dia . ' ' . $asignacion->hora_inicio . '-' . $asignacion->hora_fin . ' (' . $asignacion->asignatura->nombre . ')';
            }
        }

        return false;
    }

    /**
     * Verificar si dos rangos de horarios se solapan
     */
    private function horariosSeSolapan($inicio1, $fin1, $inicio2, $fin2)
    {
        return ($inicio1 < $fin2) && ($fin1 > $inicio2);
    }

    /**
     * Obtener días disponibles para un docente
     */
    public function getDiasDisponibles(Request $request)
    {
        $docenteId = $request->input('docente_id');
        $horaInicio = $request->input('hora_inicio');
        $horaFin = $request->input('hora_fin');

        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $diasDisponibles = [];

        foreach ($diasSemana as $dia) {
            if (!$this->verificarConflictoHorario($docenteId, $dia, $horaInicio, $horaFin, 'docente')) {
                $diasDisponibles[] = $dia;
            }
        }

        return response()->json($diasDisponibles);
    }

    public function listar()
    {
        $asignaciones = Asignacion::with(['curso', 'asignatura', 'docente'])
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(15);
        return view('asignaciones.listar', compact('asignaciones'));
    }

    public function show($id)
    {
        $asignacion = Asignacion::with(['docente', 'asignatura', 'curso'])->findOrFail($id);
        return view('asignaciones.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $cursos = Curso::where('estado', 'Activo')->get();
        $asignaturas = Asignatura::where('estado', 'Activo')->get();
        $docentes = Docente::where('estado', 'Activo')->get();
        
        return view('asignaciones.edit', compact('asignacion', 'cursos', 'asignaturas', 'docentes'));
    }
    
    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);
        
        $validated = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'docente_id' => 'required|exists:docentes,id',
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        // Validar conflictos excluyendo la asignación actual
        $conflictoDocente = Asignacion::where('docente_id', $validated['docente_id'])
                                     ->where('dia_semana', $validated['dia_semana'])
                                     ->where('id', '!=', $id)
                                     ->where('estado', 'Activo')
                                     ->where(function($query) use ($validated) {
                                         $query->whereBetween('hora_inicio', [$validated['hora_inicio'], $validated['hora_fin']])
                                               ->orWhereBetween('hora_fin', [$validated['hora_inicio'], $validated['hora_fin']]);
                                     })
                                     ->exists();

        if ($conflictoDocente) {
            return back()->withInput()->with('error', 'El docente ya tiene una clase en este horario.');
        }

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
