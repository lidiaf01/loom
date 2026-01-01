@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-24 scrollbar-hide">
        <div class="absolute w-48 h-48 bg-amber-200 rounded-full opacity-30 blur-3xl blob-float" style="top: 80px; left: 260px;"></div>
        <div class="absolute w-44 h-44 bg-pink-200 rounded-full opacity-25 blur-2xl blob-float-2" style="top: 260px; left: -30px;"></div>

        <div class="relative z-10 px-5 pt-10">
            <h1 class="text-stone-700 text-2xl font-semibold font-['Outfit'] mb-4">Buscar</h1>
            <form method="GET" action="{{ route('buscar') }}" class="mb-6">
                <div class="bg-white rounded-2xl border border-stone-200 shadow-sm flex items-center px-4 py-3 gap-2">
                    <svg class="w-5 h-5 text-stone-500" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM10 14a4 4 0 110-8 4 4 0 010 8z"/></svg>
                    <input type="text" name="q" value="{{ $query }}" placeholder="Títulos, subtítulos o personas" class="w-full bg-transparent outline-none text-stone-700 text-sm font-['Outfit']" />
                    @if($query)
                        <a href="{{ route('buscar') }}" class="text-stone-500 text-xs font-['Outfit']">Limpiar</a>
                    @endif
                </div>
            </form>

            {{-- Tabs --}}
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ route('buscar', ['q' => $query, 'tab' => 'publicaciones']) }}" class="px-4 py-2 rounded-full border {{ $tab === 'publicaciones' ? 'bg-yellow-100 border-amber-300 text-stone-800' : 'bg-white border-stone-200 text-stone-600' }} text-sm font-['Outfit'] shadow-sm">Publicaciones</a>
                <a href="{{ route('buscar', ['q' => $query, 'tab' => 'perfiles']) }}" class="px-4 py-2 rounded-full border {{ $tab === 'perfiles' ? 'bg-yellow-100 border-amber-300 text-stone-800' : 'bg-white border-stone-200 text-stone-600' }} text-sm font-['Outfit'] shadow-sm">Perfiles</a>
            </div>

            @if(!$query && count($history))
                <div class="mb-6">
                    <p class="text-stone-600/70 text-xs font-['Outfit'] mb-2">Búsquedas recientes</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($history as $h)
                            <a href="{{ route('buscar', ['q' => $h, 'tab' => $tab]) }}" class="px-3 py-1 rounded-full bg-stone-200 text-stone-700 text-xs font-['Outfit'] border border-stone-300">{{ $h }}</a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($tab === 'publicaciones')
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-stone-700 text-lg font-semibold font-['Outfit']">Publicaciones</h2>
                        <span class="text-xs px-3 py-1 rounded-full bg-blue-100 border border-blue-200 text-stone-700 font-['Outfit']">{{ $publicaciones->count() }}</span>
                    </div>
                    @if($publicaciones->count())
                        <div class="space-y-3">
                            @foreach($publicaciones as $publicacion)
                                @php $colors = $publicacion->getColorClasses(); @endphp
                                <a href="{{ route('publicaciones.show', $publicacion) }}" class="block w-full {{ $colors['bg'] }} rounded-[18px] border-2 {{ $colors['border'] }} p-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <h3 class="text-stone-800 text-base font-semibold font-['Outfit'] truncate">{{ $publicacion->titulo }}</h3>
                                                @if($publicacion->visibilidad === 'privada')
                                                    <span class="text-2xs px-2 py-1 rounded-full bg-stone-200 border border-stone-300 text-stone-700 font-['Outfit']">Privada</span>
                                                @endif
                                            </div>
                                            @if($publicacion->subtitulo)
                                                <p class="text-stone-700/80 text-sm font-['Outfit'] truncate">{{ $publicacion->subtitulo }}</p>
                                            @endif
                                            <div class="flex items-center gap-2 mt-1">
                                                <p class="text-stone-600/60 text-xs font-['Outfit']">Por {{ $publicacion->usuario->nombre }}</p>
                                                @if($publicacion->categoria)
                                                    <span class="text-[10px] px-2 py-1 rounded-full bg-white/70 border border-white text-stone-700 font-['Outfit'] inline-block">{{ $publicacion->categoria }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            @if($publicacion->fecha_subida)
                                                <p class="text-stone-600/60 text-xs font-['Outfit']">{{ optional($publicacion->fecha_subida)->format('d M') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-stone-600/70 text-sm font-['Outfit']">Sin resultados.</p>
                    @endif
                </div>
            @else
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-stone-700 text-lg font-semibold font-['Outfit']">Perfiles</h2>
                        <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 border border-emerald-200 text-stone-700 font-['Outfit']">{{ $usuarios->count() }}</span>
                    </div>
                    @if($usuarios->count())
                        <div class="space-y-2">
                            @foreach($usuarios as $persona)
                                <div class="flex items-center justify-between bg-white rounded-2xl border border-stone-200 p-3 shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-stone-200 overflow-hidden border border-white">
                                            <img src="{{ $persona->foto_perfil ? asset('storage/'.$persona->foto_perfil) : asset('images/default-profile.png') }}" alt="{{ $persona->nombre }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-stone-800 text-sm font-semibold font-['Outfit'] flex items-center gap-2">
                                                {{ $persona->nombre }}
                                                @if($persona->perfil_privado)
                                                    <span class="text-2xs px-2 py-1 rounded-full bg-stone-200 border border-stone-300 text-stone-700 font-['Outfit']">Privado</span>
                                                @endif
                                            </p>
                                            <p class="text-stone-600/70 text-xs font-['Outfit']">Ver perfil</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @php $estado = $seguimientos[$persona->id] ?? null; @endphp
                                        @if($persona->id === auth()->id())
                                            <span class="text-2xs px-2 py-1 rounded-full bg-yellow-100 border border-amber-200 text-stone-700 font-['Outfit']">Tú</span>
                                        @elseif($estado === 'accepted')
                                            <span class="text-2xs px-2 py-1 rounded-full bg-emerald-200 border border-emerald-300 text-stone-700 font-['Outfit']">Siguiendo</span>
                                        @elseif($estado === 'pending')
                                            <span class="text-2xs px-2 py-1 rounded-full bg-amber-200 border border-amber-300 text-stone-700 font-['Outfit']">Solicitado</span>
                                        @else
                                            <form method="POST" action="{{ route('usuarios.seguir', $persona) }}">
                                                @csrf
                                                <button type="submit" class="px-3 py-2 rounded-xl bg-yellow-100 border border-amber-300 text-stone-700 text-xs font-['Outfit'] hover:-translate-y-0.5 transition-all">{{ $persona->perfil_privado ? 'Solicitar' : 'Seguir' }}</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('usuarios.show', $persona) }}" class="text-stone-600 text-xs font-['Outfit'] underline">Perfil</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-stone-600/70 text-sm font-['Outfit']">Sin personas encontradas.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
{{-- Bottom Navigation --}}
<div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-96 bg-white rounded-t-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.25)] z-50">
    <div class="px-4 py-4 flex justify-around">
        <a href="{{ route('home') }}" data-route="home" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            </div>
            <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Principal</span>
        </a>
        <a href="{{ route('buscar') }}" data-route="search" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300 {{ request()->is('buscar*') ? 'bg-yellow-100' : 'bg-white/0' }}">
                <svg class="w-5 h-5 {{ request()->is('buscar*') ? 'text-stone-700' : 'text-stone-600/60' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/></svg>
            </div>
            <span class="{{ request()->is('buscar*') ? 'text-stone-700' : 'text-stone-600/60' }} text-xs font-normal font-['Outfit']">Buscar</span>
        </a>
        <a href="#" data-route="settings" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.64l-1.92-3.32c-.12-.22-.39-.3-.61-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.23-.09-.49 0-.61.22L2.74 8.87c-.12.22-.07.49.12.64l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.64l1.92 3.32c.12.22.39.3.61.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.23.09.49 0 .61-.22l1.92-3.32c.12-.22.07-.49-.12-.64l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
            </div>
            <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Ajustes</span>
        </a>
        <a href="{{ route('profile') }}" data-route="profile" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Perfil</span>
        </a>
    </div>
</div>
@endsection
