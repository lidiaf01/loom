@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    @php
        $isOwner = $isOwner ?? (auth()->check() && auth()->id() === $user->id);
        $estadoSeguimiento = $estadoSeguimiento ?? null;
        $solicitudes = $solicitudes ?? collect();
        $seguidores = $seguidores ?? 0;
        $seguidos = $seguidos ?? 0;
    @endphp
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
        <div class="w-full pt-4 pb-5 px-4 text-center">
            <div class="w-28 h-28 mx-auto mb-3 bg-zinc-300 rounded-full overflow-hidden border-4 border-white shadow-lg">
                @if($user->foto_perfil)
                    <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="{{ $user->nombre }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Foto de perfil" class="w-full h-full object-cover">
                @endif
            </div>
            <h1 class="text-stone-700 text-3xl font-semibold font-['Outfit'] mb-1">{{ $user->nombre }}</h1>
            <p class="text-stone-700/80 text-base font-normal font-['Outfit']">{{ $user->biografia ?? 'Biografia' }}</p>

            <div class="flex items-center justify-center gap-10 mt-2 text-stone-700 text-sm font-['Outfit']">
                <a href="{{ route('usuarios.seguidores', $user) }}" class="flex flex-col items-center hover:-translate-y-0.5 transition-all">
                    <span class="text-lg font-semibold">{{ $seguidores }}</span>
                    <span class="text-stone-600/70">Seguidores</span>
                </a>
                <a href="{{ route('usuarios.seguidores', $user) }}" class="flex flex-col items-center hover:-translate-y-0.5 transition-all">
                    <span class="text-lg font-semibold">{{ $seguidos }}</span>
                    <span class="text-stone-600/70">Seguidos</span>
                </a>
            </div>

            @if(!$isOwner)
                <div class="mt-3 flex items-center justify-center gap-2">
                    @if($estadoSeguimiento === 'accepted')
                        <span class="px-4 py-2 rounded-full bg-emerald-200 border-2 border-emerald-300 text-stone-700 text-sm font-semibold font-['Outfit']">Siguiendo</span>
                        <form method="POST" action="{{ route('usuarios.dejar', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 rounded-full bg-stone-200 border border-stone-300 text-stone-700 text-sm font-['Outfit'] hover:bg-stone-300 transition-all">Dejar de seguir</button>
                        </form>
                    @elseif($estadoSeguimiento === 'pending')
                        <span class="px-4 py-2 rounded-full bg-amber-200 border-2 border-amber-300 text-stone-700 text-sm font-semibold font-['Outfit']">Solicitado</span>
                    @else
                        <form method="POST" action="{{ route('usuarios.seguir', $user) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-full bg-yellow-100 border-2 border-amber-300 text-stone-700 text-sm font-semibold font-['Outfit'] hover:-translate-y-0.5 hover:shadow transition-all">
                                {{ $user->perfil_privado ? 'Solicitar seguir' : 'Seguir' }}
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>

        @if($isOwner && $solicitudes->count())
            <div class="w-full px-4 mb-4">
                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-stone-700 text-base font-semibold font-['Outfit']">Solicitudes</span>
                        <span class="text-xs px-3 py-1 bg-amber-200 border border-amber-300 rounded-full text-stone-700 font-['Outfit']">{{ $solicitudes->count() }}</span>
                    </div>
                    <div class="space-y-2">
                        @foreach($solicitudes as $solicitud)
                            <div class="flex items-center justify-between bg-stone-100 rounded-2xl px-3 py-2 border border-stone-200">
                                <div>
                                    <p class="text-stone-700 text-sm font-semibold font-['Outfit']">{{ $solicitud->nombre }}</p>
                                    <p class="text-stone-600/70 text-xs font-['Outfit']">Quiere seguirte</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('usuarios.rechazar', $solicitud) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-stone-200 text-stone-700 text-xs font-['Outfit'] border border-stone-300 hover:bg-stone-300 transition-all">Rechazar</button>
                                    </form>
                                    <form method="POST" action="{{ route('usuarios.aceptar', $solicitud) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-emerald-200 text-stone-700 text-xs font-['Outfit'] border border-emerald-300 hover:bg-emerald-300 transition-all">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        {{-- Sección Diario y Biblioteca estilo home --}}
        <div class="w-full px-4 mt-8">
            <div class="grid grid-cols-2 gap-4">
                <a href="#diario" class="bg-emerald-100 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-emerald-300 hover:shadow-emerald-400/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.3-1.54c-.3-.36-.77-.36-1.07 0-.3.36-.3.92 0 1.28l1.83 2.17c.3.36.77.36 1.07 0 .3-.36 2.21-2.88 2.21-2.88.3-.36.3-.92 0-1.28-.3-.36-.77-.36-1.07 0z"/></svg>
                    </div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Diario</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit'] mt-1">Escribe tus pensamientos</p>
                </a>

                <a href="#biblioteca" class="bg-pink-300 rounded-3xl p-5 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-pink-400 hover:shadow-pink-400/50 hover:scale-105 hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-2-7h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                    </div>
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit']">Biblioteca</h3>
                    <p class="text-stone-600/60 text-xs font-normal font-['Outfit'] mt-1">Contenido guardado</p>
                </a>
            </div>
        </div>

        {{-- Sección de Publicaciones --}}
        <div class="w-full px-4 mt-6">
            <div class="w-full bg-pink-300 rounded-[20px] border-2 border-pink-400 py-3 px-4 mb-4 text-center">
                <h2 class="text-stone-700/80 text-xl font-normal font-['Outfit']">Revisa las publicaciones</h2>
            </div>

            @if(!$isOwner && $user->perfil_privado && $estadoSeguimiento !== 'accepted')
                <div class="w-full text-center pb-4">
                    <p class="text-stone-700 text-base font-semibold font-['Outfit'] flex items-center justify-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-stone-200 border border-stone-300">
                            <svg class="w-4 h-4 text-stone-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17a2 2 0 100-4 2 2 0 000 4zm6-7h-1V7a5 5 0 10-10 0v3H6a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2v-7a2 2 0 00-2-2zm-7-3a3 3 0 016 0v3H11V7zm7 12H6v-7h12v7z"/></svg>
                        </span>
                        Perfil privado. Solicita seguir para ver contenido público.
                    </p>
                </div>
            @elseif($publicaciones->count() > 0)
                <div class="space-y-3 pb-4">
                    @foreach($publicaciones as $publicacion)
                        @php $colors = $publicacion->getColorClasses(); @endphp
                        <a href="{{ route('publicaciones.show', $publicacion) }}" class="block w-full {{ $colors['bg'] }} rounded-[20px] border-2 {{ $colors['border'] }} p-4 hover:shadow-stone-400/40 hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                            <div class="flex flex-col h-16 justify-center">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-stone-700/80 text-lg font-semibold font-['Outfit'] truncate">{{ $publicacion->titulo }}</h3>
                                    @if($publicacion->visibilidad === 'privada')
                                        <span class="text-xs px-2 py-1 rounded-full bg-stone-200 border border-stone-300 text-stone-700 font-['Outfit']">Privada</span>
                                    @endif
                                </div>
                                @if(!empty($publicacion->subtitulo))
                                    <p class="text-stone-700/70 text-sm font-normal font-['Outfit'] mt-0.5 truncate">{{ $publicacion->subtitulo }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="w-full text-center pb-4">
                    <p class="text-stone-600/50 text-base font-normal font-['Outfit']">Aún no hay publicaciones visibles</p>
                    <p class="text-stone-600/40 text-sm font-normal font-['Outfit']">Cuando se acepten solicitudes o sean públicas, aparecerán aquí.</p>
                </div>
            @endif

        </div>
        </div>

        @include('layouts.navbar')

    </div>
</div>
@endsection
