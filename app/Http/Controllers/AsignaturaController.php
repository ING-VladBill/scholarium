<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    // Asignaturas predefinidas con sus descripciones
    private $asignaturasPredefinidas = [
        'Comunicación' => [
            'descripcion' => 'Desarrollo de competencias comunicativas orales y escritas, comprensión lectora y producción de textos.',
            'nivel' => 'Básica',
            'horas' => 6,
            'creditos' => 5
        ],
        'Matemática' => [
            'descripcion' => 'Desarrollo del pensamiento lógico-matemático, resolución de problemas y razonamiento cuantitativo.',
            'nivel' => 'Básica',
            'horas' => 6,
            'creditos' => 5
        ],
        'Personal Social' => [
            'descripcion' => 'Formación ciudadana, identidad personal y social, comprensión del entorno histórico y geográfico.',
            'nivel' => 'Básica',
            'horas' => 3,
            'creditos' => 3
        ],
        'Ciencia y Tecnología' => [
            'descripcion' => 'Exploración y comprensión del mundo natural, método científico y aplicación tecnológica.',
            'nivel' => 'Básica',
            'horas' => 4,
            'creditos' => 4
        ],
        'Arte y Cultura' => [
            'descripcion' => 'Expresión artística, apreciación cultural y desarrollo de la creatividad a través de diversas manifestaciones.',
            'nivel' => 'Básica',
            'horas' => 2,
            'creditos' => 2
        ],
        'Educación Física' => [
            'descripcion' => 'Desarrollo de habilidades motrices, práctica deportiva y promoción de hábitos saludables.',
            'nivel' => 'Básica',
            'horas' => 2,
            'creditos' => 2
        ],
        'Inglés' => [
            'descripcion' => 'Desarrollo de competencias comunicativas en lengua inglesa: comprensión, expresión oral y escrita.',
            'nivel' => 'Básica',
            'horas' => 3,
            'creditos' => 3
        ],
        'Ciencias Sociales' => [
            'descripcion' => 'Análisis crítico de procesos históricos, geográficos, económicos y sociales del Perú y el mundo.',
            'nivel' => 'Media',
            'horas' => 4,
            'creditos' => 4
        ],
        'Educación para el Trabajo' => [
            'descripcion' => 'Desarrollo de competencias laborales, emprendimiento y gestión de proyectos productivos.',
            'nivel' => 'Media',
            'horas' => 3,
            'creditos' => 3
        ],
        'Desarrollo Personal, Ciudadanía y Cívica' => [
            'descripcion' => 'Formación ética, ciudadana y desarrollo de habilidades socioemocionales para la vida.',
            'nivel' => 'Media',
            'horas' => 2,
            'creditos' => 2
        ],
    ];

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
        $asignaturasPredefinidas = $this->asignaturasPredefinidas;
        return view('asignaturas.create', compact('asignaturasPredefinidas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'nivel' => 'required|in:Básica,Media',
            'horas_semanales' => 'required|integer|min:1|max:10',
            'creditos' => 'required|integer|min:1|max:10',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        // Generar código automáticamente
        $validated['codigo'] = $this->generarCodigo($validated['nombre'], $validated['nivel']);

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
        $asignaturasPredefinidas = $this->asignaturasPredefinidas;
        return view('asignaturas.edit', compact('asignatura', 'asignaturasPredefinidas'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'nivel' => 'required|in:Básica,Media',
            'horas_semanales' => 'required|integer|min:1|max:10',
            'creditos' => 'required|integer|min:1|max:10',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        // Regenerar código si cambió el nombre o nivel
        if ($asignatura->nombre != $validated['nombre'] || $asignatura->nivel != $validated['nivel']) {
            $validated['codigo'] = $this->generarCodigo($validated['nombre'], $validated['nivel']);
        }

        $asignatura->update($validated);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada exitosamente.');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada exitosamente.');
    }

    /**
     * Generar código automático para la asignatura
     */
    private function generarCodigo($nombre, $nivel)
    {
        // Prefijo según nivel
        $prefijo = $nivel == 'Básica' ? 'BAS' : 'MED';
        
        // Tomar las primeras 3 letras del nombre (sin espacios ni tildes)
        $nombreLimpio = $this->limpiarTexto($nombre);
        $iniciales = strtoupper(substr($nombreLimpio, 0, 3));
        
        // Buscar si ya existe y agregar número consecutivo
        $contador = 1;
        $codigo = $prefijo . $iniciales . str_pad($contador, 2, '0', STR_PAD_LEFT);
        
        while (Asignatura::where('codigo', $codigo)->exists()) {
            $contador++;
            $codigo = $prefijo . $iniciales . str_pad($contador, 2, '0', STR_PAD_LEFT);
        }
        
        return $codigo;
    }

    /**
     * Limpiar texto de tildes y caracteres especiales
     */
    private function limpiarTexto($texto)
    {
        $texto = str_replace(' ', '', $texto);
        $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
        $texto = preg_replace('/[^A-Za-z]/', '', $texto);
        return $texto;
    }

    /**
     * API para obtener información de asignatura predefinida
     */
    public function getAsignaturaInfo(Request $request)
    {
        $nombre = $request->input('nombre');
        
        if (isset($this->asignaturasPredefinidas[$nombre])) {
            return response()->json($this->asignaturasPredefinidas[$nombre]);
        }
        
        return response()->json([
            'descripcion' => '',
            'nivel' => 'Básica',
            'horas' => 3,
            'creditos' => 3
        ]);
    }
}
