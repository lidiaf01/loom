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
                <div class="flex flex-row gap-3">
                    <a href="{{ route('profile') }}" class="flex-1 bg-stone-300 hover:bg-stone-400 rounded-2xl border-2 border-stone-400 p-3 text-center transition-all duration-300 hover:shadow-stone-400/40 hover:scale-105 hover:-translate-y-1 flex items-center justify-center">
                        <span class="text-stone-700 text-base font-semibold font-['Outfit']">Salir</span>
                    </a>
                    <form action="{{ route('publicaciones.guardar', $publicacion) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-amber-300 hover:bg-amber-400 rounded-2xl border-2 border-amber-400 p-3 text-center transition-all duration-300 hover:shadow-amber-400/40 hover:scale-105 hover:-translate-y-1 flex items-center justify-center">
                            <span class="text-stone-700 text-base font-semibold font-['Outfit']">Guardar</span>
                        </button>
                    </form>
                    @if(Auth::id() === $publicacion->usuario_id)
                        <form action="{{ route('publicaciones.destroy', $publicacion) }}" method="POST" class="flex-1" data-confirm="¿Estás seguro de que deseas eliminar esta publicación?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-300 hover:bg-red-400 rounded-2xl border-2 border-red-400 p-3 text-center transition-all duration-300 hover:shadow-red-400/40 hover:scale-105 hover:-translate-y-1 flex items-center justify-center">
                                <span class="text-stone-700 text-base font-semibold font-['Outfit']">Eliminar</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

        @include('layouts.navbar')

    </div>
</div>
@endsection
