<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfesorPerfilController extends Controller
{
    /**
     * Mostrar el perfil del profesor autenticado
     */
    public function index()
    {
        $user = Auth::user();
        
        // Verificar que el usuario tenga un docente_id
        if (!$user->docente_id) {
            return redirect()->route('dashboard')->with('error', 'No se encontró tu registro de docente.');
        }
        
        $docente = Docente::find($user->docente_id);
        
        if (!$docente) {
            return redirect()->route('dashboard')->with('error', 'No se encontró tu registro de docente.');
        }
        
        return view('profesor.perfil', compact('user', 'docente'));
    }
    
    /**
     * Actualizar datos personales del docente
     */
    public function actualizarDatos(Request $request)
    {
        $user = Auth::user();
        $docente = Docente::find($user->docente_id);
        
        if (!$docente) {
            return redirect()->back()->with('error', 'No se encontró tu registro de docente.');
        }
        
        $request->validate([
            'telefono' => 'nullable|string|max:20',
        ]);
        
        // Actualizar solo el teléfono (otros campos no deben ser editables por el docente)
        $docente->telefono = $request->telefono;
        $docente->save();
        
        return redirect()->route('profesor.perfil')->with('success', 'Datos actualizados correctamente.');
    }
    
    /**
     * Actualizar contraseña del profesor
     */
    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'password_actual.required' => 'Debes ingresar tu contraseña actual.',
            'password.required' => 'Debes ingresar una nueva contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);
        
        $user = Auth::user();
        
        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->password_actual, $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual es incorrecta.');
        }
        
        // Actualizar la contraseña
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('profesor.perfil')->with('success', 'Contraseña actualizada correctamente.');
    }
}
