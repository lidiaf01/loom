@extends('layouts.login')

@section('content')
<div class="w-full h-full relative flex items-center justify-center">
    {{-- Círculos decorativos difuminados --}}
    <div class="w-64 h-64 left-[210px] top-[110px] absolute opacity-60 bg-cyan-200 rounded-full blur-2xl"></div>
    <div class="w-56 h-56 left-[-35px] top-[10px] absolute opacity-58 bg-orange-200 rounded-full blur-2xl"></div>
    <div class="w-56 h-56 left-[275px] top-[560px] absolute opacity-60 bg-emerald-200 rounded-full blur-2xl"></div>
    <div class="w-56 h-56 left-[-20px] top-[640px] absolute opacity-55 bg-lime-100 rounded-full blur-2xl"></div>
    <div class="w-64 h-64 left-[-20px] top-[470px] absolute opacity-58 bg-fuchsia-300 rounded-full blur-2xl"></div>

    <div class="w-80 relative z-10 flex flex-col items-center">
        {{-- Encabezado --}}
        <div class="w-full mb-6">
            <h1 class="text-stone-700 text-4xl font-bold font-['Poppins'] leading-tight">Loom</h1>
            <h2 class="text-stone-700/80 text-3xl font-normal font-['Poppins'] mt-2 leading-tight">Inicio de Sesión</h2>
        </div>

        {{-- Formulario de Login --}}
        <form method="POST" action="{{ route('login.post') }}" class="w-full">
            @csrf
            <div class="w-full bg-orange-50 rounded-2xl shadow-lg border border-yellow-100 p-7 mb-4">
                {{-- Campo: Nombre de Usuario --}}
                <div class="mb-6">
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Nombre de Usuario</label>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 focus:outline-none focus:ring-2 focus:ring-yellow-200"
                    >
                </div>

                {{-- Campo: Clave --}}
                <div>
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Clave</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[inset_0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 focus:outline-none focus:ring-2 focus:ring-yellow-200"
                    >
                </div>
            </div>

            {{-- Mensajes de error y sesión --}}
            @if(session('success'))
                <div class="mb-4 w-full">
                    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-lg text-sm">{{ session('success') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 w-full">
                    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded-lg text-sm">{{ session('error') }}</div>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 w-full">
                    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded-lg text-sm">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <button
                type="submit"
                class="w-full h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center hover:opacity-90 transition-opacity mb-4"
            >
                <span class="text-stone-700 text-base font-semibold font-['Poppins']">Continuar</span>
            </button>

            <div class="w-full text-center">
                <span class="text-stone-600/70 text-sm">¿No tienes cuenta? <a href="{{ route('registro.1') }}" class="font-bold text-stone-700 hover:underline">Regístrate aquí</a></span>
            </div>
        </form>
    </div>
</div>
@endsection
