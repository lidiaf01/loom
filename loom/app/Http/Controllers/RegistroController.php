<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function showRegistro1()
    {
        return view('auth.registro_1');
    }

    public function storePaso1(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'fecha_nac' => 'required|date',
        ]);

        // Guardar datos en sesión temporalmente
        session([
            'registro.nombre' => $request->nombre,
            'registro.email' => $request->email,
            'registro.fecha_nac' => $request->fecha_nac,
        ]);

        return redirect()->route('registro.2');
    }

    public function showRegistro2()
    {
        return view('auth.registro_2');
    }

    public function finalizarRegistro(Request $request)
    {
        // Validación de contraseña
        $request->validate([
            'contrasenha' => 'required|string|min:6|confirmed',
        ]);

        $usuario = new Usuario();
        $usuario->nombre = session('registro.nombre');
        $usuario->email = session('registro.email');
        $usuario->fecha_nac = session('registro.fecha_nac');
        $usuario->contrasenha = bcrypt($request->contrasenha);
        $usuario->save();

        Auth::login($usuario);
        session()->forget(['registro.nombre', 'registro.email', 'registro.fecha_nac']);

        return redirect()->route('registro.exito');
    }
}
