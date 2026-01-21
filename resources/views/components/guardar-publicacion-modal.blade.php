<div id="guardar-publicacion-modal" class="absolute left-1/2 top-1/2 z-[100] hidden -translate-x-1/2 -translate-y-1/2 px-4 pb-32">
    <div class="bg-white rounded-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.15)] border-2 border-stone-200 p-6 max-w-sm w-full flex flex-col">
        <h3 class="text-stone-700 text-lg font-bold mb-4">Guardar publicación</h3>
        <div id="carpetas-lista" class="mb-4">
            <!-- Aquí se cargarán las carpetas del usuario -->
        </div>
        <button id="btn-abrir-form-carpeta" class="mb-4 w-full bg-pink-200 hover:bg-pink-300 text-pink-900 font-semibold rounded-xl py-2 transition">+ Nueva carpeta</button>
        <form id="form-nueva-carpeta" class="hidden flex flex-col gap-2 mb-4">
            <input type="text" name="nombre" placeholder="Nombre de la carpeta" class="border rounded-lg px-3 py-2" required>
            <div class="flex flex-wrap gap-3 mt-2 justify-center items-center">
                @php $colores = ['#FFD6E0', '#B5EAD7', '#C7CEEA', '#FFF5BA', '#FFDAC1', '#E2F0CB', '#B5D8FA', '#FFB7B2']; @endphp
                @foreach($colores as $color)
                    <label>
                        <input type="radio" name="color" value="{{ $color }}" class="peer hidden" @if($loop->first) checked @endif>
                        <span class="inline-block w-7 h-7 rounded-full border-2 border-pink-200 peer-checked:border-pink-500" style="background: {{ $color }}"></span>
                    </label>
                @endforeach
            </div>
            <select name="visibilidad" class="border rounded-lg px-3 py-2" required>
                <option value="privada">Privada</option>
                <option value="publica">Pública</option>
            </select>
            <button type="submit" class="bg-pink-400 hover:bg-pink-500 text-white rounded-lg py-2 mt-2">Crear carpeta</button>
        </form>
        <div class="flex gap-3 mt-2">
            <button id="guardar-cancelar" class="flex-1 px-4 py-2 bg-stone-200 hover:bg-stone-300 rounded-2xl border border-stone-300 text-stone-700 text-sm font-semibold transition">Cancelar</button>
            <button id="guardar-confirmar" class="flex-1 px-4 py-2 bg-amber-300 hover:bg-amber-400 rounded-2xl border border-amber-400 text-stone-700 text-sm font-semibold transition">Guardar</button>
        </div>
    </div>
</div>
