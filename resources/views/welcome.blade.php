@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 bg-orange-50 relative overflow-hidden">
    {{-- Blobs Decorativos de Fondo --}}
    <div class="absolute -top-20 -right-20 w-52 h-52 bg-yellow-100 rounded-full opacity-40 blob-float"></div>
    <div class="absolute top-1/3 -left-20 w-40 h-40 bg-emerald-100 rounded-full opacity-30 blob-float-2"></div>
    <div class="absolute -bottom-20 right-1/4 w-60 h-60 bg-pink-100 rounded-full opacity-35 blob-float-3"></div>
    <div class="absolute left-1/4 top-1/4 w-32 h-32 bg-blue-100 rounded-full opacity-25 blob-float-2"></div>
    
    <div class="w-full max-w-sm flex flex-col relative z-10">
        
        {{-- Encabezado --}}
        <div class="mb-8">
            <h1 class="text-stone-700 text-4xl font-bold font-['Poppins']">Hola, Luna ✨</h1>
            <p class="text-stone-500 text-base font-medium font-['Poppins'] mt-2">Tu espacio de crecimiento</p>
        </div>

        {{-- Sección Herramientas --}}
        <div class="mb-6">
            <h2 class="text-stone-600 text-sm font-semibold font-['Poppins'] mb-4 uppercase tracking-wide">Herramientas</h2>
            
            {{-- Grid de Cards --}}
            <div class="grid grid-cols-2 gap-4">
                
                {{-- Card Grande - Crear (ocupa 2 columnas) --}}
                <div class="col-span-2 group bg-yellow-200 rounded-3xl p-6 shadow-lg shadow-yellow-300/40 hover:shadow-xl hover:shadow-yellow-300/50 transition-all cursor-pointer">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center flex-shrink-0 shadow-md">
                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-stone-700 text-lg font-bold font-['Poppins']">Crear</h3>
                            <p class="text-stone-600 text-sm font-medium font-['Poppins']">Comparte tus hábitos</p>
                        </div>
                    </div>
                </div>

                {{-- Diario --}}
                <div class="group bg-teal-200 rounded-3xl p-5 shadow-lg shadow-yellow-300/40 hover:shadow-xl hover:shadow-yellow-300/50 transition-all cursor-pointer">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                            </svg>
                        </div>
                        <h3 class="text-stone-700 text-base font-bold font-['Poppins']">Diario</h3>
                        <p class="text-stone-600 text-xs font-medium font-['Poppins'] mt-1">Escribe tus pensamientos</p>
                    </div>
                </div>

                {{-- Últimas Lecturas --}}
                <div class="group bg-blue-200 rounded-3xl p-5 shadow-lg shadow-yellow-300/40 hover:shadow-xl hover:shadow-yellow-300/50 transition-all cursor-pointer">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                            </svg>
                        </div>
                        <h3 class="text-stone-700 text-base font-bold font-['Poppins']">Últimas lecturas</h3>
                        <p class="text-stone-600 text-xs font-medium font-['Poppins'] mt-1">Revisa tus aprendizajes</p>
                    </div>
                </div>

                {{-- Biblioteca --}}
                <div class="group bg-pink-300 rounded-3xl p-5 shadow-lg shadow-yellow-300/40 hover:shadow-xl hover:shadow-yellow-300/50 transition-all cursor-pointer">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                            </svg>
                        </div>
                        <h3 class="text-stone-700 text-base font-bold font-['Poppins']">Biblioteca</h3>
                        <p class="text-stone-600 text-xs font-medium font-['Poppins'] mt-1">Contenido Guardado</p>
                    </div>
                </div>

                {{-- Explorar --}}
                <div class="group bg-rose-300 rounded-3xl p-5 shadow-lg shadow-yellow-300/40 hover:shadow-xl hover:shadow-yellow-300/50 transition-all cursor-pointer">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-stone-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                            </svg>
                        </div>
                        <h3 class="text-stone-700 text-base font-bold font-['Poppins']">Explorar</h3>
                        <p class="text-stone-600 text-xs font-medium font-['Poppins'] mt-1">Por si no sabes por dónde</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
