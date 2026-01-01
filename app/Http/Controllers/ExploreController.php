<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller
{
    public function index()
    {
        $viewer = Auth::user();

        $publicaciones = Publicacion::with('usuario')
            ->withCount('guardadaPor')
            ->visiblesPara($viewer)
            ->orderByDesc('guardada_por_count')
            ->orderByDesc('fecha_subida')
            ->limit(30)
            ->get();

        return view('explorar.index', [
            'publicaciones' => $publicaciones,
        ]);
    }
}
