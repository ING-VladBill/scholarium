<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Obtener estudiante si existe
            $est = \App\Models\Estudiante::where('user_id', Auth::id())->first();

            // Determinar saludo
            $saludo = match($est->genero ?? 'Masculino') {
                'Femenino' => 'Bienvenida',
                'Masculino' => 'Bienvenido',
                default => 'Bienvenid@',
            };

            return redirect()->intended('dashboard')
                ->with('success', "¡$saludo " . Auth::user()->name . "!");
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Mostrar formulario de registro
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    // Procesar registro de estudiante
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date|before:today|after:' . date('Y-m-d', strtotime('-18 years')),
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'genero' => 'required|in:Masculino,Femenino',
        ]);

        // Validar edad (6-17 años)
        $edad = \Carbon\Carbon::parse($validated['fecha_nacimiento'])->age;
        if ($edad < 6 || $edad > 17) {
            return back()->withErrors(['fecha_nacimiento' => 'Debes tener entre 6 y 17 años para registrarte.'])->withInput();
        }

        // Crear usuario con nombre completo
        $nombreCompleto = $validated['nombres'] . ' ' . $validated['apellidos'];
        
        $user = User::create([
            'name' => $nombreCompleto,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'estudiante'
        ]);

        // Generar DNI temporal único (se actualizará después por el estudiante)
        // Formato: 00000XXX donde XXX es el ID del usuario (DNI peruano tiene 8 dígitos)
        $dniTemporal = str_pad($user->id, 8, '0', STR_PAD_LEFT);
        
        // Crear registro de estudiante automáticamente
        Estudiante::create([
            'user_id' => $user->id,
            'dni' => $dniTemporal, // DNI temporal único basado en ID de usuario
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'email' => $validated['email'],
            'telefono' => '',
            'direccion' => '',
            'genero' => $validated['genero'],
            'estado' => 'Activo',
            'fecha_ingreso' => now()
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', '¡Registro exitoso! Bienvenido a Scholarium, ' . $validated['nombres'] . '.');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Sesión cerrada correctamente.');
    }

    // Dashboard principal
    public function dashboard()
    {
        $user = Auth::user();
        
        // Estadísticas para administradores
        if ($user->role === 'admin') {
            $totalEstudiantes = \App\Models\Estudiante::count();
            $totalCursos = \App\Models\Curso::where('estado', 'Activo')->count();
            $totalMatriculas = \App\Models\Matricula::where('estado', 'Aprobada')->count();
            
            // Contar estudiantes con datos incompletos
            $estudiantesIncompletos = \App\Models\Estudiante::where(function($q) {
                $q->where('dni', 'like', '00000%')
                  ->orWhereNull('telefono')
                  ->orWhere('telefono', '')
                  ->orWhereNull('direccion')
                  ->orWhere('direccion', '');
            })->count();
            
            return view('dashboard.admin', compact('totalEstudiantes', 'totalCursos', 'totalMatriculas', 'estudiantesIncompletos'));
        }
        elseif (Auth::user()->role === 'estudiante') {
            return view('dashboard.estudiante');
        } elseif (Auth::user()->role === 'profesor') {
            return view('dashboard.profesor');
        } else {
            // Dashboard genérico para otros roles
            return view('dashboard.index');
        }
    }

    // Mostrar formulario de registro de administrador (solo para admins)
    public function showRegisterAdmin()
    {
        // Verificar que el usuario sea admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta página.');
        }
        
        return view('auth.register_admin');
    }

    // Procesar registro de administrador
    public function registerAdmin(Request $request)
    {
        // Verificar que el usuario sea admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Crear usuario con rol admin
        $nombreCompleto = $validated['nombres'] . ' ' . $validated['apellidos'];
        
        $user = User::create([
            'name' => $nombreCompleto,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin'
        ]);

        return redirect()->route('admin.register')
            ->with('success', '¡Administrador creado exitosamente! Usuario: ' . $validated['email']);
    }
}
