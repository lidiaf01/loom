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
    <main class="w-full h-full">
        @yield('content')
    </main>

    {{-- Toast notification --}}
    @component('components.toast') @endcomponent

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
</body>
</html>