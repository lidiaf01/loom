/**
 * Navigation and Content Switching
 * Maneja la detección de página activa y animaciones del navbar
 */

document.addEventListener('DOMContentLoaded', function() {
    // Detectar la ruta actual
    const currentPath = window.location.pathname;
    updateActiveNav(currentPath);

    /**
     * Actualizar el estado activo del navbar
     */
    function updateActiveNav(path) {
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            const indicator = link.querySelector('.nav-indicator');
            const svg = link.querySelector('svg');
            const span = link.querySelector('span');
            const route = link.getAttribute('data-route');
            
            // Determinar si este link es el activo
            let isActive = false;
            if (route === 'home' && (path === '/home' || path === '/' || path === '/inicio')) {
                isActive = true;
            } else if (route === 'profile' && (path === '/perfil' || path.startsWith('/usuarios/'))) {
                isActive = true;
            } else if (route === 'search' && path.startsWith('/buscar')) {
                isActive = true;
            } else if (route === 'settings' && path.startsWith('/ajustes')) {
                isActive = true;
            }
            
            // Actualizar estilos
            if (isActive) {
                indicator.classList.add('bg-yellow-100');
                indicator.classList.remove('bg-white/0');
                svg.classList.add('text-stone-600');
                svg.classList.remove('text-stone-600/60');
                span.classList.add('text-stone-600');
                span.classList.remove('text-stone-600/60');
            } else {
                indicator.classList.remove('bg-yellow-100');
                indicator.classList.add('bg-white/0');
                svg.classList.remove('text-stone-600');
                svg.classList.add('text-stone-600/60');
                span.classList.remove('text-stone-600');
                span.classList.add('text-stone-600/60');
            }
        });
    }
});
