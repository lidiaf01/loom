@extends('layouts.app')

@section('content')
<div class="w-96 h-[780px] relative bg-orange-50 border-gray-200">
  <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200 overflow-hidden scrollbar-hide">
    <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200">
      <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200">
        <div class="w-16 h-16 left-[210px] top-[110px] absolute opacity-40 bg-cyan-200 rounded-full blob-float"></div>
        <div class="w-28 h-28 left-[-35px] top-[10px] absolute opacity-40 bg-orange-200 rounded-full blob-float-3"></div>
        <div class="w-28 h-28 left-[275px] top-[560px] absolute opacity-40 bg-emerald-200 rounded-full blob-float"></div>
        <div class="w-56 h-56 left-[-20px] top-[640px] absolute opacity-40 bg-lime-100 rounded-full blob-float-2"></div>
        <div class="w-16 h-16 left-[-20px] top-[470px] absolute opacity-40 bg-fuchsia-300 rounded-full blob-float-2"></div>
      </div>
      <div class="w-80 h-72 left-[24px] top-[-24px] absolute bg-black/0 border-gray-200">
        <div class="w-80 h-48 left-0 top-[64px] absolute bg-black/0 border-gray-200">
          <div class="w-32 h-12 left-[-7px] top-[12px] absolute text-center justify-start text-stone-700 text-4xl font-bold font-['Poppins'] leading-10">Loom</div>
          <div class="w-96 h-7 left-[-7px] top-[93px] absolute justify-start text-stone-700/80 text-2xl font-normal font-['Poppins'] leading-8">Comienza tu experiencia</div>
        </div>
      </div>
      <div class="w-80 h-28 left-[24px] top-[604px] absolute bg-black/0 border-gray-200">
        <form
          class="w-80 h-96 left-0 top-[-397px] absolute bg-orange-50 rounded-2xl shadow-[0px_10px_15px_0px_rgba(0,0,0,0.10)] shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-2 outline-offset-[-2px] outline-yellow-100 p-6"
          method="POST"
          action="{{ route('registro.1') }}"
        >
          @csrf

          <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Nombre de Usuario</label>
          <input
            name="nombre"
            value="{{ old('nombre') }}"
            required
            class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 mb-4"
          >

          <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Correo electrónico</label>
          <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[inset_0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 mb-4"
          >

          <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Fecha de nacimiento</label>
          <input
            type="date"
            name="fecha_nac"
            value="{{ old('fecha_nac') }}"
            required
            class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 mb-6"
          >

          <button
            type="submit"
            class="w-full h-14 bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-[0px_10px_15px_0px_rgba(0,0,0,0.10)] shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] flex items-center justify-center"
          >
            <span class="text-stone-700 text-base font-semibold font-['Poppins']">Continuar</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection