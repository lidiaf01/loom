<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diario;
use Illuminate\Support\Facades\Auth;

class DiarioController extends Controller
{
    // Listar entradas del diario del usuario autenticado (paginado)
    public function index(Request $request)
    {
        $user = Auth::user();
        $page = $request->input('page', 1);
        $perPage = 10;
        $diario = Diario::where('usuario_id', $user->id)
            ->orderBy('fecha_entrada', 'asc')
            ->paginate($perPage, ['*'], 'page', $page);
        return view('diario.index', compact('diario', 'user'));
    }

    // Guardar nueva entrada
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'estado_animo' => 'nullable|string|max:50',
        ]);
        $user = Auth::user();
        Diario::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'estado_animo' => $request->estado_animo,
            'fecha_entrada' => now(),
            'usuario_id' => $user->id,
        ]);
        return redirect()->route('diario.index')->with('success', 'Entrada añadida');
    }

    // Eliminar entrada (solo si es del usuario)
    public function destroy($id)
    {
        $user = Auth::user();
        $entrada = Diario::where('id_entrada', $id)->where('usuario_id', $user->id)->firstOrFail();
        $entrada->delete();
        return redirect()->route('diario.index')->with('success', 'Entrada eliminada');
    }

    // Ver diario de otro usuario (si es público)
    public function showUser($usuario_id, Request $request)
    {
        $user = Auth::user();
        $owner = \App\Models\Usuario::findOrFail($usuario_id);
        if ($owner->diario_privado && (!$user || $user->id !== $owner->id)) {
            return redirect()->route('usuarios.show', ['usuario' => $owner->id])->with('error', 'Diario privado');
        }
        $page = $request->input('page', 1);
        $perPage = 10;
        $diario = Diario::where('usuario_id', $owner->id)
            ->orderBy('fecha_entrada', 'asc')
            ->paginate($perPage, ['*'], 'page', $page);
        return view('diario.show', compact('diario', 'owner'));
    }

    // Cambiar privacidad del diario
    public function setPrivacidad(Request $request)
    {
        $user = Auth::user();
        // Visibilidad de cuenta
        if ($request->has('visibilidad')) {
            $user->visibilidad = $request->input('visibilidad');
        }
        // Privacidad del diario
        $user->diario_privado = $request->has('diario_privado');
        $user->save();
        return back()->with('success', 'Privacidad actualizada');
    }

    // Lectura completa de una entrada de diario
    public function lectura($id)
    {
        $user = Auth::user();
        $entrada = Diario::where('id_entrada', $id)
            ->where('usuario_id', $user->id)
            ->firstOrFail();
        return view('diario.lectura', compact('entrada'));
    }
}
