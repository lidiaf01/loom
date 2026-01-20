<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use App\Models\Carpeta;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BibliotecaController extends Controller
{
    // Mostrar biblioteca del usuario autenticado
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

    // Crear carpeta
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

    // Renombrar/cambiar color carpeta
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

    // Eliminar carpeta
    public function destroyCarpeta($id)
    {
        $carpeta = Carpeta::findOrFail($id);
        $this->authorize('delete', $carpeta);
        $carpeta->delete();
        return back()->with('success', 'Carpeta eliminada');
    }

    // Ver publicaciones de una carpeta
    public function showCarpeta($id)
    {
        $carpeta = Carpeta::findOrFail($id);
        $this->authorize('view', $carpeta);
        $publicaciones = $carpeta->publicaciones()->orderBy('fecha_creacion', 'desc')->get();
        return view('biblioteca.carpeta', compact('carpeta', 'publicaciones'));
    }
}
