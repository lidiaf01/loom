@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-96 relative bg-transparent overflow-hidden scrollbar-hide flex flex-col items-center">
        {{-- Elementos decorativos de fondo --}}
        <div class="w-16 h-16 left-[210px] top-[110px] absolute opacity-40 bg-cyan-200 rounded-full blob-float"></div>
        <div class="w-28 h-28 left-[-35px] top-[10px] absolute opacity-40 bg-orange-200 rounded-full blob-float-3"></div>
        <div class="w-28 h-28 left-[275px] top-[560px] absolute opacity-40 bg-emerald-200 rounded-full blob-float"></div>
        <div class="w-56 h-56 left-[-20px] top-[640px] absolute opacity-40 bg-lime-100 rounded-full blob-float-2"></div>
        <div class="w-16 h-16 left-[-20px] top-[470px] absolute opacity-40 bg-fuchsia-300 rounded-full blob-float-2"></div>

        {{-- Encabezado --}}
        <div class="w-80 mt-8 mb-4 z-10">
            <h1 class="text-stone-700 text-4xl font-bold font-['Poppins'] leading-tight">Loom</h1>
            <h2 class="text-stone-700/80 text-3xl font-normal font-['Poppins'] mt-2 leading-tight">Comienza tu experiencia</h2>
        </div>

        {{-- Formulario de Registro --}}
        <form
            method="POST"
            action="{{ route('registro.1') }}"
            class="flex flex-col items-center w-full z-10"
        >
            @csrf
            <div class="w-80 bg-orange-50 rounded-2xl shadow-lg border border-yellow-100 p-7 mb-8">
                <div class="mb-8">
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Nombre de Usuario</label>
                    <input
                        name="nombre"
                        value="{{ old('nombre') }}"
                        required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4"
                    >
                </div>
                <div class="mb-8">
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Correo electrónico</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[inset_0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4"
                    >
                </div>
                <div class="mb-8">
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Fecha de nacimiento</label>
                    <input
                        type="date"
                        name="fecha_nac"
                        value="{{ old('fecha_nac') }}"
                        required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4"
                    >
                </div>
            </div>
            <button
                type="submit"
                class="w-80 h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center hover:opacity-90 transition-opacity mb-4"
            >
                <span class="text-stone-700 text-base font-semibold font-['Poppins']">Continuar</span>
            </button>
            <div class="w-80 text-center mt-6">
                <span class="text-stone-600/70 text-sm">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="font-bold text-stone-700 hover:underline">Inicia sesión aquí</a></span>
            </div>
        </form>
    </div>
</div>
</div>
@endsection