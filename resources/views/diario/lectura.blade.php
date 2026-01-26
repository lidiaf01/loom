@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-full max-w-lg mx-auto px-4 pt-8 pb-32">
        {{-- Círculos decorativos --}}
        <div class="absolute w-80 h-80 bg-emerald-200 rounded-full opacity-60 blur-2xl blob-float z-0" style="top: 100px; left: 70%;"></div>
        <div class="absolute w-64 h-64 bg-teal-200 rounded-full opacity-58 blur-2xl blob-float-2 z-0" style="top: 250px; left: 5%;"></div>
        <div class="absolute w-96 h-96 bg-lime-200 rounded-full opacity-55 blur-2xl blob-float-3 z-0" style="top: 450px; left: 75%;"></div>
        <div class="absolute w-[14rem] h-[14rem] bg-green-100 rounded-full opacity-60 blur-2xl blob-float z-0" style="top: 650px; left: 10%;"></div>

        <h2 class="text-stone-700 text-2xl font-bold font-['Outfit'] mb-4 relative z-10">Lectura completa del diario</h2>
        <div class="bg-white border border-emerald-100 p-5 rounded-2xl shadow relative z-10">
            <div class="text-xs text-emerald-400 mb-2">
                @php try { echo \Carbon\Carbon::parse($entrada->fecha_entrada)->format('d/m/Y H:i'); } catch (Exception $e) { echo $entrada->fecha_entrada; } @endphp
            </div>
            <div class="font-semibold text-emerald-900 text-lg mb-2 break-words">{{ $entrada->titulo }}</div>
            <div class="text-emerald-800 whitespace-pre-line break-words">{{ $entrada->contenido }}</div>
            @if($entrada->estado_animo)
                <div class="text-xs text-emerald-500 mt-2">{{ $entrada->estado_animo }}</div>
            @endif
        </div>
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 mt-8 px-4 py-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-600 text-sm font-medium transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Volver
        </a>
    </div>
</div>
@include('layouts.navbar')
@endsection
