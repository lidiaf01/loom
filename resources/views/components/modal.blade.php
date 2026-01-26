{{-- Modal de confirmación personalizado --}}
<div id="custom-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] hidden items-center justify-center px-4 opacity-0 transition-opacity duration-300">
    <div id="modal-content" class="bg-white rounded-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.35)] border-2 border-stone-200 p-6 max-w-sm w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex flex-col items-center text-center">
            {{-- Icono --}}
            <div id="modal-icon" class="w-64 h-64 rounded-full mb-4 flex items-center justify-center bg-amber-100 border-2 border-amber-300">
                <svg id="modal-icon-svg" class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            
            {{-- Título --}}
            <h3 id="modal-title" class="text-stone-700 text-lg font-semibold font-['Outfit'] mb-2">
                Confirmar acción
            </h3>
            
            {{-- Mensaje --}}
            <p id="modal-message" class="text-stone-600/80 text-sm font-normal font-['Outfit'] mb-6">
                ¿Estás seguro de que deseas continuar?
            </p>
            
            {{-- Botones --}}
            <div class="flex gap-3 w-full">
                <button id="modal-cancel" class="flex-1 px-4 py-3 bg-stone-200 hover:bg-stone-300 rounded-2xl border border-stone-300 text-stone-700 text-sm font-semibold font-['Outfit'] transition-all duration-300 hover:scale-105">
                    Cancelar
                </button>
                <button id="modal-confirm" class="flex-1 px-4 py-3 bg-gradient-to-br from-red-200 to-pink-300 hover:from-red-300 hover:to-pink-400 rounded-2xl border border-red-300 text-stone-700 text-sm font-semibold font-['Outfit'] transition-all duration-300 hover:scale-105 shadow-md">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
