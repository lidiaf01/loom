@extends('layouts.app')
@section('content')
<div class="w-96 min-h-screen mx-auto mt-4 px-2 sm:px-0 pb-32 relative">
    {{-- Círculos decorativos --}}
    <div class="absolute w-72 h-72 bg-emerald-200 rounded-full opacity-60 blur-2xl blob-float z-0" style="top: 80px; left: 250px;"></div>
    <div class="absolute w-64 h-64 bg-teal-200 rounded-full opacity-58 blur-2xl blob-float-2 z-0" style="top: 240px; left: -30px;"></div>
    <div class="absolute w-80 h-80 bg-lime-200 rounded-full opacity-55 blur-2xl blob-float-3 z-0" style="top: 450px; left: 270px;"></div>
    <div class="absolute w-[14rem] h-[14rem] bg-green-100 rounded-full opacity-60 blur-2xl blob-float z-0" style="top: 650px; left: -20px;"></div>

    <div class="flex items-center gap-2 mb-4 relative z-10">
        <a href="{{ route('usuarios.show', $owner) }}" class="p-2 rounded-full hover:bg-stone-200 transition z-10" title="Volver al perfil">
            <svg class="w-6 h-6 text-stone-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <h2 class="text-stone-700 text-2xl font-bold font-['Outfit'] mb-0">Diario de {{ $owner->nombre }}</h2>
    </div>
    @if($diario->count())
        <div class="space-y-3 relative z-10">
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
                    </div>
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
