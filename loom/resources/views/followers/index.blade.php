@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-24 scrollbar-hide">
        {{-- Círculos decorativos --}}
        <div class="absolute w-80 h-80 bg-amber-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 80px; left: 260px;"></div>
        <div class="absolute w-72 h-72 bg-pink-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 260px; left: -30px;"></div>
        <div class="absolute w-96 h-96 bg-teal-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 460px; left: 280px;"></div>
        <div class="absolute w-64 h-64 bg-lime-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 660px; left: -20px;"></div>

        <div class="relative z-10 px-5 pt-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <a href="{{ url()->previous() }}" class="p-2 rounded-full hover:bg-stone-200 transition" title="Volver">
                        <svg class="w-6 h-6 text-stone-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const volverBtn = document.querySelector('[title="Volver"]');
                            if (volverBtn) {
                                volverBtn.addEventListener('click', function(e) {
                                    if (window.history.length > 1) {
                                        e.preventDefault();
                                        window.history.back();
                                    } else {
                                        window.location.href = '/home';
                                    }
                                });
                            }
                        });
                        </script>
                    </a>
                    <div>
                        <h1 class="text-stone-700 text-2xl font-semibold font-['Outfit']">Seguidores</h1>
                        <p class="text-stone-600/70 text-sm font-['Outfit']">{{ $user->nombre }}</p>
                    </div>
                </div>
            </div>

            @if($isOwner && $solicitudes->count())
                <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200 mb-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-stone-700 text-base font-semibold font-['Outfit']">Solicitudes</span>
                        <span class="text-xs px-3 py-1 bg-amber-200 border border-amber-300 rounded-full text-stone-700 font-['Outfit']">{{ $solicitudes->count() }}</span>
                    </div>
                    <div class="space-y-2">
                        @foreach($solicitudes as $solicitud)
                            <div class="flex items-center justify-between bg-stone-100 rounded-2xl px-3 py-2 border border-stone-200">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-stone-700 text-sm font-semibold font-['Outfit'] mb-0">{{ $solicitud->nombre }}</p>
                                        <a href="{{ route('usuarios.show', $solicitud) }}" class="text-stone-600 hover:text-emerald-600 transition p-1" title="Ver perfil">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12z"/>
                                                <circle cx="12" cy="12" r="3.5"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <p class="text-stone-600/70 text-xs font-['Outfit']">Quiere seguirte</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('usuarios.rechazar', ['usuario' => $solicitud->id]) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-stone-200 text-stone-700 text-xs font-['Outfit'] border border-stone-300 hover:bg-stone-300 transition-all">Rechazar</button>
                                                                            <button type="submit" class="px-3 py-2 rounded-xl bg-stone-200 text-stone-700 text-xs font-['Outfit'] border border-stone-300 hover:bg-stone-300 transition-all" title="Rechazar">
                                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                                                            </button>
                                    </form>
                                    <form method="POST" action="{{ route('usuarios.aceptar', ['usuario' => $solicitud->id]) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-emerald-200 text-stone-700 text-xs font-['Outfit'] border border-emerald-300 hover:bg-emerald-300 transition-all">Aceptar</button>
                                                                            <button type="submit" class="px-3 py-2 rounded-xl bg-emerald-200 text-stone-700 text-xs font-['Outfit'] border border-emerald-300 hover:bg-emerald-300 transition-all" title="Aceptar">
                                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                                                            </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-3xl p-4 shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border border-stone-200">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-stone-700 text-base font-semibold font-['Outfit']">Seguidores</span>
                    <span class="text-xs px-3 py-1 bg-emerald-200 border border-emerald-300 rounded-full text-stone-700 font-['Outfit']">{{ $seguidores->count() }}</span>
                </div>
                @if($seguidores->count())
                    <div class="space-y-2">
                        @foreach($seguidores as $seguidor)
                            <div class="flex items-center justify-between bg-stone-100 rounded-2xl px-3 py-2 border border-stone-200">
                                <div>
                                    <a href="{{ route('usuarios.show', $seguidor) }}" class="text-stone-700 text-sm font-semibold font-['Outfit'] hover:underline">{{ $seguidor->nombre }}</a>
                                    @if($seguidor->perfil_privado)
                                        <p class="text-stone-600/70 text-xs font-['Outfit']">Perfil privado</p>
                                    @endif
                                </div>
                                    <!-- No ver icon for followers -->
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-stone-600/70 text-sm font-['Outfit']">Sin seguidores aún.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
