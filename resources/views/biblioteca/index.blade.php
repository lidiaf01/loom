@extends('layouts.app')
@section('content')
<div class="h-screen w-screen bg-orange-50 flex flex-col justify-center items-center relative overflow-hidden">
    <div class="w-full max-w-md flex flex-col flex-1 justify-center items-center px-4 pt-10 pb-32">
        <h2 class="text-2xl font-bold text-pink-700 text-center mb-6">Mi Biblioteca</h2>
    @if($carpetas->count())
        <div class="flex flex-col items-center justify-center w-full flex-1">
            <div class="flex flex-col items-center w-full gap-6 max-w-md">
                @foreach($carpetas as $carpeta)
                    <a href="{{ route('biblioteca.carpeta.show', $carpeta->id_Carpeta) }}" class="w-full">
                        <div class="relative flex items-center justify-center w-full" style="height:110px;">
                            <svg width="100%" height="110" viewBox="0 0 350 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Sombra -->
                                <ellipse cx="175" cy="104" rx="120" ry="8" fill="#000" opacity="0.08" />
                                <!-- Tapa -->
                                <rect x="40" y="16" width="110" height="22" rx="10" fill="#ececec"/>
                                <rect x="40" y="16" width="110" height="22" rx="10" fill="{{ $carpeta->color }}" opacity="0.7"/>
                                <!-- Cuerpo principal -->
                                <path d="M20 38 Q20 20 90 20 H260 Q330 20 330 38 V92 Q330 104 260 104 H90 Q20 104 20 92 Z" fill="{{ $carpeta->color }}"/>
                                <!-- Nombre -->
                                <foreignObject x="60" y="70" width="230" height="30">
                                    <div xmlns="http://www.w3.org/1999/xhtml" style="width:230px;height:30px;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                        <span style="font-size:17px;font-family:Outfit,Arial,sans-serif;color:#444;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:210px;display:block;">{{ $carpeta->nombre }}</span>
                                    </div>
                                </foreignObject>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        </div>
    @else
        <div class="text-pink-400 text-center">No tienes carpetas aún.</div>
    @endif
    <div class="w-full flex justify-center">
        <button id="btnNuevaCarpeta" type="button" class="bg-pink-300 hover:bg-pink-400 text-white rounded-full w-16 h-16 flex items-center justify-center text-4xl shadow focus:outline-none transition fixed bottom-24 left-1/2 -translate-x-1/2 z-30">+</button>
    </div>
    <!-- Modal para crear carpeta -->
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
