@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide px-4 pt-10">
    {{-- Círculos decorativos --}}
    <div class="absolute w-96 h-96 bg-emerald-200 rounded-full opacity-60 blur-2xl blob-float z-0" style="top: 100px; left: 260px;"></div>
    <div class="absolute w-72 h-72 bg-teal-200 rounded-full opacity-58 blur-2xl blob-float-2 z-0" style="top: 300px; left: -30px;"></div>
    <div class="absolute w-80 h-80 bg-lime-200 rounded-full opacity-55 blur-2xl blob-float-3 z-0" style="top: 500px; left: 280px;"></div>
    <div class="absolute w-64 h-64 bg-green-100 rounded-full opacity-60 blur-2xl blob-float z-0" style="top: 700px; left: -15px;"></div>

    <h2 class="text-stone-700 text-2xl font-bold font-['Outfit'] mb-4 relative z-10">Mi Diario</h2>
    <div class="relative z-10">
    <form method="POST" action="{{ route('diario.store') }}" class="mb-6 bg-emerald-50 p-3 sm:p-4 rounded-2xl shadow border border-emerald-100">
        @csrf
        <div class="mb-2">
            <label class="block text-sm font-medium text-emerald-800">Título</label>
            <input name="titulo" required maxlength="255" class="w-full border border-emerald-200 rounded-lg p-2 bg-white focus:ring-2 focus:ring-emerald-200"/>
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-emerald-800">Contenido</label>
            <textarea name="contenido" required class="w-full border border-emerald-200 rounded-lg p-2 bg-white focus:ring-2 focus:ring-emerald-200"></textarea>
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-emerald-800">Estado de ánimo</label>
            <select name="estado_animo" class="w-full border border-emerald-200 rounded-lg p-2 bg-white focus:ring-2 focus:ring-emerald-200">
                <option value="">Selecciona un estado</option>
                <option value="Feliz">Feliz</option>
                <option value="Triste">Triste</option>
                <option value="Motivado">Motivado</option>
                <option value="Cansado">Cansado</option>
                <option value="Ansioso">Ansioso</option>
                <option value="Agradecido">Agradecido</option>
                <option value="Enojado">Enojado</option>
                <option value="Relajado">Relajado</option>
                <option value="Emocionado">Emocionado</option>
                <option value="Preocupado">Preocupado</option>
            </select>
        </div>
        <button class="bg-emerald-400 hover:bg-emerald-500 text-white px-4 py-2 rounded-lg w-full mt-2 transition">Añadir entrada</button>
    </form>
    @if($diario->count())
        <div class="space-y-3">
            @foreach($diario as $entrada)
                <div class="bg-white border border-emerald-100 p-3 rounded-xl shadow flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-emerald-400">@php try { echo \Carbon\Carbon::parse($entrada->fecha_entrada)->format('d/m/Y H:i'); } catch (Exception $e) { echo $entrada->fecha_entrada; } @endphp</div>
                        <div class="font-semibold text-emerald-900 break-words">{{ $entrada->titulo }}</div>
                        @if($entrada->estado_animo)
                            <div class="text-xs text-emerald-500 mt-1">{{ $entrada->estado_animo }}</div>
                        @endif
                    </div>
                    <div class="flex flex-row gap-2 items-center mt-2 sm:mt-0">
                        <a href="{{ route('diario.lectura', $entrada->id_entrada) }}" title="Ver completo" class="p-2 rounded-full hover:bg-emerald-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('diario.destroy', $entrada->id_entrada) }}" onsubmit="return confirm('¿Eliminar entrada?')">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 rounded-full hover:bg-red-50 transition" title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $diario->links() }}</div>
    @else
        <div class="text-emerald-400 text-center">No hay entradas aún.</div>
    @endif
    </div>
</div>
@include('layouts.navbar')
@endsection
