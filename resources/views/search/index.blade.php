@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-24 scrollbar-hide">
        {{-- Círculos decorativos --}}
        <div class="absolute w-80 h-80 bg-amber-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 80px; left: 260px;"></div>
        <div class="absolute w-72 h-72 bg-pink-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 260px; left: -30px;"></div>
        <div class="absolute w-96 h-96 bg-sky-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 450px; left: 280px;"></div>
        <div class="absolute w-[14rem] h-[14rem] bg-emerald-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 650px; left: -20px;"></div>

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
                <a href="{{ route('buscar', ['q' => $query, 'tab' => 'publicaciones']) }}" class="px-4 py-2 rounded-full border {{ $tab === 'publicaciones' ? 'bg-yellow-200 border-amber-300 text-stone-800' : 'bg-white border-stone-200 text-stone-600' }} text-sm font-['Outfit'] shadow-sm">Publicaciones</a>
                <a href="{{ route('buscar', ['q' => $query, 'tab' => 'perfiles']) }}" class="px-4 py-2 rounded-full border {{ $tab === 'perfiles' ? 'bg-yellow-200 border-amber-300 text-stone-800' : 'bg-white border-stone-200 text-stone-600' }} text-sm font-['Outfit'] shadow-sm">Perfiles</a>
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
                        <div class="space-y-4">
                            @foreach($publicaciones as $publicacion)
                                @php $colors = $publicacion->getColorClasses(); @endphp
                                <a href="{{ route('publicaciones.show', $publicacion) }}" class="block w-full {{ $colors['bg'] }} rounded-3xl border-2 {{ $colors['border'] }} p-4 shadow-[0px_6px_12px_0px_rgba(0,0,0,0.10)] hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                    <div class="flex items-start gap-3">
                                        <!-- Avatar de guardados eliminado -->
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
                                            <img src="{{ $persona->foto_perfil ? asset('storage/'.$persona->foto_perfil) : asset('images/default-profile.svg') }}" alt="{{ $persona->nombre }}" class="w-full h-full object-cover bg-white">
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
                                            <span class="text-2xs px-2 py-1 rounded-full bg-yellow-200 border border-amber-200 text-stone-700 font-['Outfit']">Tú</span>
                                        @elseif($estado === 'accepted')
                                            <span class="text-2xs px-2 py-1 rounded-full bg-emerald-200 border border-emerald-300 text-stone-700 font-['Outfit']">Siguiendo</span>
                                        @elseif($estado === 'pending')
                                            <span class="text-2xs px-2 py-1 rounded-full bg-amber-200 border border-amber-300 text-stone-700 font-['Outfit']">Solicitado</span>
                                        @else
                                            <form method="POST" action="{{ route('usuarios.seguir', $persona) }}">
                                                @csrf
                                                <button type="submit" class="px-3 py-2 rounded-xl bg-yellow-200 border border-amber-300 text-stone-700 text-xs font-['Outfit'] hover:-translate-y-0.5 transition-all">{{ $persona->perfil_privado ? 'Solicitar' : 'Seguir' }}</button>
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
@include('layouts.navbar')
@endsection
