<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $viewer = Auth::user();
        $query = trim($request->input('q', ''));
        $tab = $request->input('tab', 'publicaciones');

        $publicaciones = Publicacion::with('usuario')
            ->visiblesPara($viewer)
            ->when($query, function ($qBuilder) use ($query) {
                $qBuilder->where(function ($nested) use ($query) {
                    $nested->where('titulo', 'like', "%{$query}%")
                        ->orWhere('subtitulo', 'like', "%{$query}%");
                });
            })
            ->orderByDesc('fecha_subida')
            ->limit(30)
            ->get();

        $usuarios = Usuario::query()
            ->when($query, function ($qBuilder) use ($query) {
                $qBuilder->where('nombre', 'like', "%{$query}%");
            })
            ->limit(30)
            ->get();

        // Guardar búsquedas recientes en sesión (máx 5)
        if ($query) {
            $history = session()->get('search_history', []);
            $history = array_values(array_unique(array_merge([$query], $history)));
            $history = array_slice($history, 0, 5);
            session(['search_history' => $history]);
        }

        $history = session('search_history', []);

        $seguimientos = $viewer->seguidos
            ->keyBy('id')
            ->map(fn ($u) => $u->pivot->estado);

        return view('search.index', [
            'query' => $query,
            'tab' => $tab,
            'publicaciones' => $publicaciones,
            'usuarios' => $usuarios,
            'seguimientos' => $seguimientos,
            'history' => $history,
        ]);
    }
}
