@extends('layouts.app')
@section('content')
<div class="w-full max-w-md min-h-screen mx-auto mt-6 px-2 sm:px-4 md:px-8 pb-32">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-pink-700">Mi Biblioteca</h2>
        <button id="btnNuevaCarpeta" class="bg-pink-300 hover:bg-pink-400 text-white rounded-full w-10 h-10 flex items-center justify-center text-2xl shadow focus:outline-none" title="Nueva carpeta">+</button>
    </div>
    <!-- Modal para crear carpeta -->
    <div id="modalCarpeta" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-lg p-6 w-80 border border-pink-100 relative">
            <button id="cerrarModalCarpeta" class="absolute top-2 right-2 text-pink-400 hover:text-pink-600 text-xl">&times;</button>
            <h3 class="text-lg font-bold mb-3 text-pink-700">Nueva carpeta</h3>
            <form id="formCarpeta" method="POST" action="{{ route('biblioteca.carpeta.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-pink-800">Nombre carpeta</label>
                    <input name="nombre" required maxlength="50" class="w-full border border-pink-200 rounded-lg p-2 bg-white focus:ring-2 focus:ring-pink-200"/>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-pink-800">Color</label>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @php $pastelColors = ['#FFD6E0', '#B5EAD7', '#C7CEEA', '#FFF5BA', '#FFDAC1', '#E2F0CB', '#B5D8FA', '#FFB7B2']; @endphp
                        @foreach($pastelColors as $color)
                            <label class="cursor-pointer">
                                <input type="radio" name="color" value="{{ $color }}" class="peer hidden" @if($loop->first) checked @endif>
                                <span class="inline-block w-8 h-8 rounded-full border-2 border-pink-200 peer-checked:border-pink-500" style="background: {{ $color }}"></span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <button class="bg-pink-400 hover:bg-pink-500 text-white px-4 py-2 rounded-lg w-full transition">Crear carpeta</button>
            </form>
        </div>
    </div>
    @if($carpetas->count())
        <div class="space-y-3">
            @foreach($carpetas as $carpeta)
                <div class="flex items-center gap-3 bg-white border border-pink-100 rounded-xl p-3 shadow transition-all md:hover:scale-[1.02]">
                    <div class="w-8 h-8 rounded-full flex-shrink-0" style="background: {{ $carpeta->color }}"></div>
                    <a href="{{ route('biblioteca.carpeta.show', $carpeta->id_Carpeta) }}" class="flex-1 font-semibold text-pink-900 hover:underline truncate">{{ $carpeta->nombre }}</a>
                    <form method="POST" action="{{ route('biblioteca.carpeta.destroy', $carpeta->id_Carpeta) }}" onsubmit="return confirm('¿Eliminar carpeta?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 font-medium">Eliminar</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-pink-400 text-center">No tienes carpetas aún.</div>
    @endif
</div>
@include('layouts.navbar')
@endsection
@push('scripts')
<script>
    const btnNuevaCarpeta = document.getElementById('btnNuevaCarpeta');
    const modalCarpeta = document.getElementById('modalCarpeta');
    const cerrarModalCarpeta = document.getElementById('cerrarModalCarpeta');
    const formCarpeta = document.getElementById('formCarpeta');

    btnNuevaCarpeta.onclick = function() {
        modalCarpeta.classList.remove('hidden');
    };
    cerrarModalCarpeta.onclick = function() {
        modalCarpeta.classList.add('hidden');
    };
    modalCarpeta.addEventListener('click', function(e) {
        if (e.target === this) this.classList.add('hidden');
    });
    formCarpeta.onsubmit = function() {
        setTimeout(() => modalCarpeta.classList.add('hidden'), 100);
    };
</script>
@endpush
