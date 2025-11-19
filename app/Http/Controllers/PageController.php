<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function nosotros()
    {
        return view('pages.nosotros');
    }

    public function contacto()
    {
        return view('pages.contacto');
    }

    public function enviarContacto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string|max:1000'
        ]);

        // Guardar mensaje en base de datos
        Contacto::create($validated);
        
        return redirect()->route('contacto')
                        ->with('success', 'Mensaje enviado exitosamente. Nos pondremos en contacto pronto.');
    }
}
