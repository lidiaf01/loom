@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-24 scrollbar-hide">
        <div class="absolute w-48 h-48 bg-amber-200 rounded-full opacity-30 blur-3xl blob-float" style="top: 80px; left: 260px;"></div>
        <div class="absolute w-44 h-44 bg-pink-200 rounded-full opacity-25 blur-2xl blob-float-2" style="top: 260px; left: -30px;"></div>

        <div class="relative z-10 px-5 pt-10">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-stone-700 text-2xl font-semibold font-['Outfit']">Seguidores</h1>
                    <p class="text-stone-600/70 text-sm font-['Outfit']">{{ $user->nombre }}</p>
                </div>
                <a href="{{ route('usuarios.show', $user) }}" class="text-stone-600 text-xs font-['Outfit'] underline">Volver</a>
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
                                    <p class="text-stone-700 text-sm font-semibold font-['Outfit']">{{ $solicitud->nombre }}</p>
                                    <p class="text-stone-600/70 text-xs font-['Outfit']">Quiere seguirte</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('usuarios.rechazar', $solicitud) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-stone-200 text-stone-700 text-xs font-['Outfit'] border border-stone-300 hover:bg-stone-300 transition-all">Rechazar</button>
                                    </form>
                                    <form method="POST" action="{{ route('usuarios.aceptar', $solicitud) }}">
                                        @csrf
                                        <button type="submit" class="px-3 py-2 rounded-xl bg-emerald-200 text-stone-700 text-xs font-['Outfit'] border border-emerald-300 hover:bg-emerald-300 transition-all">Aceptar</button>
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
                                    <p class="text-stone-700 text-sm font-semibold font-['Outfit']">{{ $seguidor->nombre }}</p>
                                    @if($seguidor->perfil_privado)
                                        <p class="text-stone-600/70 text-xs font-['Outfit']">Perfil privado</p>
                                    @endif
                                </div>
                                <a href="{{ route('usuarios.show', $seguidor) }}" class="text-stone-600 text-xs font-['Outfit'] underline">Ver</a>
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
