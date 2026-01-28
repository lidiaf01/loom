@extends('layouts.app')
@section('content')
<div class="min-h-screen w-full bg-orange-50 flex flex-col items-center relative overflow-hidden">
    {{-- Círculos decorativos --}}
    <div class="absolute w-96 h-96 bg-pink-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 100px; left: 70%;"></div>
    <div class="absolute w-72 h-72 bg-rose-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 300px; left: 10%;"></div>
    <div class="absolute w-80 h-80 bg-fuchsia-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 500px; left: 75%;"></div>
    <div class="absolute w-64 h-64 bg-purple-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 700px; left: 5%;"></div>

    <div class="w-full max-w-md flex flex-col flex-1 items-center px-2 pt-6 pb-32 sm:px-4 sm:pt-10 relative z-10">
        <h2 class="text-stone-700 text-2xl font-bold font-['Outfit'] text-center mb-4 sm:mb-6">
            @if(isset($owner))
                Biblioteca de {{ $owner->nombre }}
            @else
                Mi Biblioteca
            @endif
        </h2>
    @if($carpetas->count())
        <div class="grid grid-cols-2 gap-4 sm:gap-6 w-full max-w-md">
            @foreach($carpetas as $carpeta)
                <a href="{{ route('biblioteca.carpeta.show', $carpeta->id_Carpeta) }}" class="block">
                    <div class="relative flex flex-col items-center justify-center w-full h-[90px] sm:h-[110px] group transition-transform hover:scale-105 cursor-pointer rounded-2xl shadow-md border border-pink-100" style="background: {{ $carpeta->color }};">
                        <span class="text-sm sm:text-base font-semibold text-stone-700 text-center px-2 truncate w-full" title="{{ $carpeta->nombre }}">{{ $carpeta->nombre }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        @if(!isset($owner) || (isset($owner) && auth()->id() === $owner->id))
        <div class="w-full flex justify-center mt-8 mb-10">
            <button id="btnNuevaCarpeta" type="button" class="bg-[#FFD6E0] hover:bg-[#F8A5C2] text-pink-700 rounded-full w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center text-2xl sm:text-3xl shadow-lg focus:outline-none transition z-50">+
            </button>
        </div>
        @endif
    @else
        @if(isset($owner) && auth()->id() !== $owner->id)
            <div class="text-pink-400 text-center">Esta biblioteca aún no tiene carpetas públicas.</div>
        @else
            <div class="text-pink-400 text-center">No tienes carpetas aún.</div>
            <div class="w-full flex justify-center mt-4 mb-6">
                <button id="btnNuevaCarpeta" type="button" class="bg-pink-400 hover:bg-pink-500 text-white rounded-full w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center text-2xl sm:text-3xl shadow-lg focus:outline-none transition z-50">+
                </button>
            </div>
        @endif
    @endif
    <!-- Modal para crear carpeta -->
    @if(!isset($owner) || (isset($owner) && auth()->id() === $owner->id))
    <div id="modalCarpeta" class="absolute left-1/2 top-1/2 z-[100] hidden -translate-x-1/2 -translate-y-1/2 px-4 pb-32">
        <div class="bg-white rounded-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.15)] border-2 border-stone-200 p-6 max-w-sm w-full flex flex-col">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-stone-700 text-lg font-bold">Nueva carpeta</h3>
                <button id="cerrarModalCarpeta" type="button" class="text-stone-400 hover:text-stone-600 text-2xl font-bold">&times;</button>
            </div>
            <form id="formCarpeta" method="POST" action="{{ route('biblioteca.carpeta.store') }}" class="flex flex-col gap-2">
                @csrf
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
        </div>
        </div>
    </div>
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

    // True vertical carousel animation for folders
    const stack = document.getElementById('stackCarpetas');
    if (stack) {
        let startY = 0;
        let moved = false;
        let animating = false;
        const cardHeight = 220 + 56; // SVG height + margin-bottom

        function updateClickable() {
            stack.querySelectorAll('a').forEach((a, idx) => {
                a.onclick = function(e) {
                    if (idx !== 0 || animating) e.preventDefault();
                };
            });
        }
        updateClickable();

        function moveStackUp() {
            if (animating || stack.children.length < 2) return;
            animating = true;
            stack.style.transition = 'transform 0.45s cubic-bezier(.4,2,.3,1)';
            stack.style.transform = `translateY(-${cardHeight}px)`;
            setTimeout(() => {
                stack.style.transition = 'none';
                stack.style.transform = 'none';
                stack.appendChild(stack.children[0]);
                updateClickable();
                animating = false;
            }, 450);
        }

        // Mouse wheel
        stack.addEventListener('wheel', function(e) {
            if (e.deltaY > 0 && !animating) {
                moveStackUp();
            }
        });

        // Touch swipe
        stack.addEventListener('touchstart', function(e) {
            startY = e.touches[0].clientY;
            moved = false;
        });
        stack.addEventListener('touchmove', function(e) {
            if (!moved && e.touches[0].clientY - startY < -30 && !animating) {
                moved = true;
                moveStackUp();
            }
        });
    }
</script>
<style>
    .slide-down {
        transition: transform 0.4s cubic-bezier(.4,2,.3,1), opacity 0.4s cubic-bezier(.4,2,.3,1);
        transform: translateY(220px);
        opacity: 0.5;
    }
</style>
</script>
@endpush
