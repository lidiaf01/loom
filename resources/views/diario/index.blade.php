@extends('layouts.app')
@section('content')
<div class="w-96 min-h-screen mx-auto mt-4 px-2 sm:px-0 pb-32">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-emerald-700">Mi Diario</h2>
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
                        <div class="text-emerald-800 break-words">{{ $entrada->contenido }}</div>
                        @if($entrada->estado_animo)
                            <div class="text-xs text-emerald-500 mt-1">{{ $entrada->estado_animo }}</div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('diario.destroy', $entrada->id_entrada) }}" onsubmit="return confirm('¿Eliminar entrada?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 font-medium">Eliminar</button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $diario->links() }}</div>
    @else
        <div class="text-emerald-400 text-center">No hay entradas aún.</div>
    @endif
</div>
@include('layouts.navbar')
@endsection
