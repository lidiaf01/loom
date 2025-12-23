@extends('layouts.app')

@section('content')
<div class="h-[780px] bg-white rounded-lg outline outline-2 outline-offset-[-2px] outline-gray-300 inline-flex flex-col justify-start items-start overflow-hidden">
  <div class="w-96 h-[780px] relative bg-orange-50 border-gray-200">
    <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200 overflow-hidden">
      <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200">
        <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200">
          <div class="w-16 h-16 left-[220px] top-[90px] absolute opacity-40 bg-sky-200 rounded-full blob-float"></div>
          <div class="w-28 h-28 left-[-35px] top-[22px] absolute opacity-40 bg-rose-200 rounded-full blob-float-2"></div>
          <div class="w-28 h-28 left-[285px] top-[585px] absolute opacity-40 bg-teal-100 rounded-full blob-float-3"></div>
          <div class="w-56 h-56 left-[-20px] top-[635px] absolute opacity-40 bg-amber-100 rounded-full blob-float-2"></div>
          <div class="w-16 h-16 left-[-20px] top-[475px] absolute opacity-40 bg-indigo-300 rounded-full blob-float"></div>
        </div>
        <div class="w-80 h-72 left-[24px] top-[-24px] absolute bg-black/0 border-gray-200">
          <div class="w-80 h-48 left-0 top-[64px] absolute bg-black/0 border-gray-200">
            <div class="w-32 h-12 left-[-7px] top-[12px] absolute text-center justify-start text-stone-700 text-4xl font-bold font-['Poppins'] leading-10">Loom</div>
            <div class="w-60 h-7 left-0 top-[93px] absolute text-center justify-start text-stone-700/80 text-3xl font-normal font-['Poppins'] leading-8">Inicio de Sesión</div>
          </div>
        </div>
        <div class="w-80 h-28 left-[24px] top-[604px] absolute bg-black/0 border-gray-200">
          <form
            class="w-80 h-80 left-0 top-[-397px] absolute bg-orange-50 rounded-2xl shadow-[0px_10px_15px_0px_rgba(0,0,0,0.10)] shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-2 outline-offset-[-2px] outline-yellow-100 p-6"
            method="POST"
            action="{{ route('registro.finalizar') }}"
          >
            @csrf

            <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Clave</label>
            <input
              type="password"
              name="contrasenha"
              required
              minlength="6"
              class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 mb-4"
            >

            <label class="block text-stone-700/70 text-xl font-light font-['Outfit'] mb-2">Confirmar Clave</label>
            <input
              type="password"
              name="contrasenha_confirmation"
              required
              class="w-full h-11 bg-stone-200 rounded-[20px] shadow-[inset_0px_4px_4px_0px_rgba(0,0,0,0.25)] px-4 mb-6"
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
</div>
@endsection