<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use App\Models\Carpeta;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibliotecaController extends Controller
{
    // Muestra la biblioteca del usuario autenticado
    public function index()
    {
        $user = Auth::user();
        $biblioteca = $user->biblioteca;
        if (!$biblioteca) {
            $biblioteca = Biblioteca::create(['usuario_id' => $user->id]);
        }
        $carpetas = $biblioteca->carpetas()->orderBy('fecha_creacion', 'asc')->get();
        return view('biblioteca.index', compact('biblioteca', 'carpetas'));
    }

    // Muestra la biblioteca de otro usuario
    public function showUsuario($usuario_id)
    {
        $owner = \App\Models\Usuario::findOrFail($usuario_id);
        $biblioteca = $owner->biblioteca;
        if (!$biblioteca) {
            $biblioteca = Biblioteca::create(['usuario_id' => $owner->id]);
        }
        $carpetas = $biblioteca->carpetas()->orderBy('fecha_creacion', 'asc')->get();
        return view('biblioteca.index', [
            'biblioteca' => $biblioteca,
            'carpetas' => $carpetas,
            'owner' => $owner
        ]);
    }

    // Crea una nueva carpeta
    public function storeCarpeta(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'color' => 'required|string|max:20',
        ]);
        $user = Auth::user();
        $biblioteca = $user->biblioteca;
        if (!$biblioteca) {
            $biblioteca = Biblioteca::create(['usuario_id' => $user->id]);
        }
        $carpeta = new Carpeta([
            'nombre' => $request->nombre,
            'biblioteca_id' => $biblioteca->id,
            'color' => $request->color,
        ]);
        $carpeta->save();
        return redirect()->route('biblioteca.index')->with('success', 'Carpeta creada');
    }

    // Renombra o cambia el color de una carpeta
    public function updateCarpeta(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'color' => 'required|string|max:20',
        ]);
        $carpeta = Carpeta::findOrFail($id);
        $this->authorize('update', $carpeta);
        $carpeta->nombre = $request->nombre;
        $carpeta->color = $request->color;
        $carpeta->save();
        return back()->with('success', 'Carpeta actualizada');
    }

    // Elimina una carpeta
    public function destroyCarpeta($id)
    {
        $carpeta = Carpeta::findOrFail($id);
        $this->authorize('delete', $carpeta);
        $carpeta->delete();
        return back()->with('success', 'Carpeta eliminada');
    }

    // Muestra las publicaciones de una carpeta
    public function showCarpeta($id)
    {
        $carpeta = Carpeta::findOrFail($id);
        $this->authorize('view', $carpeta);
        $publicaciones = $carpeta->publicaciones()->orderBy('fecha_creacion', 'desc')->get();
        return view('biblioteca.carpeta', compact('carpeta', 'publicaciones'));
    }

    // API: Lista las carpetas del usuario autenticado (para el modal de guardar publicación)
    public function apiCarpetas()
    {
        \Log::channel('single')->debug('[API CARPETAS] Endpoint ejecutado');
        $user = auth()->user();
        \Log::channel('single')->debug('[API CARPETAS] Usuario detectado', ['user' => $user]);
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        $carpetas = $user->carpetas()->select('id_Carpeta', 'nombre', 'color')->get();
        return response()->json($carpetas);
    }
}