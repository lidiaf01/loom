@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">

        <div class="relative z-10 px-5 pt-12">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="text-stone-600 text-xl font-normal font-['Outfit']">Nueva publicación</h1>
                    <p class="text-stone-600/70 text-sm font-normal font-['Outfit'] mt-1">Comparte tu contenido</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br from-pink-300 to-purple-200 rounded-full shadow-md flex-shrink-0"></div>
            </div>

            <form id="formPaso1" method="POST" action="{{ route('publicaciones.continuar') }}" class="space-y-4">
                @csrf

                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                    <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Título</label>
                    <input type="text" name="titulo" required maxlength="150" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner focus:outline-none" placeholder="Escribe un título" />
                </div>

                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                    <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Subtítulo (opcional)</label>
                    <input type="text" name="subtitulo" maxlength="150" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-sm font-['Outfit'] shadow-inner focus:outline-none" placeholder="Añade un subtítulo" />
                </div>

                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                    <label class="block text-stone-600 text-sm font-normal font-['Outfit'] mb-2">Contenido</label>
                    <textarea id="editor" name="contenido" class="hidden"></textarea>
                    <div id="editor-ui" class="bg-stone-200 rounded-[20px] p-3 text-stone-700 text-sm font-['Outfit'] shadow-inner"></div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="w-12 h-12 bg-yellow-100 rounded-2xl border border-amber-300 shadow-md flex items-center justify-center hover:scale-105 hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    ClassicEditor.create(document.querySelector('#editor-ui'))
        .then(editor => {
            const form = document.getElementById('formPaso1');
            form.addEventListener('submit', () => {
                const contenidoField = document.querySelector('#editor');
                contenidoField.value = editor.getData();
            });
        })
        .catch(error => {
            console.error(error);
        });
});
</script>
@endsection
