/**
 * Script para aplicar fuente de números a elementos que contienen números
 * Detecta elementos con números y les aplica la fuente del sistema
 */

(function() {
    'use strict';
    
    const fontNumeros = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
    
    // Función para detectar si un elemento contiene principalmente números
    function contienePrincipalmenteNumeros(texto) {
        if (!texto) return false;
        const textoLimpio = texto.trim();
        if (textoLimpio.length === 0) return false;
        
        // Contar dígitos y caracteres
        const digitos = (textoLimpio.match(/\d/g) || []).length;
        const letras = (textoLimpio.match(/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/g) || []).length;
        
        // Si tiene más dígitos que letras, o si es principalmente numérico
        return digitos > letras || (digitos > 0 && letras === 0) || /^\d+/.test(textoLimpio);
    }
    
    // Función para aplicar fuente de números
    function aplicarFuenteNumeros() {
        // Aplicar a elementos específicos conocidos
        const selectores = [
            '.dashboard-day-badge',
            '.dashboard-progress-percentage',
            '.dashboard-progress-text',
            '[class*="badge"]',
            '[class*="percentage"]',
            '[class*="number"]',
            '[class*="count"]',
            '[class*="day"]',
            '[class*="date"]',
            '[class*="time"]'
        ];
        
        selectores.forEach(selector => {
            try {
                const elementos = document.querySelectorAll(selector);
                elementos.forEach(el => {
                    // Evitar aplicar a iconos y botones
                    if (!el.closest('[class*="icon"]') && 
                        !el.closest('button') && 
                        !el.closest('a[class*="btn"]')) {
                        el.style.fontFamily = fontNumeros;
                        el.style.fontVariantNumeric = 'normal';
                    }
                });
            } catch (e) {
                // Ignorar errores de selectores inválidos
            }
        });
        
        // Aplicar a elementos que contienen principalmente números
        const todosLosElementos = document.querySelectorAll('span, div, p, h1, h2, h3, h4, h5, h6, td, th, li');
        todosLosElementos.forEach(el => {
            // Solo aplicar si no tiene clase de fuente ya aplicada
            if (!el.classList.contains('font-numeros') && 
                !el.classList.contains('numeros') &&
                !el.closest('[class*="icon"]') &&
                !el.closest('button') &&
                !el.closest('a[class*="btn"]')) {
                
                const texto = el.textContent || el.innerText;
                if (contienePrincipalmenteNumeros(texto)) {
                    el.style.fontFamily = fontNumeros;
                    el.style.fontVariantNumeric = 'normal';
                }
            }
        });
    }
    
    // Ejecutar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', aplicarFuenteNumeros);
    } else {
        aplicarFuenteNumeros();
    }
    
    // Re-ejecutar cuando se agreguen nuevos elementos (para contenido dinámico)
    const observer = new MutationObserver(function(mutations) {
        let shouldReapply = false;
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length > 0) {
                shouldReapply = true;
            }
        });
        if (shouldReapply) {
            setTimeout(aplicarFuenteNumeros, 100);
        }
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
})();


