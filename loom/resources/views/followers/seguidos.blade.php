@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-24 scrollbar-hide">
        {{-- Círculos decorativos --}}
        <div class="absolute w-80 h-80 bg-emerald-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 80px; left: 260px;"></div>
        <div class="absolute w-72 h-72 bg-cyan-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 260px; left: -30px;"></div>
        <div class="absolute w-96 h-96 bg-yellow-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 460px; left: 280px;"></div>
        <div class="absolute w-64 h-64 bg-rose-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 660px; left: -20px;"></div>

        <div class="relative z-10 px-5 pt-10">
            <div class="flex items-center gap-2 mb-4">
                <a href="{{ url()->previous() }}" class="p-2 rounded-full hover:bg-stone-200 transition" title="Volver">
                    <svg class="w-6 h-6 text-stone-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </a>
                <div>
                    <h1 class="text-stone-700 text-2xl font-semibold font-['Outfit']">Seguidos</h1>
                    <p class="text-stone-600/70 text-sm font-['Outfit']">{{ $user->nombre }}</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-stone-700 text-base font-semibold font-['Outfit']">Seguidos</span>
                    <span class="text-xs px-3 py-1 bg-emerald-200 border border-emerald-300 rounded-full text-stone-700 font-['Outfit']">{{ $seguidos->count() }}</span>
                </div>
                @if($seguidos->count())
                    <div class="space-y-2">
                        @foreach($seguidos as $seguido)
                            <div class="flex items-center justify-between bg-stone-100 rounded-2xl px-3 py-2 border border-stone-200">
                                <a href="{{ route('usuarios.show', $seguido) }}" class="text-stone-700 text-sm font-semibold font-['Outfit'] hover:underline">{{ $seguido->nombre }}</a>
                                @if($seguido->perfil_privado)
                                    <p class="text-stone-600/70 text-xs font-['Outfit'] mb-0">Perfil privado</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-stone-600/70 text-sm font-['Outfit']">No sigues a nadie aún.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
