<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
            return redirect()->intended('dashboard')->with('success', '¡Bienvenido ' . Auth::user()->name . '!');
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

    // Procesar registro
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'estudiante'
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', '¡Registro exitoso! Bienvenido a Scholarium.');
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
            $totalMatriculas = \App\Models\Matricula::where('estado', 'Matriculado')->count();
            
            return view('dashboard.admin', compact('totalEstudiantes', 'totalCursos', 'totalMatriculas'));
        }
        
        // Dashboard para otros roles
        return view('dashboard.index');
    }
}
