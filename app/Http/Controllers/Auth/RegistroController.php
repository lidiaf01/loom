<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['nombre' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'username' => 'El nombre de usuario o la clave no son correctos.',
        ]);
    }

    public function showRegistro1()
    {
        return view('auth.registro_1');
    }

    public function storePaso1(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'fecha_nac' => 'required|date',
        ]);

        Session::put('registro_temp', $data); // Guardar datos del paso 1
        return redirect()->route('registro.2');
    }

    public function showRegistro2()
    {
        if (!Session::has('registro_temp')) {
            return redirect()->route('registro.1');
        }

        return view('auth.registro_2');
    }

    public function finalizarRegistro(Request $request)
    {
        $request->validate([
            'contrasenha' => 'required|confirmed|min:6',
        ]);

        $datos = Session::get('registro_temp');

        try {
            Usuario::create([
                'nombre'      => $datos['nombre'],
                'email'       => $datos['email'],
                'fecha_nac'   => $datos['fecha_nac'],
                'contrasenha' => Hash::make($request->contrasenha),
            ]);

            Session::forget('registro_temp');
            return redirect()->route('registro.exito');
        } catch (\Exception $e) {
            return redirect()->route('registro.fallo');
        }
    }
}