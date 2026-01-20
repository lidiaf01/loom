@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 flex justify-center items-center">
    <div class="w-96 h-[780px] relative overflow-hidden scrollbar-hide">
        
        {{-- Círculos Decorativos de Fondo (5 círculos dentro del contenedor) --}}
        <div class="w-16 h-16 left-[210px] top-[110px] absolute opacity-40 bg-cyan-200 rounded-full blob-float"></div>
        <div class="w-28 h-28 left-[-35px] top-[10px] absolute opacity-40 bg-orange-200 rounded-full blob-float-3"></div>
        <div class="w-28 h-28 left-[275px] top-[560px] absolute opacity-40 bg-emerald-200 rounded-full blob-float"></div>
        <div class="w-56 h-56 left-[-20px] top-[640px] absolute opacity-40 bg-lime-100 rounded-full blob-float-2"></div>
        <div class="w-16 h-16 left-[-20px] top-[470px] absolute opacity-40 bg-fuchsia-300 rounded-full blob-float-2"></div>
    
        <div class="relative z-10 px-6 py-8">
        
        {{-- Encabezado --}}
        <div class="mb-8 mt-8">
            <h1 class="text-stone-700 text-4xl font-bold font-['Poppins']">Inspiración rápida</h1>
            <p class="text-stone-700/80 text-2xl font-normal font-['Poppins'] mt-4">Descubre una publicación al azar en segundos.</p>
        </div>

        {{-- Tarjetas de Propósito --}}
        <div class="space-y-4 mb-6">
            
            {{-- Salud & Bienestar --}}
            <div class="bg-pink-200 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-pink-300 hover:shadow-lg transition-all cursor-pointer flex items-center gap-4">
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Salud & Bienestar</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit']">Cuida tu cuerpo y mente</p>
                </div>
            </div>

            {{-- Ejercicio & Movimiento --}}
            <div class="bg-orange-200 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-orange-300 hover:shadow-lg transition-all cursor-pointer flex items-center gap-4">
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.57 14.86L22 13.43 20.57 12 17 15.57 8.43 7 12 3.43 10.57 2 9.14 3.43 7.71 2 5.57 4.14 4.14 2.71 2.71 4.14l1.43 1.43L2 7.71l1.43 1.43L2 10.57 3.43 12 7 8.43 15.57 17 12 20.57 13.43 22l1.43-1.43L16.29 22l2.14-2.14 1.43 1.43 1.43-1.43-1.43-1.43L22 16.29z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Ejercicio & Movimiento</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit']">Activa tu energía positiva</p>
                </div>
            </div>

            {{-- Hobbies & Creatividad --}}
            <div class="bg-emerald-100 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-emerald-300 hover:shadow-lg transition-all cursor-pointer flex items-center gap-4">
                <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22C6.49 22 2 17.51 2 12S6.49 2 12 2s10 4.04 10 9c0 3.31-2.69 6-6 6h-1.77c-.28 0-.5.22-.5.5 0 .12.05.23.13.33.41.47.64 1.06.64 1.67 0 1.38-1.12 2.5-2.5 2.5zm0-18c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7z"/><circle cx="6.5" cy="11.5" r="1.5"/><circle cx="9.5" cy="7.5" r="1.5"/><circle cx="14.5" cy="7.5" r="1.5"/><circle cx="17.5" cy="11.5" r="1.5"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Hobbies & Creatividad</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit']">Explora tu lado artístico</p>
                </div>
            </div>

        </div>

        {{-- Botones de Acción --}}
        <div class="space-y-4">

            {{-- Botón Iniciar Sesión --}}
            <a href="{{ route('login') }}" class="w-full h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-[0px_10px_15px_0px_rgba(0,0,0,0.10)] shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] flex items-center justify-center hover:opacity-90 transition-opacity">
                <span class="text-stone-700 text-base font-semibold font-['Poppins']">Iniciar Sesión</span>
            </a>

            {{-- Botón Crear Cuenta --}}
            <a href="{{ route('registro.1') }}" class="w-full h-14 bg-orange-50 border-2 border-yellow-100 rounded-2xl shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] flex items-center justify-center hover:shadow-lg transition-all">
                <span class="text-stone-700 text-base font-semibold font-['Poppins']">Crear Cuenta</span>
            </a>
        </div>

    </div>
</div>
@endsection