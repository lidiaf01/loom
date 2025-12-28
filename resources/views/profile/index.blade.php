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
        
        {{-- Encabezado: Foto, Nombre, Bio --}}
        <div class="w-full pt-4 pb-2 px-4 text-center">
            <div class="w-28 h-28 mx-auto mb-3 bg-zinc-300 rounded-full overflow-hidden border-4 border-white shadow-lg">
                @if($user->foto_perfil)
                    <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="{{ $user->nombre }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Foto de perfil" class="w-full h-full object-cover">
                @endif
            </div>
            <h1 class="text-stone-700 text-3xl font-semibold font-['Outfit'] mb-1">{{ $user->nombre }}</h1>
            <p class="text-stone-700/80 text-base font-normal font-['Outfit']">{{ $user->biografia ?? 'Biografia' }}</p>
        </div>

        {{-- Sección decorativa: Diario y Biblioteca --}}
        <div class="w-full h-72 relative px-4 flex items-center justify-center overflow-hidden">
            
            {{-- Carpeta Diario izquierda --}}
            <div class="absolute left-0 top-1/2 -translate-y-1/2 rotate-12">
                <div class="w-40 h-52 bg-emerald-300 rounded-[15px] border-2 border-emerald-400 flex items-center justify-center shadow-md hover:shadow-emerald-400/30 transition-all duration-300 hover:-translate-y-2 cursor-pointer"
                     style="transform: perspective(1000px) rotateX(5deg) rotateY(15deg) rotateZ(12deg); box-shadow: 0 8px 15px rgba(0,0,0,0.1);">
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-20 h-12 bg-white/70 rounded-lg"></div>
                        <span class="text-emerald-800 font-semibold font-['Outfit']">diario</span>
                    </div>
                </div>
            </div>

            {{-- Libro Biblioteca derecha --}}
            <div class="absolute right-0 top-1/2 -translate-y-1/2 -rotate-6">
                <div class="w-40 h-52 bg-yellow-200 rounded-[15px] border-2 border-amber-300 flex items-center justify-center shadow-md hover:shadow-yellow-400/30 transition-all duration-300 hover:-translate-y-2 cursor-pointer"
                     style="transform: perspective(1000px) rotateX(8deg) rotateY(-20deg) rotateZ(-6deg); box-shadow: 0 8px 15px rgba(0,0,0,0.1);">
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-32 h-2 bg-amber-400 rounded-full"></div>
                        <span class="text-amber-800 font-semibold font-['Outfit'] text-center px-2">Biblioteca</span>
                        <div class="w-32 h-2 bg-amber-400 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección de Publicaciones --}}
        <div class="w-full px-4 mt-2">
            
            {{-- Header Rosa --}}
            <div class="w-full bg-pink-300 rounded-[20px] border-2 border-pink-400 py-3 px-4 mb-4 text-center">
                <h2 class="text-stone-700/80 text-xl font-normal font-['Outfit']">Revisa las publicaciones</h2>
            </div>

            {{-- Publicaciones o Mensaje Vacío --}}
            @if($publicaciones->count() > 0)
                <div class="space-y-3 pb-4">
                    @foreach($publicaciones as $publicacion)
                        <div class="w-full bg-blue-300 rounded-[20px] border-2 border-blue-400 p-4">
                            <h3 class="text-stone-700/80 text-lg font-semibold font-['Outfit'] mb-1">{{ $publicacion->titulo }}</h3>
                            @if($publicacion->contenido)
                                <p class="text-stone-700/70 text-sm font-normal font-['Outfit']">{{ Str::limit($publicacion->contenido, 80) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full text-center pb-4">
                    <p class="text-stone-600/50 text-base font-normal font-['Outfit']">Aún no tienes publicaciones</p>
                    <p class="text-stone-600/40 text-sm font-normal font-['Outfit']">¡Comienza compartiendo tus hábitos!</p>
                </div>
            @endif

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
