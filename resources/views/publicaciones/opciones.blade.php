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
                <div class="w-12 h-12 bg-gradient-to-br from-pink-300 to-purple-200 rounded-full shadow-md flex-shrink-0"></div>
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

                        <div class="mt-2">
                            <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Guardar en carpeta</label>
                            <input type="text" disabled placeholder="Opcional (próximamente)" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner" />
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-3 bg-gradient-to-br from-yellow-100 to-pink-300 rounded-2xl border border-amber-300 shadow-md text-stone-700 text-sm font-['Outfit'] hover:scale-105 hover:-translate-y-1 transition-all duration-300">Publicar</button>
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
@endsection
