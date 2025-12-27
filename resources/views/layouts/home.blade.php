@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-96 h-[780px] relative bg-orange-50 border-gray-200 rounded-[2rem] shadow-xl overflow-hidden">
        <div class="w-96 h-[778px] left-0 top-0 absolute bg-orange-50 border-gray-200">
            <div class="w-96 h-24 left-0 top-0 absolute bg-black/0 border-gray-200">
                <div class="w-80 h-14 left-[20px] top-[32px] absolute bg-black/0 border-gray-200">
                    <div class="w-40 h-14 left-0 top-0 absolute bg-black/0 border-gray-200">
                        <div class="w-40 h-8 left-0 top-0 absolute justify-start text-stone-600 text-2xl font-normal font-['Outfit'] leading-8">Hola, {{ Auth::user()->nombre }}</div>
                        <div class="w-40 h-5 left-0 top-[36px] absolute justify-start text-stone-600/70 text-sm font-normal font-['Outfit'] leading-5">Tu espacio de crecimiento</div>
                    </div>
                    <div class="w-12 h-12 left-[287px] top-[4px] absolute bg-gradient-to-br from-pink-300 to-purple-200 rounded-full border-gray-200"></div>
                </div>
            </div>
            <div class="w-96 left-0 top-[102px] absolute bg-black/0 border-gray-200">
                <div class="px-5 justify-start text-stone-600/60 text-sm font-normal font-['Outfit'] leading-5 tracking-tight">Herramientas</div>
                <div class="mt-4 px-5 grid grid-cols-2 gap-4">
                    <a href="#" class="col-span-2 h-40 bg-yellow-100 rounded-2xl shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-amber-300 p-4 flex flex-col">
                        <div class="w-10 h-10 bg-orange-50 rounded-xl border-gray-200"></div>
                        <div class="mt-4">
                            <div class="text-stone-600 text-sm font-normal font-['Outfit']">Crear</div>
                            <div class="text-stone-600/60 text-xs font-normal font-['Outfit']">Comparte tus hábitos</div>
                        </div>
                    </a>
                    <a href="#" class="h-40 bg-emerald-100 rounded-2xl shadow-[0px_2px_4px_0px_rgba(0,0,0,0.25)] outline outline-1 outline-emerald-300 p-4 flex flex-col">
                        <div class="w-10 h-10 bg-orange-50 rounded-xl border-gray-200"></div>
                        <div class="mt-4">
                            <div class="text-stone-600 text-sm font-normal font-['Outfit']">Diario</div>
                            <div class="text-stone-600/60 text-xs font-normal font-['Outfit']">Escribe tus pensamientos</div>
                        </div>
                    </a>
                    <a href="#" class="h-40 bg-sky-200 rounded-2xl shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-blue-300 p-4 flex flex-col">
                        <div class="w-10 h-10 bg-orange-50 rounded-xl border-gray-200"></div>
                        <div class="mt-4">
                            <div class="text-stone-600 text-sm font-normal font-['Outfit']">Últimas lecturas</div>
                            <div class="text-stone-600/60 text-xs font-normal font-['Outfit']">Revisa tus aprendizajes anteriores</div>
                        </div>
                    </a>
                    <a href="#" class="h-40 bg-pink-300 rounded-2xl shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-pink-400 p-4 flex flex-col">
                        <div class="w-10 h-10 bg-orange-50 rounded-xl border-gray-200"></div>
                        <div class="mt-4">
                            <div class="text-stone-600 text-sm font-normal font-['Outfit']">Biblioteca</div>
                            <div class="text-stone-600/60 text-xs font-normal font-['Outfit']">Contenido Guardado</div>
                        </div>
                    </a>
                    <a href="#" class="h-40 bg-red-300 rounded-2xl shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-red-400 p-4 flex flex-col">
                        <div class="w-10 h-10 bg-orange-50 rounded-xl border-gray-200"></div>
                        <div class="mt-4">
                            <div class="text-stone-600 text-sm font-normal font-['Outfit']">Explorar</div>
                            <div class="text-stone-600/60 text-xs font-normal font-['Outfit']">Por si no sabes por donde empezar</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="w-96 h-24 left-0 top-[682px] absolute bg-white rounded-tl-3xl rounded-tr-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.25)] border-gray-200"></div>
            <div class="w-80 h-16 left-[16px] top-[694px] absolute bg-black/0 border-gray-200">
                <a href="#" class="w-20 h-16 left-0 top-0 absolute bg-yellow-100 rounded-2xl border-gray-200 inline-block">
                    <div class="w-12 h-4 left-[15px] top-[46px] absolute text-center justify-start text-stone-600 text-xs font-normal font-['Outfit']">Principal</div>
                </a>
                <a href="#" class="w-20 h-16 left-[87.75px] top-0 absolute bg-black/0 rounded-2xl border-gray-200 inline-block">
                    <div class="w-9 h-4 left-[21.56px] top-[44px] absolute text-center justify-start text-stone-600/60 text-xs font-normal font-['Outfit'] leading-4">Buscar</div>
                </a>
                <a href="#" class="w-20 h-16 left-[175.50px] top-0 absolute bg-black/0 rounded-2xl border-gray-200 inline-block">
                    <div class="w-14 h-4 left-[13.75px] top-[44px] absolute text-center justify-start text-stone-600/60 text-xs font-normal font-['Outfit'] leading-4">Ajustes</div>
                </a>
                <a href="#" class="w-20 h-16 left-[263.25px] top-0 absolute bg-black/0 rounded-2xl border-gray-200 inline-block">
                    <div class="w-7 h-4 left-[25.80px] top-[44px] absolute text-center justify-start text-stone-600/60 text-xs font-normal font-['Outfit'] leading-4">Perfil</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection