@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">
        {{-- Círculos decorativos --}}
        <div class="absolute w-96 h-96 bg-amber-200 rounded-full opacity-60 blur-2xl blob-float" style="top: 120px; left: 250px;"></div>
        <div class="absolute w-72 h-72 bg-pink-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 300px; left: -30px;"></div>
        <div class="absolute w-80 h-80 bg-teal-200 rounded-full opacity-55 blur-2xl blob-float-3" style="top: 500px; left: 280px;"></div>
        <div class="absolute w-64 h-64 bg-indigo-100 rounded-full opacity-60 blur-2xl blob-float" style="top: 700px; left: -15px;"></div>
        <div class="absolute w-[14rem] h-[14rem] bg-lime-200 rounded-full opacity-58 blur-2xl blob-float-2" style="top: 280px; left: 320px;"></div>

        <div class="relative z-10 px-5 pt-12 space-y-4">
            <h1 class="text-stone-700 text-2xl font-bold font-['Outfit'] mb-6">Ajustes</h1>

            {{-- Acordeón: Cuenta --}}
            <div class="mb-6">
                <button type="button" class="w-full flex justify-between items-center py-4 border-b border-yellow-300 focus:outline-none toggle-accordion">
                    <span class="text-pink-500 text-lg font-semibold font-['Outfit']">Cuenta</span>
                    <span class="text-pink-400 text-xl">&#9660;</span>
                </button>
                <div class="accordion-content px-4 pb-4 space-y-3 hidden">
                    <form method="POST" action="{{ route('ajustes.cambiarCuenta') }}" data-confirm="¿Seguro que quieres cambiar de cuenta? Se cerrará tu sesión actual.">
                        @csrf
                        <button type="submit" class="w-full text-left py-3 border-b border-yellow-200 bg-transparent text-pink-500 font-medium transition">Cambiar cuenta</button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" data-confirm="¿Seguro que quieres cerrar sesión?">
                        @csrf
                        <button type="submit" class="w-full text-left py-3 border-b border-yellow-200 bg-transparent text-pink-500 font-medium transition">Cerrar sesión</button>
                    </form>
                </div>
            </div>

            {{-- Acordeón: Seguridad --}}
            <div class="mb-6">
                <button type="button" class="w-full flex justify-between items-center py-4 border-b border-amber-300 focus:outline-none toggle-accordion">
                    <span class="text-pink-500 text-lg font-semibold font-['Outfit']">Seguridad</span>
                    <span class="text-pink-400 text-xl">&#9660;</span>
                </button>
                <div class="accordion-content px-4 pb-4 space-y-3 hidden">
                    <button type="button" class="w-full text-left py-3 border-b border-amber-200 bg-transparent text-pink-500 font-medium transition" onclick="openPasswordModal()">
                        Cambiar contraseña
                    </button>
                    <form method="POST" action="{{ route('ajustes.eliminarCuenta') }}" data-confirm="¿Seguro que quieres eliminar tu cuenta? Esta acción es irreversible y eliminará todos tus datos.">
                        @csrf
                        <button type="submit" class="w-full text-left py-3 border-b border-amber-200 bg-transparent text-pink-500 font-medium transition">Eliminar cuenta</button>
                    </form>

                    <!-- ...existing code... -->
                </div>
            </div>

            {{-- Acordeón: Personalización de perfil --}}
            <div class="mb-2">
                <button type="button" class="w-full flex justify-between items-center py-3 border-b border-stone-300 focus:outline-none toggle-accordion">
                    <span class="text-pink-500 text-lg font-semibold font-['Outfit']">Personalización de perfil</span>
                    <span class="text-pink-400 text-xl">&#9660;</span>
                </button>
                <div class="accordion-content pl-2 pr-2 pb-2 hidden">
                    <button type="button" class="block py-2 text-pink-500 hover:text-pink-400 transition text-base w-full text-left" onclick="openProfileModal()">Personalizar perfil</button>
                    <form method="POST" action="{{ route('ajustes.cambiarVisibilidad') }}" class="mt-4">
                        @csrf
                        <label class="block text-pink-400 text-sm mb-2">Visibilidad de la cuenta</label>
                        <select name="visibilidad" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-pink-500 text-base shadow-inner mb-2 border border-stone-400">
                            <option value="publica" {{ auth()->user()->visibilidad == 'publica' ? 'selected' : '' }}>Pública</option>
                            <option value="privada" {{ auth()->user()->visibilidad == 'privada' ? 'selected' : '' }}>Privada</option>
                        </select>
                        <label class="block text-pink-400 text-sm mb-2 mt-4">Privacidad del diario</label>
                        <div class="flex items-center gap-2 mb-2">
                            <input type="checkbox" name="diario_privado" value="1" id="diario_privado" {{ auth()->user()->diario_privado ? 'checked' : '' }}>
                            <label for="diario_privado" class="text-pink-500 text-sm">Diario privado</label>
                        </div>
                        <div class="text-xs text-gray-500 mb-2">Si está activado, solo tú puedes ver tu diario. Si está desactivado, otros podrán leerlo desde tu perfil.</div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-3 bg-gradient-to-br from-yellow-100 to-pink-300 rounded-2xl border border-amber-300 shadow-md text-pink-600 text-sm font-['Outfit'] hover:scale-105 hover:-translate-y-1 transition-all duration-300">Actualizar privacidad</button>
                        </div>
                    </form>
                </div>

            <!-- Modal de personalización de perfil -->
            <div id="profile-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] hidden items-center justify-center px-4 opacity-0 transition-opacity duration-300">
                <div class="bg-white rounded-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.35)] border-2 border-stone-200 p-6 max-w-sm w-full transform scale-95 opacity-0 transition-all duration-300" id="profile-modal-content">
                    <form id="profile-form" method="POST" action="{{ route('ajustes.actualizarPerfil') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
                        @csrf
                        <h3 class="text-stone-700 text-lg font-semibold font-['Outfit'] mb-2">Personalizar perfil</h3>
                        <label class="block text-pink-400 text-sm mb-1">Nombre de usuario</label>
                        <input type="text" name="nombre" value="{{ old('nombre', auth()->user()->nombre) }}" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-pink-500 text-base shadow-inner border border-stone-400 mb-2">

                        <label class="block text-pink-400 text-sm mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-pink-500 text-base shadow-inner border border-stone-400 mb-2">

                        <label class="block text-pink-400 text-sm mb-1">Foto de perfil</label>
                        <input type="file" name="foto" accept="image/*" class="w-full bg-stone-200 rounded-[20px] px-4 py-2 text-pink-500 text-base shadow-inner border border-stone-400 mb-2">
                        @if(auth()->user()->foto_perfil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_perfil) }}" alt="Foto actual" class="w-64 h-64 rounded-full object-cover mb-2">
                        @else
                            <img src="{{ asset('images/default-profile.svg') }}" alt="Foto predeterminada" class="w-64 h-64 rounded-full object-cover mb-2 bg-white">
                        @endif

                        <label class="block text-pink-400 text-sm mb-1">Biografía (texto o enlace)</label>
                        <textarea name="biografia" rows="2" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-pink-500 text-base shadow-inner border border-stone-400 mb-2">{{ old('biografia', auth()->user()->biografia) }}</textarea>

                        <div class="flex gap-3 mt-2">
                            <button type="button" class="flex-1 px-4 py-3 bg-stone-200 hover:bg-stone-300 rounded-2xl border border-stone-300 text-stone-700 text-sm font-semibold font-['Outfit'] transition-all duration-300 hover:scale-105" onclick="closeProfileModal()">Cancelar</button>
                            <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-br from-yellow-100 to-pink-300 rounded-2xl border border-amber-300 shadow-md text-pink-600 text-sm font-['Outfit'] hover:scale-105 hover:-translate-y-1 transition-all duration-300">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>

            </div>


            <!-- Modal de cambio de contraseña -->
            <div id="password-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] hidden items-center justify-center px-4 opacity-0 transition-opacity duration-300">
                <div class="bg-white rounded-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.35)] border-2 border-stone-200 p-6 max-w-sm w-full transform scale-95 opacity-0 transition-all duration-300" id="password-modal-content">
                    <form id="password-form" method="POST" action="{{ route('ajustes.cambiarContrasena') }}" class="flex flex-col gap-4">
                        @csrf
                        <h3 class="text-stone-700 text-lg font-semibold font-['Outfit'] mb-2">Cambiar contraseña</h3>
                        <div id="password-step-actual">
                            <label class="block text-stone-600 text-sm mb-2">Contraseña actual</label>
                            <input type="password" name="actual" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-base shadow-inner border border-stone-400 mb-2" required autocomplete="current-password">
                        </div>
                        <div id="password-step-nueva" style="display:none;">
                            <label class="block text-stone-600 text-sm mb-2">Nueva contraseña</label>
                            <input type="password" name="nueva" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-base shadow-inner border border-stone-400 mb-2" autocomplete="new-password">
                            <label class="block text-stone-600 text-sm mb-2">Confirmar nueva contraseña</label>
                            <input type="password" name="nueva_confirmation" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-base shadow-inner border border-stone-400 mb-2" autocomplete="new-password">
                        </div>
                        <div class="flex gap-3 mt-2">
                            <button type="button" class="flex-1 px-4 py-3 bg-stone-200 hover:bg-stone-300 rounded-2xl border border-stone-300 text-stone-700 text-sm font-semibold font-['Outfit'] transition-all duration-300 hover:scale-105" onclick="closePasswordModal()">Cancelar</button>
                            <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-br from-emerald-200 to-green-200 hover:from-emerald-300 hover:to-green-400 rounded-2xl border border-emerald-300 text-stone-700 text-sm font-semibold font-['Outfit'] transition-all duration-300 hover:scale-105 shadow-md" id="password-next-btn">Siguiente</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
            // Acordeón
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.toggle-accordion').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const content = btn.parentElement.querySelector('.accordion-content');
                        if (content) content.classList.toggle('hidden');
                    });
                });
            });

            // Modal de cambio de contraseña
            function openPasswordModal() {
                const modal = document.getElementById('password-modal');
                const content = document.getElementById('password-modal-content');
                document.getElementById('password-step-actual').style.display = '';
                document.getElementById('password-step-nueva').style.display = 'none';
                document.getElementById('password-next-btn').textContent = 'Siguiente';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
            function closePasswordModal() {
                const modal = document.getElementById('password-modal');
                const content = document.getElementById('password-modal-content');
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            }
            // Lógica de pasos para cambio de contraseña
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('password-form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const stepActual = document.getElementById('password-step-actual');
                        const stepNueva = document.getElementById('password-step-nueva');
                        const nextBtn = document.getElementById('password-next-btn');
                        if (stepActual.style.display !== 'none') {
                            e.preventDefault();
                            // Aquí deberías hacer una petición AJAX para validar la contraseña actual
                            // Por ahora, simplemente pasamos al siguiente paso
                            stepActual.style.display = 'none';
                            stepNueva.style.display = '';
                            nextBtn.textContent = 'Cambiar';
                        }
                    });
                }
                // Modal de personalización de perfil
                const profileBtn = document.querySelector('button[onclick="openProfileModal()"]');
                if (profileBtn) {
                    profileBtn.addEventListener('click', openProfileModal);
                }
            });

            function openProfileModal() {
                const modal = document.getElementById('profile-modal');
                const content = document.getElementById('profile-modal-content');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
            function closeProfileModal() {
                const modal = document.getElementById('profile-modal');
                const content = document.getElementById('profile-modal-content');
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            }
            </script>
        </div>

        {{-- Bottom Navigation --}}
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-96 bg-white rounded-t-3xl shadow-[0px_25px_50px_0px_rgba(0,0,0,0.25)] z-50">
            <div class="px-4 py-4 flex justify-around">
                {{-- Principal --}}
                <a href="{{ route('home') }}" data-route="home" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Principal</span>
                </a>
                {{-- Buscar --}}
                <a href="{{ route('buscar') }}" data-route="search" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15.5 1h-8C6.12 1 5 2.12 5 3.5v17C5 21.88 6.12 23 7.5 23h8c1.38 0 2.5-1.12 2.5-2.5v-17C18 2.12 16.88 1 15.5 1zm-4 21c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm4.5-4H7V4h9v14z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Buscar</span>
                </a>
                {{-- Ajustes --}}
                <a href="{{ route('ajustes') }}" data-route="settings" class="nav-link flex flex-col items-center gap-1 transition-all duration-300 active">
                    <div class="w-12 h-12 bg-yellow-200 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.64l-1.92-3.32c-.12-.22-.39-.3-.61-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.23-.09-.49 0-.61.22L2.74 8.87c-.12.22-.07.49.12.64l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.64l1.92 3.32c.12.22.39.3.61.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17 .47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39 .96c.23 .09 .49 0 .61-.22l1.92-3.32c.12-.22 .07-.49-.12-.64l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600 text-xs font-normal font-['Outfit']">Ajustes</span>
                </a>
                {{-- Perfil --}}
                <a href="{{ route('profile') }}" data-route="profile" class="nav-link flex flex-col items-center gap-1 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
                        <svg class="w-5 h-5 text-stone-600/60" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <span class="text-stone-600/60 text-xs font-normal font-['Outfit']">Perfil</span>
                </a>
            </div>
        </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-accordion').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const content = btn.parentElement.querySelector('.accordion-content');
            content.classList.toggle('hidden');
        });
    });
});
</script>
@endsection
