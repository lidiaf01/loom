@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-full max-w-md min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide px-4 pt-16">
    @php
        $pastelColors = ['#FFD6E0', '#B5EAD7', '#C7CEEA', '#FFF5BA', '#FFDAC1', '#E2F0CB', '#B5D8FA', '#FFB7B2'];
        $color = $pastelColors[$carpeta->id_Carpeta % count($pastelColors)];
    @endphp
    <div class="relative mb-8">
        <a href="{{ route('biblioteca.index') }}" class="absolute left-0 top-0 bg-white border border-pink-200 rounded-full shadow px-3 py-1 text-pink-500 text-sm font-semibold hover:bg-pink-50 transition flex items-center gap-1 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Volver
        </a>
        <h2 class="text-2xl font-bold text-pink-700 text-center mt-10">{{ $carpeta->nombre }}</h2>
        <button id="btn-ajustes-carpeta" class="absolute right-0 top-0 p-2 rounded-full hover:bg-pink-100 transition ml-2" title="Ajustes">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 2.25c.414 0 .75.336.75.75v1.086a7.5 7.5 0 013.09 1.282l.77-.77a.75.75 0 111.06 1.06l-.77.77A7.5 7.5 0 0120.164 9h1.086a.75.75 0 010 1.5h-1.086a7.5 7.5 0 01-1.282 3.09l.77.77a.75.75 0 11-1.06 1.06l-.77-.77A7.5 7.5 0 0112 20.164v1.086a.75.75 0 01-1.5 0v-1.086a7.5 7.5 0 01-3.09-1.282l-.77.77a.75.75 0 11-1.06-1.06l.77-.77A7.5 7.5 0 013.836 12H2.75a.75.75 0 010-1.5h1.086a7.5 7.5 0 011.282-3.09l-.77-.77a.75.75 0 111.06-1.06l.77.77A7.5 7.5 0 0112 3.836V2.75c0-.414.336-.75.75-.75zM12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
            </svg>
        </button>
        <div id="menu-ajustes-carpeta" class="absolute right-0 top-16 bg-white border border-pink-200 rounded-xl shadow-lg p-4 w-64 z-20 hidden">
            <form id="form-editar-carpeta" method="POST" action="{{ route('biblioteca.carpeta.update', $carpeta->id_Carpeta) }}" class="flex flex-col gap-3 mb-3">
                @csrf
                @method('PUT')
                <label class="text-sm text-pink-700 font-semibold">Nombre
                    <input name="nombre" value="{{ $carpeta->nombre }}" maxlength="50" class="border border-pink-200 rounded-lg p-2 w-full mt-1"/>
                </label>
                <label class="text-sm text-pink-700 font-semibold">Color
                    <div class="flex flex-wrap gap-3 mt-2 justify-center items-center">
                        @foreach($pastelColors as $colorOption)
                            <label>
                                <input type="radio" name="color" value="{{ $colorOption }}" class="peer hidden" @if($carpeta->color == $colorOption) checked @endif>
                                <span class="inline-block w-7 h-7 rounded-full border-2 border-pink-200 peer-checked:border-pink-500" style="background: {{ $colorOption }}"></span>
                            </label>
                        @endforeach
                    </div>
                </label>
                <button class="bg-pink-400 hover:bg-pink-500 text-white rounded-lg py-2 mt-2">Guardar cambios</button>
            </form>
            <form method="POST" action="{{ route('biblioteca.carpeta.destroy', $carpeta->id_Carpeta) }}" onsubmit="return confirm('¿Eliminar carpeta?')">
                @csrf
                @method('DELETE')
                <button class="w-full text-red-400 hover:text-red-600 font-medium py-2">Eliminar carpeta</button>
            </form>
        </div>
    </div>
    @if($publicaciones->count())
        <div class="grid gap-5">
            @foreach($publicaciones as $publicacion)
                <a href="{{ route('publicaciones.show', $publicacion) }}" class="block bg-white border-2 border-pink-100 rounded-2xl p-5 shadow-md hover:bg-pink-50 transition-all duration-200 hover:scale-[1.02]">
                    <div class="font-semibold text-lg text-pink-900 mb-1">{{ $publicacion->titulo }}</div>
                    <div class="text-xs text-pink-400 mb-1">{{ $publicacion->categoria }}</div>
                    <div class="text-stone-500 text-xs">{{ $publicacion->fecha_subida ? ($publicacion->fecha_subida instanceof \DateTime ? $publicacion->fecha_subida->format('d M Y') : $publicacion->fecha_subida) : '' }}</div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-pink-400 text-center text-base mt-10">No hay publicaciones en esta carpeta.</div>
    @endif
    {{-- Eliminar carpeta solo desde el menú de ajustes --}}
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnAjustes = document.getElementById('btn-ajustes-carpeta');
        const menuAjustes = document.getElementById('menu-ajustes-carpeta');
        let abierto = false;
        btnAjustes.addEventListener('click', function(e) {
            e.stopPropagation();
            abierto = !abierto;
            menuAjustes.classList.toggle('hidden', !abierto);
        });
        document.addEventListener('click', function(e) {
            if (abierto && !menuAjustes.contains(e.target) && e.target !== btnAjustes) {
                menuAjustes.classList.add('hidden');
                abierto = false;
            }
        });
    });
</script>
@endpush

@include('layouts.navbar')
@endsection
