@extends('layouts.app')
@section('content')
<div class="w-96 min-h-screen mx-auto mt-4 px-2 sm:px-0 pb-32">
    @php
        $pastelColors = ['#FFD6E0', '#B5EAD7', '#C7CEEA', '#FFF5BA', '#FFDAC1', '#E2F0CB', '#B5D8FA', '#FFB7B2'];
        $color = $pastelColors[$carpeta->id_Carpeta % count($pastelColors)];
    @endphp
    <div class="flex items-center gap-3 mb-4">
        <div class="w-8 h-8 rounded-full" style="background: {{ $color }}"></div>
        <h2 class="text-xl font-bold text-pink-700 flex-1">{{ $carpeta->nombre }}</h2>
        <form method="POST" action="{{ route('biblioteca.carpeta.update', $carpeta->id_Carpeta) }}" class="flex gap-2 items-center">
            @csrf
            @method('PUT')
            <input name="nombre" value="{{ $carpeta->nombre }}" maxlength="50" class="border border-pink-200 rounded-lg p-1 w-24"/>
            <button class="bg-pink-400 hover:bg-pink-500 text-white px-2 py-1 rounded transition">Guardar</button>
        </form>
    </div>
    @if($publicaciones->count())
        <div class="space-y-3">
            @foreach($publicaciones as $publicacion)
                <a href="{{ route('publicaciones.show', $publicacion) }}" class="block bg-white border border-pink-100 rounded-xl p-3 shadow hover:bg-pink-50 transition">
                    <div class="font-semibold text-pink-900">{{ $publicacion->titulo }}</div>
                    <div class="text-xs text-pink-400">{{ $publicacion->categoria }}</div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-pink-400 text-center">No hay publicaciones en esta carpeta.</div>
    @endif
    <form method="POST" action="{{ route('biblioteca.carpeta.destroy', $carpeta->id_Carpeta) }}" class="mt-6 text-center" onsubmit="return confirm('¿Eliminar carpeta?')">
        @csrf
        @method('DELETE')
        <button class="text-red-400 hover:text-red-600 font-medium">Eliminar carpeta</button>
    </form>
</div>
@include('layouts.navbar')
@endsection
