@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    
    {{-- Contenedor centrado móvil --}}
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">
        {{-- Círculos decorativos --}}
        <div class="absolute w-96 h-96 bg-amber-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 120px; left: 250px;"></div>
        <div class="absolute w-72 h-72 bg-pink-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 300px; left: -30px;"></div>
        <div class="absolute w-80 h-80 bg-teal-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 500px; left: 280px;"></div>
        <div class="absolute w-64 h-64 bg-indigo-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 700px; left: -15px;"></div>
        <div class="absolute w-[14rem] h-[14rem] bg-lime-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 280px; left: 320px;"></div>

        {{-- Contenido principal --}}
        <div class="relative z-10">
            
            {{-- Encabezado --}}
            <div class="w-full pt-6 pb-4 px-4">
                <h1 class="text-stone-700 text-3xl font-semibold font-['Outfit'] mb-3 truncate-title">{{ $publicacion->titulo }}</h1>
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
                    <p class="text-stone-600/50 text-xs font-normal font-['Outfit'] mt-4">{{ $publicacion->fecha_subida instanceof \DateTime ? $publicacion->fecha_subida->format('d M Y') : $publicacion->fecha_subida }}</p>
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
                    <a href="{{ route('profile') }}" class="flex-1 bg-stone-300 hover:bg-stone-400 rounded-xl border border-stone-400 p-2 text-center transition-all duration-300 hover:shadow-stone-400/40 hover:scale-105 hover:-translate-y-1 flex items-center justify-center" title="Salir">
                        <svg class="w-5 h-5 text-stone-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    </a>
                    <button type="button" id="btn-abrir-guardar-modal" class="flex-1 w-full bg-amber-300 hover:bg-amber-400 rounded-xl border border-amber-400 p-2 text-center transition-all duration-300 hover:shadow-amber-400/40 hover:scale-105 hover:-translate-y-1 flex items-center justify-center" title="Guardar">
                        <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                    </button>
                    @if(Auth::id() === $publicacion->usuario_id)
                        <form action="{{ route('publicaciones.destroy', $publicacion) }}" method="POST" class="flex-1" data-confirm="¿Estás seguro de que deseas eliminar esta publicación?">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-300 hover:bg-red-400 rounded-xl border border-red-400 p-2 text-center transition-all duration-300 hover:shadow-red-400/40 hover:scale-105 hover:-translate-y-1 flex items-center justify-center" title="Eliminar">
                                <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

        @include('components.guardar-publicacion-modal')
        @include('layouts.navbar')
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('guardar-publicacion-modal');
    const btnAbrir = document.getElementById('btn-abrir-guardar-modal');
    const btnCancelar = document.getElementById('guardar-cancelar');
    const btnConfirmar = document.getElementById('guardar-confirmar');
    const carpetasLista = document.getElementById('carpetas-lista');

    if (!modal || !btnAbrir || !btnCancelar || !btnConfirmar || !carpetasLista) {
        console.error('Algún elemento clave no existe en el DOM');
        return;
    }

    btnAbrir.addEventListener('click', function() {
        modal.classList.remove('hidden');
        cargarCarpetas();
    });
    btnCancelar.addEventListener('click', function() {
        modal.classList.add('hidden');
    });
    btnConfirmar.addEventListener('click', function() {
        const carpetaId = document.querySelector('input[name=carpeta_guardar]:checked');
        if (!carpetaId) return;
        fetch('/publicaciones/{{ $publicacion->id_publicacion }}/guardar', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content, 'Content-Type': 'application/json' },
            body: JSON.stringify({ carpeta_id: carpetaId.value })
        })
        .then(r => r.json())
        .then(res => {
            if(res.success) {
                modal.classList.add('hidden');
            }
        });
    });
    function cargarCarpetas() {
        fetch('/api/carpetas', { credentials: 'same-origin' })
            .then(r => r.json())
            .then(res => {
                carpetasLista.innerHTML = '';
                if(Array.isArray(res) && res.length === 0) {
                    carpetasLista.innerHTML = '<div class="text-pink-400 text-center mb-4">No tienes carpetas creadas.<br>Crea una carpeta en tu biblioteca para guardar publicaciones.</div>';
                } else if(Array.isArray(res)) {
                    res.forEach(carpeta => {
                        carpetasLista.innerHTML += `<label class='flex items-center gap-2 mb-2 cursor-pointer'><input type='radio' name='carpeta_guardar' value='${carpeta.id_Carpeta}' class='accent-pink-500'><span class='inline-block w-6 h-6 rounded-full border-2 border-pink-200' style='background:${carpeta.color}'></span><span>${carpeta.nombre}</span></label>`;
                    });
                } else {
                    carpetasLista.innerHTML = '<div class="text-pink-400 text-center mb-4">Error al cargar tus carpetas.</div>';
                }
            })
            .catch(() => {
                carpetasLista.innerHTML = '<div class="text-pink-400 text-center mb-4">Error al cargar tus carpetas.</div>';
            });
    }
});
</script>
@endpush

    </div>
</div>
@endsection
