@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-96 relative bg-transparent overflow-hidden scrollbar-hide flex flex-col items-center">
        {{-- Elementos decorativos de fondo --}}
        <div class="w-16 h-16 left-[220px] top-[90px] absolute opacity-40 bg-sky-200 rounded-full blob-float"></div>
        <div class="w-28 h-28 left-[-35px] top-[22px] absolute opacity-40 bg-rose-200 rounded-full blob-float-2"></div>
        <div class="w-28 h-28 left-[285px] top-[585px] absolute opacity-40 bg-teal-100 rounded-full blob-float-3"></div>
        <div class="w-56 h-56 left-[-20px] top-[635px] absolute opacity-40 bg-amber-100 rounded-full blob-float-2"></div>
        <div class="w-16 h-16 left-[-20px] top-[475px] absolute opacity-40 bg-indigo-300 rounded-full blob-float"></div>

        {{-- Encabezado --}}
        <div class="w-80 mt-8 mb-4 z-10">
            <h1 class="text-stone-700 text-4xl font-bold font-['Poppins'] leading-tight">Loom</h1>
            <h2 class="text-stone-700/80 text-3xl font-normal font-['Poppins'] mt-2 leading-tight">Crea tu contraseña</h2>
        </div>

        {{-- Formulario de Contraseña --}}
        <form
            method="POST"
            action="{{ route('registro.finalizar') }}"
            class="flex flex-col items-center w-full z-10"
        >
            @csrf
            <div class="w-80 bg-orange-50 rounded-2xl shadow-lg border border-yellow-100 p-7 mb-8">
                <div class="mb-8">
                    <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Clave</label>
                    <input
                        type="password"
                        name="contrasenha"
                        required
                        minlength="6"
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4"
                    >
                </div>
                <div class="mb-8">
                    <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Confirmar Clave</label>
                    <input
                        type="password"
                        name="contrasenha_confirmation"
                        required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[inset_0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4"
                    >
                </div>
            </div>
            <button
                type="submit"
                class="w-80 h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center hover:opacity-90 transition-opacity mb-4"
            >
                <span class="text-stone-700 text-base font-semibold font-['Poppins']">Continuar</span>
            </button>
        </form>
    </div>
</div>
@endsection