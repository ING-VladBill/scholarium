<?php
namespace App\Http\Controllers;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        $query = Contacto::query()->orderBy('created_at', 'desc');
        if ($request->has('estado')) {
            if ($request->estado === 'leidos') {
                $query->where('leido', true);
            } elseif ($request->estado === 'no_leidos') {
                $query->where('leido', false);
            }
        }
        if ($request->has('buscar') && $request->buscar != '') {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('email', 'like', "%{$buscar}%")
                  ->orWhere('asunto', 'like', "%{$buscar}%");
            });
        }
        $contactos = $query->paginate(15);
        $noLeidos = Contacto::where('leido', false)->count();
        return view('contactos.index', compact('contactos', 'noLeidos'));
    }

    public function show($id)
    {
        $contacto = Contacto::findOrFail($id);
        if (!$contacto->leido) {
            $contacto->update(['leido' => true]);
        }
        return view('contactos.show', compact('contacto'));
    }

    public function marcarLeido($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->update(['leido' => !$contacto->leido]);
        return redirect()->route('contactos.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->delete();
        return redirect()->route('contactos.index')->with('success', 'Mensaje eliminado correctamente.');
    }
}
