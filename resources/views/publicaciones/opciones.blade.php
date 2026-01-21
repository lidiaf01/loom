@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">

        <div class="relative z-10 px-5 pt-12">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-stone-600 text-xl font-normal font-['Outfit']">Opciones de publicación</h1>
                    <p class="text-stone-600/70 text-sm font-normal font-['Outfit'] mt-1">Selecciona categoría y publica</p>
                </div>
                <form action="{{ route('publicaciones.cancelar') }}" method="POST" class="flex-shrink-0" data-confirm="¿Deseas cancelar la creación de la publicación?">
                    @csrf
                    <button type="submit" class="w-12 h-12 bg-red-100 hover:bg-red-200 rounded-full shadow-md flex items-center justify-center transition-all duration-300 hover:scale-105 border border-red-300">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                    <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Categoría</label>
                        <form id="formPaso2" method="POST" action="{{ route('publicaciones.store') }}" class="space-y-4">
                            @csrf
                            <select name="categoria" required class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner focus:outline-none">
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>

                            <div>
                                <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Visibilidad</label>
                                <select name="visibilidad" required class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner focus:outline-none">
                                    <option value="publica">Pública</option>
                                    <option value="privada">Privada</option>
                                </select>
                            </div>

                            <div class="flex flex-col gap-3 mt-6">
                                <button type="submit" class="w-full h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center hover:opacity-90 transition-opacity">
                                    <span class="text-stone-700 text-base font-semibold font-['Poppins']">Publicar</span>
                                </button>
                                <form action="{{ route('publicaciones.guardar', ['publicacion' => 0]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full h-14 bg-amber-200 hover:bg-amber-300 rounded-2xl shadow flex items-center justify-center transition-all">
                                        <span class="text-stone-700 text-base font-semibold font-['Poppins']">Guardar en Biblioteca</span>
                                    </button>
                                </form>
                            </div>
                        </form>
                </div>

                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Vista previa</h3>
                    <div class="bg-stone-100 rounded-2xl p-4 min-h-auto border-2 border-stone-200">
                        <h4 class="text-stone-700 text-base font-['Outfit'] break-words">{{ $titulo }}</h4>
                        @if($subtitulo)
                            <p class="text-stone-600/80 text-sm font-['Outfit'] mt-1 break-words">{{ $subtitulo }}</p>
                        @endif
                        <div class="prose prose-sm max-w-none text-stone-700 mt-3 break-words word-break overflow-auto max-h-64">
                            {!! $contenido !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Bottom Navigation --}}
<div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-96 bg-white rounded-t-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.25)] z-50">
    <div class="px-4 py-4 flex justify-around">
        <form action="{{ route('publicaciones.cancelar') }}" method="POST" class="w-full" data-confirm="¿Deseas cancelar la creación? Se perderán los cambios.">
            @csrf
            <button type="submit" data-route="home" class="nav-link flex flex-col items-center gap-1 transition-all duration-300 w-full">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                </div>
                <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Principal</span>
            </button>
        </form>
        <form action="{{ route('publicaciones.cancelar') }}" method="POST" class="w-full" data-confirm="¿Deseas cancelar la creación? Se perderán los cambios.">
            @csrf
            <button type="submit" data-route="search" class="nav-link flex flex-col items-center gap-1 transition-all duration-300 w-full">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/></svg>
                </div>
                <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Buscar</span>
            </button>
        </form>
        <form action="{{ route('publicaciones.cancelar') }}" method="POST" class="w-full" data-confirm="¿Deseas cancelar la creación? Se perderán los cambios.">
            @csrf
            <button type="submit" data-route="settings" class="nav-link flex flex-col items-center gap-1 transition-all duration-300 w-full">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.64l-1.92-3.32c-.12-.22-.39-.3-.61-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.23-.09-.49 0-.61.22L2.74 8.87c-.12.22-.07.49.12.64l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.64l1.92 3.32c.12.22.39.3.61.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17 .47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39 .96c.23 .09 .49 0 .61-.22l1.92-3.32c.12-.22 .07-.49-.12-.64l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
                </div>
                <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Ajustes</span>
            </button>
        </form>
        <form action="{{ route('publicaciones.cancelar') }}" method="POST" class="w-full" data-confirm="¿Deseas cancelar la creación? Se perderán los cambios.">
            @csrf
            <button type="submit" data-route="profile" class="nav-link flex flex-col items-center gap-1 transition-all duration-300 w-full">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                    <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <span class="text-stone-600 text-xs font-normal font-['Outfit']">Perfil</span>
            </button>
        </form>
    </div>
</div>
@endsection
