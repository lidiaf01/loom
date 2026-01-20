<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;

class AjustesController extends Controller
{
    // Cambiar cuenta: cerrar sesión y redirigir a login
    public function cambiarCuenta(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Cambiar contraseña: validar actual, luego nueva
    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'actual' => 'required',
            'nueva' => 'required|confirmed|min:6',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->actual, $user->contrasenha)) {
            return back()->withErrors(['actual' => 'La contraseña actual no es correcta.']);
        }
        $user->contrasenha = Hash::make($request->nueva);
        $user->save();
        return back()->with('success', 'Contraseña cambiada correctamente.');
    }

    // Eliminar cuenta y datos relacionados
    public function eliminarCuenta(Request $request)
    {
        $user = Auth::user();
        // Eliminar publicaciones, etc. (implementar según relaciones)
        $user->publicaciones()->delete();
        // Eliminar usuario
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('inicio');
    }

    // Personalizar perfil: nombre, email, foto, bio
    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nombre' => 'required|unique:usuarios,nombre,' . $user->id,
            'email' => 'required|email|unique:usuarios,email,' . $user->id,
            'biografia' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        if ($request->filled('biografia')) {
            $user->biografia = $request->biografia;
        }
        if ($request->hasFile('foto')) {
            $user->foto_perfil = $request->file('foto')->store('perfiles', 'public');
        }
        $user->save();
        return back()->with('success', 'Perfil actualizado.');
    }

    // Cambiar visibilidad
    public function cambiarVisibilidad(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'visibilidad' => 'required|in:publica,privada',
        ]);
        $user->visibilidad = $request->visibilidad;
        $user->save();
        return back()->with('success', 'Visibilidad actualizada.');
    }
}
