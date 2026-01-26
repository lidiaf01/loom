@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">
        {{-- Círculos decorativos --}}
        <div class="absolute w-80 h-80 bg-yellow-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 100px; left: 260px;"></div>
        <div class="absolute w-72 h-72 bg-pink-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 280px; left: -30px;"></div>
        <div class="absolute w-96 h-96 bg-amber-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 480px; left: 280px;"></div>
        <div class="absolute w-64 h-64 bg-rose-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 680px; left: -20px;"></div>

        <div class="relative z-10 px-5 pt-12">
            <div class="flex w-full items-center justify-between">
                <div>
                    <h1 class="text-stone-600 text-xl font-normal font-['Outfit']">Opciones de publicación</h1>
                    <p class="text-stone-600/70 text-sm font-normal font-['Outfit'] mt-1">Selecciona categoría y publica</p>
                </div>
                <form action="{{ route('publicaciones.cancelar') }}" method="POST" class="flex-shrink-0 ml-4" data-confirm="¿Deseas cancelar la creación de la publicación?">
                    @csrf
                    <button type="submit" class="w-12 h-12 bg-red-100 hover:bg-red-200 rounded-full shadow-md flex items-center justify-center transition-all duration-300 hover:scale-105 border border-red-300">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200 mt-6">
                    <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Categoría</label>
                        <form id="formPaso2" method="POST" action="{{ route('publicaciones.store') }}" class="space-y-4">
                            @csrf
                            <select name="categoria" required class="w-full bg-stone-200 rounded-[20px] px-2 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner focus:outline-none" style="padding-right:22px;">
                                @foreach($categorias as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>

                            <div>
                                <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Visibilidad</label>
                                <select name="visibilidad" required class="w-full bg-stone-200 rounded-[20px] px-2 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner focus:outline-none" style="padding-right:22px;">
                                    <option value="publica">Pública</option>
                                    <option value="privada">Privada</option>
                                </select>
                            </div>

                            <div class="flex flex-col gap-3 mt-6">
                                <button type="button" id="btnAbrirGuardarModal" class="w-full h-14 bg-amber-200 hover:bg-amber-300 rounded-2xl shadow flex items-center justify-center gap-2 transition-all">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    <span class="text-stone-700 text-base font-semibold font-['Poppins']">Guardar en Biblioteca</span>
                                </button>
                                <button type="submit" class="w-full h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center hover:opacity-90 transition-opacity mt-2">
                                    <span class="text-stone-700 text-base font-semibold font-['Poppins']">Publicar</span>
                                </button>
                                </div>

                                <!-- Espacio extra entre formulario y vista previa -->
                                <div class="mb-6"></div>
                                                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200 mt-6">
                                <div id="guardar-publicacion-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 hidden">
                                    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-sm">
                                        <h2 class="text-stone-700 text-lg font-bold font-['Outfit'] mb-4">Guardar en carpeta</h2>
                                        @if($carpetas->count())
                                            <div class="flex flex-col gap-3 mb-4">
                                                @foreach($carpetas as $carpeta)
                                                    <label class="flex items-center gap-2 cursor-pointer">
                                                        <input type="radio" name="carpeta_id" value="{{ $carpeta->id_Carpeta }}" class="peer hidden">
                                                        <span class="inline-block w-7 h-7 rounded-full border-2 border-pink-200 peer-checked:border-pink-500" style="background: {{ $carpeta->color }}"></span>
                                                        <span class="font-semibold text-stone-700">{{ $carpeta->nombre }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <div class="mb-2 text-stone-500 text-sm font-['Outfit']">Se guardará en:</div>
                                            <div id="previewCarpeta" class="mb-4 hidden"></div>
                                        @else
                                            <div class="text-pink-400 text-center mb-4">No tienes carpetas creadas.<br>Crea una carpeta en tu biblioteca para guardar publicaciones.</div>
                                        @endif
                                        <button type="button" id="guardar-cancelar" class="w-full mt-2 h-10 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl font-semibold flex items-center justify-center gap-2 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" id="carpetaSeleccionada" name="carpeta_id" value="">

                                <!-- Preview visual de la carpeta seleccionada -->
                                <div id="seGuardaraEn" class="mb-0 text-stone-500 text-sm font-['Outfit']" style="display:none;">Se guardará en:</div>
                                <div id="carpetaPreviewSeleccionada" class="mt-0"></div>
                            </div>
                        </form>
                            @push('scripts')
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const btnAbrirGuardarModal = document.getElementById('btnAbrirGuardarModal');
                                const modal = document.getElementById('guardar-publicacion-modal');
                                const btnCancelar = document.getElementById('guardar-cancelar');
                                const radios = document.querySelectorAll('#guardar-publicacion-modal input[type=radio][name=carpeta_id]');
                                const preview = document.getElementById('previewCarpeta');
                                const inputCarpetaSeleccionada = document.getElementById('carpetaSeleccionada');
                                const carpetaPreviewSeleccionada = document.getElementById('carpetaPreviewSeleccionada');
                                const seGuardaraEn = document.getElementById('seGuardaraEn');
                                btnAbrirGuardarModal.addEventListener('click', function() {
                                    modal.classList.remove('hidden');
                                });
                                btnCancelar.addEventListener('click', function() {
                                    modal.classList.add('hidden');
                                });
                                radios.forEach(radio => {
                                    radio.addEventListener('change', function() {
                                        // Preview en el modal
                                        preview.innerHTML = `<div class='flex items-center gap-2 mt-2'><span class='inline-block w-6 h-6 rounded-full border-2 border-pink-200' style='background:${this.nextElementSibling.style.background}'></span><span class='font-semibold text-stone-700'>${this.nextElementSibling.nextElementSibling.textContent}</span></div>`;
                                        preview.classList.remove('hidden');
                                        inputCarpetaSeleccionada.value = this.value;
                                        modal.classList.add('hidden');

                                        // Preview visual debajo del botón
                                        carpetaPreviewSeleccionada.innerHTML = `<div class='flex items-center gap-2 p-2 bg-stone-100 rounded-xl border border-pink-200 mt-2'><span class='inline-block w-7 h-7 rounded-full border-2 border-pink-200' style='background:${this.nextElementSibling.style.background}'></span><span class='font-semibold text-stone-700'>${this.nextElementSibling.nextElementSibling.textContent}</span></div>`;
                                        seGuardaraEn.style.display = '';
                                    });
                                });
                                // Si ya hay una carpeta seleccionada al recargar, mostrar el preview
                                if(inputCarpetaSeleccionada.value) {
                                    const selectedRadio = Array.from(radios).find(r => r.value === inputCarpetaSeleccionada.value);
                                    if(selectedRadio) {
                                        carpetaPreviewSeleccionada.innerHTML = `<div class='flex items-center gap-2 p-2 bg-stone-100 rounded-xl border border-pink-200 mt-2'><span class='inline-block w-7 h-7 rounded-full border-2 border-pink-200' style='background:${selectedRadio.nextElementSibling.style.background}'></span><span class='font-semibold text-stone-700'>${selectedRadio.nextElementSibling.nextElementSibling.textContent}</span></div>`;
                                        seGuardaraEn.style.display = '';
                                    }
                                } else {
                                    carpetaPreviewSeleccionada.innerHTML = '';
                                    seGuardaraEn.style.display = 'none';
                                }
                            });
                            </script>
                            @endpush
                            @push('scripts')
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const btnAbrirGuardarModal = document.getElementById('btnAbrirGuardarModal');
                                const modal = document.getElementById('guardar-publicacion-modal');
                                const btnCancelar = document.getElementById('guardar-cancelar');
                                btnAbrirGuardarModal.addEventListener('click', function() {
                                    modal.classList.remove('hidden');
                                });
                                btnCancelar.addEventListener('click', function() {
                                    modal.classList.add('hidden');
                                });
                                const radios = document.querySelectorAll('#formGuardarEnCarpeta input[type=radio][name=carpeta_id]');
                                const preview = document.getElementById('previewCarpeta');
                                radios.forEach(radio => {
                                    radio.addEventListener('change', function() {
                                        preview.innerHTML = `<div class='flex items-center gap-2 mt-2'><span class='inline-block w-6 h-6 rounded-full border-2 border-pink-200' style='background:${this.nextElementSibling.style.background}'></span><span class='font-semibold text-stone-700'>${this.nextElementSibling.nextElementSibling.textContent}</span></div>`;
                                        preview.classList.remove('hidden');
                                    });
                                });
                            });
                            </script>
                            @endpush
                            </div>
                        </form>
                </div>

                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200 mt-6">
                    <h3 class="text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Vista previa</h3>
                    <div class="bg-stone-100 rounded-2xl p-4 min-h-auto border-2 border-stone-200 mt-6">
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
