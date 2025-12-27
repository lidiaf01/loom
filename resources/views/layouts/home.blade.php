@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 pb-32 relative overflow-hidden w-full flex justify-center" id="app-container">
    
    {{-- Blobs Decorativos de Fondo --}}
    <div class="absolute -top-20 -right-20 w-52 h-52 bg-yellow-100 rounded-full opacity-40 blob-float"></div>
    <div class="absolute top-1/3 -left-20 w-40 h-40 bg-emerald-100 rounded-full opacity-30 blob-float-2"></div>
    <div class="absolute -bottom-20 right-1/4 w-60 h-60 bg-pink-100 rounded-full opacity-35 blob-float-3"></div>
    <div class="absolute left-1/4 top-1/4 w-32 h-32 bg-blue-100 rounded-full opacity-25 blob-float-2"></div>

    {{-- Contenedor de Contenido Dinámico --}}
    <div id="content-wrapper" class="w-full transition-opacity duration-300 ease-in-out opacity-100">
        <div id="home-content" class="max-w-md mx-auto px-5 pt-12 relative z-10">
        
        {{-- Encabezado --}}
        <div class="flex items-start justify-between mb-10">
            <div>
                <h1 class="text-stone-600 text-2xl font-normal font-['Outfit']">Hola, {{ auth()->user()->nombre }}</h1>
                <p class="text-stone-600/70 text-sm font-normal font-['Outfit'] mt-1">Tu espacio de crecimiento</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-pink-300 to-purple-200 rounded-full shadow-md flex-shrink-0"></div>
        </div>

        {{-- Sección Herramientas --}}
        <div>
            <h2 class="text-stone-600/60 text-sm font-normal font-['Outfit'] mb-4 tracking-tight">Herramientas</h2>
            
            {{-- Card Grande - Crear --}}
            <a href="#crear" class="block w-full bg-yellow-100 rounded-3xl p-6 mb-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-amber-300 hover:shadow-yellow-300/40 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Crear</h3>
                        <p class="text-stone-600/60 text-xs font-normal font-['Outfit']">Comparte tus hábitos</p>
                    </div>
                </div>
            </a>

            {{-- Grid 2 columnas --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                
                {{-- Diario --}}
                <a href="#diario" class="bg-emerald-100 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-emerald-300 hover:shadow-emerald-400/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.3-1.54c-.3-.36-.77-.36-1.07 0-.3.36-.3.92 0 1.28l1.83 2.17c.3.36.77.36 1.07 0 .3-.36 2.21-2.88 2.21-2.88.3-.36.3-.92 0-1.28-.3-.36-.77-.36-1.07 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Diario</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit'] mt-1">Escribe tus pensamientos</p>
                </a>

                {{-- Últimas Lecturas --}}
                <a href="#lecturas" class="bg-sky-200 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-blue-300 hover:shadow-sky-400/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 9.5c0 .83-.67 1.5-1.5 1.5S11 13.33 11 12.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Últimas lecturas</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit'] mt-1">Revisa tus aprendizajes anteriores</p>
                </a>

            </div>

            {{-- Grid 2 columnas - Fila 2 --}}
            <div class="grid grid-cols-2 gap-4">
                
                {{-- Biblioteca --}}
                <a href="#biblioteca" class="bg-pink-300 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-pink-400 hover:shadow-pink-400/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-2-7h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
                        </svg>
                    </div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Biblioteca</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit'] mt-1">Contenido Guardado</p>
                </a>

                {{-- Explorar --}}
                <a href="#explorar" class="bg-red-300 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] shadow-[0px_2px_4px_0px_rgba(0,0,0,0.10)] border border-red-400 hover:shadow-red-400/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Explorar</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit'] mt-1">Por si no sabes por donde empezar</p>
                </a>

            </div>
        </div>
        </div>
    </div>
    {{-- Fin de Contenedor de Contenido Dinámico --}}

    {{-- Bottom Navigation --}}
    <div class="fixed bottom-0 left-0 right-0 bg-white rounded-t-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.25)] max-w-md mx-auto z-20">
        <div class="px-4 py-4 flex justify-around">
            
            {{-- Principal --}}
            <a href="{{ route('home') }}" data-route="home" class="nav-link flex flex-col items-center gap-2 transition-all duration-300">
                <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                </div>
                <span class="text-stone-600 text-xs font-normal font-['Outfit']">Principal</span>
            </a>

            {{-- Buscar --}}
            <a href="#" data-route="search" class="nav-link flex flex-col items-center gap-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/>
                    </svg>
                </div>
                <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Buscar</span>
            </a>

            {{-- Ajustes --}}
            <a href="#" data-route="settings" class="nav-link flex flex-col items-center gap-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.64l-1.92-3.32c-.12-.22-.39-.3-.61-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.23-.09-.49 0-.61.22L2.74 8.87c-.12.22-.07.49.12.64l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.64l1.92 3.32c.12.22.39.3.61.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.23.09.49 0 .61-.22l1.92-3.32c.12-.22.07-.49-.12-.64l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                    </svg>
                </div>
                <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Ajustes</span>
            </a>

            {{-- Perfil --}}
            <a href="{{ route('profile') }}" data-route="profile" class="nav-link flex flex-col items-center gap-2 transition-all duration-300">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Perfil</span>
            </a>

        </div>
    </div>
</div>
@endsection
