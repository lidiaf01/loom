@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-sm h-[800px] bg-orange-50 rounded-[3rem] shadow-2xl relative overflow-hidden flex flex-col p-8 border border-yellow-100">
        
        {{-- Blobs Decorativos de Fondo --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-100 rounded-full opacity-60 blob-float"></div>
        <div class="absolute top-40 -left-10 w-32 h-32 bg-emerald-100 rounded-full opacity-50 blob-float-2"></div>
        <div class="absolute -bottom-10 right-0 w-48 h-48 bg-pink-100 rounded-full opacity-60 blob-float-3"></div>
        <!-- Extras para más dinamismo -->
        <div class="absolute left-[20px] top-[120px] w-16 h-16 bg-sky-200 rounded-full opacity-40 blob-float-2"></div>
        <div class="absolute left-1/2 -translate-x-1/2 top-[220px] w-24 h-24 bg-yellow-100 rounded-full opacity-40 blob-float"></div>
        <div class="absolute -left-6 bottom-[160px] w-24 h-24 bg-purple-200 rounded-full opacity-40 blob-float-3"></div>
        <div class="absolute -right-5 bottom-[80px] w-16 h-16 bg-emerald-200 rounded-full opacity-50 blob-float"></div>
        <div class="absolute right-[40px] top-[160px] w-12 h-12 bg-pink-200 rounded-full opacity-60 blob-float-2"></div>

        {{-- Logo y Encabezado --}}
        <div class="relative z-10 flex flex-col items-center mt-10 mb-12">
            <div class="w-20 h-20 bg-gradient-to-br from-yellow-100 to-pink-300 rounded-3xl shadow-lg flex items-center justify-center mb-6 transform hover:rotate-6 transition-transform">
                {{-- Icono representativo (un pequeño cuadrado/logo) --}}
                <div class="w-8 h-8 bg-stone-700/20 rounded-lg"></div>
            </div>
            <h1 class="text-stone-700 text-5xl font-bold font-['Poppins'] tracking-tight">Loom</h1>
            <p class="text-stone-700/60 text-lg font-medium font-['Poppins'] mt-2">¿Qué propósito tienes hoy?</p>
        </div>

        {{-- Lista de Categorías (Tarjetas) --}}
        <div class="relative z-10 space-y-4 mb-auto">
            
            {{-- Salud & Bienestar --}}
            <div class="group flex items-center bg-orange-50/80 p-4 rounded-2xl shadow-sm border border-yellow-100 hover:bg-orange-50/90 transition-all cursor-pointer hover:scale-[1.02]">
                <div class="w-12 h-12 bg-pink-300 rounded-xl flex items-center justify-center shadow-inner group-hover:rotate-3 transition-transform">
                    <div class="w-5 h-5 bg-stone-700 opacity-80 rounded-sm"></div>
                </div>
                <div class="ml-4">
                    <h3 class="text-stone-700 text-base font-semibold font-['Poppins']">Salud & Bienestar</h3>
                    <p class="text-stone-500 text-xs font-normal font-['Poppins']">Cuida tu cuerpo y mente</p>
                </div>
            </div>

            {{-- Ejercicio --}}
            <div class="group flex items-center bg-orange-50/80 p-4 rounded-2xl shadow-sm border border-yellow-100 hover:bg-orange-50/90 transition-all cursor-pointer hover:scale-[1.02]">
                <div class="w-12 h-12 bg-orange-200 rounded-xl flex items-center justify-center shadow-inner group-hover:-rotate-3 transition-transform">
                    <div class="w-6 h-4 bg-stone-700 opacity-80 rounded-sm"></div>
                </div>
                <div class="ml-4">
                    <h3 class="text-stone-700 text-base font-semibold font-['Poppins']">Ejercicio & Movimiento</h3>
                    <p class="text-stone-500 text-xs font-normal font-['Poppins']">Activa tu energía positiva</p>
                </div>
            </div>

            {{-- Hobbies --}}
            <div class="group flex items-center bg-orange-50/80 p-4 rounded-2xl shadow-sm border border-yellow-100 hover:bg-orange-50/90 transition-all cursor-pointer hover:scale-[1.02]">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center shadow-inner group-hover:rotate-3 transition-transform">
                    <div class="w-5 h-5 bg-stone-700 opacity-80 rounded-sm"></div>
                </div>
                <div class="ml-4">
                    <h3 class="text-stone-700 text-base font-semibold font-['Poppins']">Hobbies & Creatividad</h3>
                    <p class="text-stone-500 text-xs font-normal font-['Poppins']">Explora tu lado artístico</p>
                </div>
            </div>

        </div>

        {{-- Botones de Acción --}}
        <div class="relative z-10 space-y-4 mb-6">
            <a href="{{ route('login') }}" 
               class="w-full h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center text-stone-700 text-base font-semibold font-['Poppins'] hover:opacity-90 transition-opacity active:scale-95">
                Iniciar Sesión
            </a>
            
                <a href="{{ route('registro.1') }}" 
                    class="w-full h-14 bg-orange-50/80 border-2 border-yellow-100 rounded-2xl shadow-sm flex items-center justify-center text-stone-700 text-base font-semibold font-['Poppins'] hover:bg-orange-50/90 transition-colors active:scale-95">
                Crear Cuenta
            </a>
        </div>
    </div>
</div>
@endsection