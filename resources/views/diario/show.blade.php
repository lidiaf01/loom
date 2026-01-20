@extends('layouts.app')
@section('content')
<div class="w-96 min-h-screen mx-auto mt-4 px-2 sm:px-0 pb-32">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-emerald-700">Diario de {{ $owner->nombre }}</h2>
    @if($diario->count())
        <div class="space-y-3">
            @foreach($diario as $entrada)
                <div class="bg-white border border-emerald-100 p-3 rounded-xl shadow">
                    <div class="text-xs text-emerald-400">@php try { echo \Carbon\Carbon::parse($entrada->fecha_entrada)->format('d/m/Y H:i'); } catch (Exception $e) { echo $entrada->fecha_entrada; } @endphp</div>
                    <div class="font-semibold text-emerald-900 break-words">{{ $entrada->titulo }}</div>
                    <div class="text-emerald-800 break-words">{{ $entrada->contenido }}</div>
                    @if($entrada->estado_animo)
                        <div class="text-xs text-emerald-500 mt-1">{{ $entrada->estado_animo }}</div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $diario->links() }}</div>
    @else
        <div class="text-emerald-400 text-center">No hay entradas públicas.</div>
    @endif
</div>
@include('layouts.navbar')
@endsection
