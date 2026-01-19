@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-orange-50 w-full flex justify-center relative overflow-hidden">
    <div class="w-96 min-h-screen relative overflow-y-scroll pb-32 scrollbar-hide">
        <div class="relative z-10 px-5 pt-12 space-y-4">
            <h1 class="text-stone-700 text-2xl font-bold font-['Outfit'] mb-6">Ajustes</h1>

            {{-- Acordeón: Cuenta --}}
            <div class="mb-6">
                <button type="button" class="w-full flex justify-between items-center py-4 border-b border-yellow-300 bg-yellow-50 focus:outline-none toggle-accordion">
                    <span class="text-yellow-700 text-lg font-semibold font-['Outfit']">Cuenta</span>
                    <span class="text-yellow-600 text-xl">&#9660;</span>
                </button>
                <div class="accordion-content px-4 pb-4 space-y-3 hidden">
                    <button type="button" onclick="showModal('changeAccount')" class="w-full text-left py-3 border-b border-yellow-200 bg-transparent text-yellow-700 font-medium transition">
                        Cambiar cuenta
                    </button>
                    <button type="button" onclick="showModal('logout')" class="w-full text-left py-3 border-b border-yellow-200 bg-transparent text-yellow-700 font-medium transition">
                        Cerrar sesión
                    </button>
                </div>
            </div>

            {{-- Acordeón: Seguridad --}}
            <div class="mb-6">
                <button type="button" class="w-full flex justify-between items-center py-4 border-b border-amber-300 bg-amber-50 focus:outline-none toggle-accordion">
                    <span class="text-amber-700 text-lg font-semibold font-['Outfit']">Seguridad</span>
                    <span class="text-amber-600 text-xl">&#9660;</span>
                </button>
                <div class="accordion-content px-4 pb-4 space-y-3 hidden">
                    <button type="button" class="w-full text-left py-3 border-b border-amber-200 bg-transparent text-amber-700 font-medium transition">
                        Cambiar contraseña
                    </button>
                    <button type="button" onclick="showModal('delete')" class="w-full text-left py-3 border-b border-amber-200 bg-transparent text-amber-700 font-medium transition">
                        Eliminar cuenta
                    </button>

                    <!-- Modal de confirmación -->
                    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-2xl shadow-xl p-8 w-96 text-center animate-fade-in">
                            <h2 id="modalTitle" class="text-xl font-bold mb-2 text-stone-700">¿Estás seguro?</h2>
                            <p id="modalText" class="mb-6 text-stone-600">Esta acción no se puede deshacer.</p>
                            <div class="flex justify-between gap-2">
                                <button onclick="hideModal()" class="px-6 py-2 rounded-xl bg-stone-200 text-stone-700 font-semibold hover:bg-yellow-100 hover:text-yellow-700 transition">Cancelar</button>
                                <form id="modalFormLogout" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                                <form id="modalFormDelete" method="POST" action="{{ route('cuenta.eliminar') }}" class="hidden">@csrf</form>
                                <button id="modalConfirmBtn" class="px-6 py-2 rounded-xl bg-red-500 text-white font-semibold hover:bg-red-600 transition">Confirmar</button>
                            </div>
                        </div>
                    </div>

                    <script>
                    window.showModal = function(type) {
                        document.getElementById('confirmModal').classList.remove('hidden');
                        if(type === 'logout') {
                            document.getElementById('modalTitle').textContent = '¿Cerrar sesión?';
                            document.getElementById('modalText').textContent = '¿Seguro que quieres cerrar sesión?';
                            document.getElementById('modalConfirmBtn').onclick = function() {
                                document.getElementById('modalFormLogout').submit();
                            };
                        } else if(type === 'delete') {
                            document.getElementById('modalTitle').textContent = '¿Eliminar cuenta?';
                            document.getElementById('modalText').textContent = '¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.';
                            document.getElementById('modalConfirmBtn').onclick = function() {
                                document.getElementById('modalFormDelete').submit();
                            };
                        } else if(type === 'changeAccount') {
                            document.getElementById('modalTitle').textContent = '¿Cambiar de cuenta?';
                            document.getElementById('modalText').textContent = 'Serás dirigido al inicio de sesión para cambiar de cuenta.';
                            document.getElementById('modalConfirmBtn').onclick = function() {
                                window.location.href = '{{ route('login') }}';
                            };
                        }
                    }
                    function hideModal() {
                        document.getElementById('confirmModal').classList.add('hidden');
                    }
                    </script>
                    </form>
                </div>
            </div>

            {{-- Acordeón: Personalización de perfil --}}
            <div class="mb-2">
                <button type="button" class="w-full flex justify-between items-center py-3 border-b border-stone-300 focus:outline-none toggle-accordion">
                    <span class="text-stone-700 text-lg font-semibold font-['Outfit']">Personalización de perfil</span>
                    <span class="text-stone-600 text-xl">&#9660;</span>
                </button>
                <div class="accordion-content pl-2 pr-2 pb-2 hidden">
                    <a href="#" class="block py-2 text-stone-700 hover:text-yellow-500 transition text-base">Personalizar perfil</a>
                    <form method="POST" action="#" class="mt-2">
                        @csrf
                        <label class="block text-stone-600 text-sm mb-2">Visibilidad de la cuenta</label>
                        <select name="visibilidad" class="w-full bg-stone-200 rounded-[20px] px-4 py-3 text-stone-700 text-base shadow-inner mb-2 border border-stone-400">
                            <option value="publica" {{ auth()->user()->visibilidad == 'publica' ? 'selected' : '' }}>Pública</option>
                            <option value="privada" {{ auth()->user()->visibilidad == 'privada' ? 'selected' : '' }}>Privada</option>
                        </select>
                    </form>
                </div>
            </div>

            </div>

            <!-- Modal de confirmación global -->
            <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                <div class="bg-white rounded-2xl shadow-xl p-8 w-96 text-center animate-fade-in">
                    <h2 id="modalTitle" class="text-xl font-bold mb-2 text-stone-700">¿Estás seguro?</h2>
                    <p id="modalText" class="mb-6 text-stone-600">Esta acción no se puede deshacer.</p>
                    <div class="flex justify-between gap-2">
                        <button onclick="hideModal()" class="px-6 py-2 rounded-xl bg-stone-200 text-stone-700 font-semibold hover:bg-yellow-100 hover:text-yellow-700 transition">Cancelar</button>
                        <form id="modalFormLogout" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                        <form id="modalFormDelete" method="POST" action="{{ route('cuenta.eliminar') }}" class="hidden">@csrf</form>
                        <button id="modalConfirmBtn" class="px-6 py-2 rounded-xl bg-red-500 text-white font-semibold hover:bg-red-600 transition">Confirmar</button>
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
                window.showModal = function(type) {
                    document.getElementById('confirmModal').classList.remove('hidden');
                    if(type === 'logout') {
                        document.getElementById('modalTitle').textContent = '¿Cerrar sesión?';
                        document.getElementById('modalText').textContent = '¿Seguro que quieres cerrar sesión?';
                        document.getElementById('modalConfirmBtn').onclick = function() {
                            document.getElementById('modalFormLogout').submit();
                        };
                    } else if(type === 'delete') {
                        document.getElementById('modalTitle').textContent = '¿Eliminar cuenta?';
                        document.getElementById('modalText').textContent = '¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.';
                        document.getElementById('modalConfirmBtn').onclick = function() {
                            document.getElementById('modalFormDelete').submit();
                        };
                    } else if(type === 'changeAccount') {
                        document.getElementById('modalTitle').textContent = '¿Cambiar de cuenta?';
                        document.getElementById('modalText').textContent = 'Serás dirigido al inicio de sesión para cambiar de cuenta.';
                        document.getElementById('modalConfirmBtn').onclick = function() {
                            window.location.href = '{{ route('login') }}';
                        };
                    }
                }
                window.hideModal = function() {
                    document.getElementById('confirmModal').classList.add('hidden');
                }
            });
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
                    <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center nav-indicator transition-colors duration-300">
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
