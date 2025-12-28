<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PublicacionController extends Controller
{
    private array $categorias = [
        'Salud & Bienestar',
        'Ejercicio & Movimiento',
        'Hobbies & Creatividad',
        'Cocina & Nutrición',
        'Desarrollo Personal',
        'Meditación & Mindfulness',
        'Relaciones & Familia',
        'Finanzas & Productividad',
        'Viajes & Aventuras',
        'Arte & Cultura',
    ];

    public function create()
    {
        return view('publicaciones.crear');
    }

    public function continue(Request $request)
    {
        $validated = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'subtitulo' => ['nullable', 'string', 'max:150'],
            'contenido' => ['required', 'string'],
        ]);

        Session::put('publicacion_titulo', $validated['titulo']);
        Session::put('publicacion_subtitulo', $validated['subtitulo'] ?? null);
        Session::put('publicacion_contenido', $validated['contenido']);

        return redirect()->route('publicaciones.opciones');
    }

    public function opciones(Request $request)
    {
        $titulo = Session::get('publicacion_titulo');
        $subtitulo = Session::get('publicacion_subtitulo');
        $contenido = Session::get('publicacion_contenido');

        if (!$titulo || !$contenido) {
            return redirect()->route('publicaciones.crear');
        }

        return view('publicaciones.opciones', [
            'titulo' => $titulo,
            'subtitulo' => $subtitulo,
            'contenido' => $contenido,
            'categorias' => $this->categorias,
        ]);
    }

    public function store(Request $request)
    {
        $titulo = Session::get('publicacion_titulo');
        $subtitulo = Session::get('publicacion_subtitulo');
        $contenido = Session::get('publicacion_contenido');

        if (!$titulo || !$contenido) {
            return redirect()->route('publicaciones.crear');
        }

        $validated = $request->validate([
            'categoria' => ['required', 'in:' . implode(',', $this->categorias)],
        ]);

        $publicacion = new Publicacion([
            'titulo' => $titulo,
            'subtitulo' => $subtitulo,
            'contenido' => $contenido,
            'fecha_subida' => now(),
            'usuario_id' => Auth::id(),
            'categoria' => $validated['categoria'],
        ]);
        $publicacion->save();

        Session::forget(['publicacion_titulo', 'publicacion_subtitulo', 'publicacion_contenido']);

        return redirect()->route('profile')->with('success', '¡Publicación creada!');
    }

    public function show(Publicacion $publicacion)
    {
        return view('publicaciones.show', ['publicacion' => $publicacion]);
    }

    public function destroy(Publicacion $publicacion)
    {
        if (Auth::id() !== $publicacion->usuario_id) {
            abort(403, 'Unauthorized');
        }

        $publicacion->delete();
        return redirect()->route('profile')->with('success', 'Publicación eliminada correctamente.');
    }

    public function guardar(Publicacion $publicacion)
    {
        return redirect()->back()->with('success', 'Publicación guardada (próximamente).');
    }
}
