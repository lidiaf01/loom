/**
 * Configuración global de la aplicación
 * Inyecta variables desde PHP sin mezclar lenguajes
 */

// Esta variable se inyecta desde el header.php mediante un data attribute
(function() {
    'use strict';
    
    // Obtener ASSETS_URL del data attribute del body
    const body = document.body;
    if (body && body.dataset.assetsUrl) {
        window.ASSETS_URL = body.dataset.assetsUrl;
    } else {
        // Fallback si no está disponible
        window.ASSETS_URL = '/loom';
    }
})();

