@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    
    {{-- Contenedor centrado móvil --}}
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">
        
        {{-- Círculos decorativos animados --}}
        <div class="absolute w-52 h-52 bg-amber-200 rounded-full opacity-40 blur-3xl blob-float" style="top: 120px; left: 250px;"></div>
        <div class="absolute w-44 h-44 bg-pink-200 rounded-full opacity-35 blur-2xl blob-float-2" style="top: 300px; left: -30px;"></div>
        <div class="absolute w-48 h-48 bg-teal-200 rounded-full opacity-30 blur-3xl blob-float-3" style="top: 500px; left: 280px;"></div>
        <div class="absolute w-40 h-40 bg-indigo-100 rounded-full opacity-25 blur-2xl blob-float" style="top: 700px; left: -15px;"></div>
        <div class="absolute w-36 h-36 bg-lime-200 rounded-full opacity-30 blur-2xl blob-float-2" style="top: 280px; left: 320px;"></div>

        {{-- Contenido principal --}}
        <div class="relative z-10">
            
            {{-- Encabezado --}}
            <div class="w-full pt-6 pb-4 px-4">
                <h1 class="text-stone-700 text-3xl font-semibold font-['Outfit']">{{ $publicacion->titulo }}</h1>
                @if(!empty($publicacion->subtitulo))
                    <p class="text-stone-700/70 text-base font-normal font-['Outfit'] mt-2">{{ $publicacion->subtitulo }}</p>
                @endif
                @if(!empty($publicacion->categoria))
                    @php $colors = $publicacion->getColorClasses(); @endphp
                    <div class="inline-block px-4 py-2 {{ $colors['bg'] }} rounded-full border-2 {{ $colors['border'] }} text-stone-700 text-sm font-normal font-['Outfit'] mt-3">
                        {{ $publicacion->categoria }}
                    </div>
                @endif
                @if($publicacion->fecha_subida)
                    <p class="text-stone-600/50 text-xs font-normal font-['Outfit'] mt-1">{{ $publicacion->fecha_subida instanceof \DateTime ? $publicacion->fecha_subida->format('d M Y') : $publicacion->fecha_subida }}</p>
                @endif
            </div>

            {{-- Contenido --}}
            <div class="w-full px-4 py-4 mb-6">
                <div class="w-full bg-white rounded-[20px] border-2 border-blue-200 p-6">
                    <div class="text-stone-700 text-base font-normal font-['Outfit'] leading-relaxed prose prose-sm max-w-none break-words word-break">
                        {!! $publicacion->contenido !!}
                    </div>
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="w-full px-4 mb-6">
                <div class="flex justify-end items-center gap-3">
                    {{-- Botón Salir (Volver) --}}
                    <a href="{{ route('profile') }}" class="h-11 w-11 inline-flex items-center justify-center bg-stone-200 hover:bg-stone-300 rounded-lg border border-stone-300 text-stone-700 transition-all duration-200" aria-label="Volver al perfil">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M10 19l-7-7 7-7v4h8v6h-8v4z"/>
                        </svg>
                    </a>

                    {{-- Botón Guardar --}}
                    <form action="{{ route('publicaciones.guardar', $publicacion) }}" method="POST" class="inline-flex">
                        @csrf
                        <button type="submit" class="h-11 w-11 inline-flex items-center justify-center bg-amber-200 hover:bg-amber-300 rounded-lg border border-amber-300 text-stone-700 transition-all duration-200" aria-label="Guardar publicación">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M5 4h14v16H5V4zm2 2v12h10V6H7zm2 2h6v2H9V8zm0 4h6v2H9v-2z"/>
                            </svg>
                        </button>
                    </form>

                    {{-- Botón Eliminar (solo para el propietario) --}}
                    @if(Auth::id() === $publicacion->usuario_id)
                        <form action="{{ route('publicaciones.destroy', $publicacion) }}" method="POST" class="inline-flex" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta publicación?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="h-11 w-11 inline-flex items-center justify-center bg-red-200 hover:bg-red-300 rounded-lg border border-red-300 text-stone-700 transition-all duration-200" aria-label="Eliminar publicación">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M6 7h12v14H6V7zm2 2v10h2V9H8zm6 0v10h2V9h-2z"/>
                                    <path d="M9 4V2h6v2h5v2H4V4h5z"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

        {{-- Bottom Navigation --}}
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-96 bg-white rounded-t-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.25)] z-50">
            <div class="px-4 py-4 flex justify-around">
                
                {{-- Principal --}}
                <a href="{{ route('home') }}" data-route="home" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Principal</span>
                </a>

                {{-- Buscar --}}
                <a href="#" data-route="search" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Buscar</span>
                </a>

                {{-- Ajustes --}}
                <a href="#" data-route="settings" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.64l-1.92-3.32c-.12-.22-.39-.3-.61-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.23-.09-.49 0-.61.22L2.74 8.87c-.12.22-.07.49.12.64l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.64l1.92 3.32c.12.22.39.3.61.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.23.09.49 0 .61-.22l1.92-3.32c.12-.22.07-.49-.12-.64l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Ajustes</span>
                </a>

                {{-- Perfil --}}
                <a href="{{ route('profile') }}" data-route="profile" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600 text-xs font-normal font-['Outfit']">Perfil</span>
                </a>

            </div>
        </div>

    </div>
</div>
@endsection
