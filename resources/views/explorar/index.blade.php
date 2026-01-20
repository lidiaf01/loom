@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-24 scrollbar-hide">
        <div class="absolute w-48 h-48 bg-sky-200 rounded-full opacity-30 blur-3xl blob-float" style="top: 120px; left: 260px;"></div>
        <div class="absolute w-44 h-44 bg-amber-200 rounded-full opacity-25 blur-2xl blob-float-2" style="top: 320px; left: -30px;"></div>

        <div class="relative z-10 px-5 pt-10">
            <h1 class="text-stone-700 text-2xl font-semibold font-['Outfit'] mb-1">Explorar</h1>
            <p class="text-stone-600/70 text-sm font-['Outfit'] mb-6">Recientes y populares por guardados</p>

            @if($publicaciones->count())
                <div class="space-y-4">
                    @foreach($publicaciones as $publicacion)
                        @php $colors = $publicacion->getColorClasses(); @endphp
                        <a href="{{ route('publicaciones.show', $publicacion) }}" class="block w-full {{ $colors['bg'] }} rounded-3xl border-2 {{ $colors['border'] }} p-4 shadow-[0px_6px_12px_0px_rgba(0,0,0,0.10)] hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-white/70 border border-white flex items-center justify-center text-stone-700 text-lg font-bold font-['Outfit']">
                                    {{ $publicacion->guardada_por_count }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1 flex-wrap">
                                        @if($publicacion->categoria)
                                            <span class="text-[10px] px-2 py-1 rounded-full bg-white/70 border border-white text-stone-700 font-['Outfit']">{{ $publicacion->categoria }}</span>
                                        @endif
                                        @if($publicacion->visibilidad === 'privada')
                                            <span class="text-2xs px-2 py-1 rounded-full bg-stone-200 border border-stone-300 text-stone-700 font-['Outfit']">Privada</span>
                                        @endif
                                    </div>
                                    <h3 class="text-stone-800 text-lg font-semibold font-['Outfit'] leading-tight">{{ $publicacion->titulo }}</h3>
                                    @if($publicacion->subtitulo)
                                        <p class="text-stone-700/80 text-sm font-['Outfit'] mt-1">{{ $publicacion->subtitulo }}</p>
                                    @endif
                                    <p class="text-stone-700/80 text-xs font-['Outfit'] mt-1">
                                        {{ $publicacion->usuario->nombre }}
                                        @if($publicacion->fecha_subida)
                                            · {{ optional($publicacion->fecha_subida)->format('d M Y') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-stone-600/70 text-sm font-['Outfit']">Aún no hay publicaciones para explorar.</p>
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
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/></svg>
            </div>
            <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Buscar</span>
        </a>
        <a href="#" data-route="settings" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.64l-1.92-3.32c-.12-.22-.39-.3-.61-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.23-.09-.49 0-.61.22L2.74 8.87c-.12.22-.07.49.12.64l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.64l1.92 3.32c.12.22.39.3.61.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17 .47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39 .96c.23 .09 .49 0 .61-.22l1.92-3.32c.12-.22 .07-.49-.12-.64l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
            </div>
            <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Ajustes</span>
        </a>
        <a href="{{ route('profile') }}" data-route="profile" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
            <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <span class="text-stone-600 text-xs font-normal font-['Outfit']">Perfil</span>
        </a>
    </div>
</div>
@endsection
