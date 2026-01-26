@extends("layouts.login")
@section("content")
<div class="h-[780px] bg-white rounded-lg outline outline-2 outline-offset-[-2px] outline-gray-300 inline-flex flex-col justify-start items-start overflow-hidden">
  <div class="w-96 h-[780px] relative bg-orange-50 border-gray-200">
    {{-- Círculos decorativos --}}
    <div class="w-48 h-48 left-[265px] top-[120px] absolute opacity-58 bg-red-200 rounded-full blob-float"></div>
    <div class="w-64 h-64 left-[-28px] top-[25px] absolute opacity-55 bg-orange-200 rounded-full blob-float-2"></div>
    <div class="w-56 h-56 left-[285px] top-[600px] absolute opacity-60 bg-rose-200 rounded-full blob-float-3"></div>
    <div class="w-40 h-40 left-[-12px] top-[510px] absolute opacity-58 bg-pink-100 rounded-full blob-float"></div>

    <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200 overflow-hidden">
      <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200">
        <div class="w-96 h-[780px] left-0 top-0 absolute bg-black/0 border-gray-200">
          <a
            href="{{ route('login') }}"
            class="w-80 h-14 left-[24px] top-[553px] absolute bg-gradient-to-r from-yellow-100 to-pink-300 rounded-2xl shadow-[0px_10px_15px_0px_rgba(0,0,0,0.10)] shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] border-gray-200 flex items-center justify-center hover:opacity-90 transition"
          >
            <span class="text-stone-700 text-base font-semibold font-['Poppins']">Volver</span>
          </a>
        </div>
        <div class="w-80 h-72 left-[24px] top-[-24px] absolute bg-black/0 border-gray-200">
          <div class="w-80 h-48 left-0 top-[64px] absolute bg-black/0 border-gray-200">
            <div class="w-32 h-12 left-[-7px] top-[12px] absolute text-center justify-start text-stone-700 text-4xl font-bold font-['Poppins'] leading-10">Loom</div>
            <div class="w-60 h-7 left-0 top-[93px] absolute text-center justify-start text-stone-700/80 text-3xl font-normal font-['Poppins'] leading-8">Inicio de Sesión</div>
          </div>
        </div>
        <div class="w-80 h-28 left-[24px] top-[604px] absolute bg-black/0 border-gray-200">
          <div class="w-80 h-80 left-0 top-[-397px] absolute bg-orange-50 rounded-2xl shadow-[0px_10px_15px_0px_rgba(0,0,0,0.10)] shadow-[0px_4px_6px_0px_rgba(0,0,0,0.10)] outline outline-2 outline-offset-[-2px] outline-yellow-100">
            <div class="w-72 left-[23px] top-[59px] absolute text-center justify-start text-black text-3xl font-light font-['Outfit']">Error en el registro</div>
            <div class="w-72 h-36 left-[21px] top-[145px] absolute text-center justify-start text-stone-700 text-xl font-light font-['Outfit']">{{ session('error_registro', 'Lo sentimos, hubo un error al completar el registro. Inténtalo de nuevo.') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection