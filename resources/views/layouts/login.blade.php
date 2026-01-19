@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-96 h-[780px] relative bg-transparent overflow-hidden scrollbar-hide">
        
        {{-- Elementos decorativos de fondo --}}
        <div class="w-16 h-16 left-[232px] top-[97px] absolute opacity-40 bg-sky-200 rounded-full blob-float"></div>
        <div class="w-28 h-28 left-[-25px] top-[17px] absolute opacity-40 bg-rose-200 rounded-full blob-float-2"></div>
        <div class="w-28 h-28 left-[295px] top-[579px] absolute opacity-40 bg-emerald-200 rounded-full blob-float"></div>
        <div class="w-56 h-56 left-[-12px] top-[624px] absolute opacity-40 bg-yellow-100 rounded-full blob-float-3"></div>
        <div class="w-16 h-16 left-[-12px] top-[481px] absolute opacity-40 bg-violet-300 rounded-full blob-float-2"></div>

        {{-- Encabezado --}}
        <div class="absolute left-[24px] top-[40px]">
            <h1 class="text-stone-700 text-4xl font-bold font-['Poppins']">Loom</h1>
            <h2 class="text-stone-700/80 text-3xl font-normal font-['Poppins'] mt-4">Inicio de Sesión</h2>
        </div>

        {{-- Formulario de Login --}}
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            {{-- Caja contenedora de inputs --}}
            <div class="w-80 h-80 left-[24px] top-[207px] absolute bg-orange-50 rounded-2xl shadow-lg border border-yellow-100 p-7">
                
                {{-- Campo: Nombre de Usuario --}}
                <div class="mb-6">
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Nombre de Usuario</label>
                    <input type="text" name="username" required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-inner px-4 focus:outline-none focus:ring-2 focus:ring-yellow-200">
                </div>

                {{-- Campo: Clave --}}
                <div>
                    <label class="text-stone-700/70 text-xl font-light font-['Outfit'] block mb-2">Clave</label>
                    <input type="password" name="password" required
                        class="w-full h-11 bg-stone-200 rounded-[20px] shadow-inner px-4 focus:outline-none focus:ring-2 focus:ring-yellow-200">
                </div>
            </div>

            {{-- Botón Continuar --}}
                        {{-- Mensajes de error y sesión --}}
                        @if(session('success'))
                            <div class="mb-4 w-80 left-[24px] absolute top-[170px]">
                                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded-lg text-sm">{{ session('success') }}</div>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mb-4 w-80 left-[24px] absolute top-[170px]">
                                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded-lg text-sm">{{ session('error') }}</div>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="mb-4 w-80 left-[24px] absolute top-[170px]">
                                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded-lg text-sm">
                                    @foreach($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
            <button type="submit" class="w-80 h-14 left-[24px] top-[553px] absolute bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-md flex items-center justify-center hover:opacity-90 transition-opacity">
                <div class="w-4 h-4 mr-2 bg-stone-700 rounded-sm"></div>
                <span class="text-stone-700 text-base font-semibold font-['Poppins']">Continuar</span>
            </button>
        </form>
        
    </div>
</div>
@endsection