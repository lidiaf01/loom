<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loom - Red Social</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body class="bg-orange-50 min-h-screen antialiased">
    <!-- Fondo decorativo global -->
    <div class="fixed inset-0 -z-10 pointer-events-none select-none">
        <div class="absolute w-64 h-64 bg-rose-200 rounded-full opacity-50 blur-xl blob-float" style="top: 10vh; left: 75vw;"></div>
        <div class="absolute w-56 h-56 bg-yellow-200 rounded-full opacity-55 blur-xl blob-float-2" style="top: 25vh; left: 8vw;"></div>
        <div class="absolute w-72 h-72 bg-sky-200 rounded-full opacity-50 blur-xl blob-float-3" style="top: 50vh; left: 70vw;"></div>
        <div class="absolute w-52 h-52 bg-emerald-100 rounded-full opacity-60 blur-xl blob-float" style="top: 75vh; left: 12vw;"></div>
        <div class="absolute w-60 h-60 bg-violet-200 rounded-full opacity-55 blur-xl blob-float-2" style="top: 40vh; left: 45vw;"></div>
        <div class="absolute w-48 h-48 bg-pink-200 rounded-full opacity-60 blur-xl blob-float-3" style="top: 15vh; left: 30vw;"></div>
    </div>
    <main class="w-full h-full">
        @yield('content')
    </main>

    {{-- Navbar global solo si está autenticado --}}
    @auth
        @include('layouts.navbar')
    @endauth

    {{-- Toast notification --}}
    @component('components.toast') @endcomponent

    {{-- Modal personalizado --}}
    @component('components.modal') @endcomponent

    {{-- Script para activar nav según página --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentRoute = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                const dataRoute = link.getAttribute('data-route');
                
                // Determinar si este link es el activo
                let isActive = false;
                
                if (dataRoute === 'home' && (currentRoute === '/home' || currentRoute === '/inicio' || currentRoute === '/')) {
                    isActive = true;
                } else if (dataRoute === 'profile' && (currentRoute === '/perfil' || currentRoute.startsWith('/usuarios/'))) {
                    isActive = true;
                } else if (dataRoute === 'search' && currentRoute.startsWith('/buscar')) {
                    isActive = true;
                } else if (dataRoute === 'settings' && currentRoute.startsWith('/ajustes')) {
                    isActive = true;
                }
                
                // Agregar o remover clase active
                if (isActive) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>