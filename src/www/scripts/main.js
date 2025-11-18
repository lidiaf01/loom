/**
 * JavaScript principal - Proyecto Loom
 * Sprint 1
 * 
 * @author Lidia Artero Fernández
 */

// ============================================
// Utilidades generales
// ============================================

/**
 * Muestra un mensaje de resultado
 */
function mostrarMensaje(elemento, mensaje, tipo = 'error') {
    if (!elemento) return;
    
    elemento.textContent = mensaje;
    elemento.className = `mensaje-resultado mensaje-${tipo}`;
    elemento.style.display = 'block';
    
    // Ocultar después de 5 segundos
    if (tipo === 'exito') {
        setTimeout(() => {
            elemento.style.display = 'none';
        }, 5000);
    }
}

/**
 * Limpia mensajes de error
 */
function limpiarErrores() {
    const errores = document.querySelectorAll('.error-message');
    errores.forEach(error => {
        error.textContent = '';
    });
}

/**
 * Muestra error en un campo específico
 */
function mostrarError(campoId, mensaje) {
    const errorElement = document.getElementById(`error_${campoId}`);
    if (errorElement) {
        errorElement.textContent = mensaje;
    }
}

/**
 * Limpia error de un campo específico
 */
function limpiarError(campoId) {
    const errorElement = document.getElementById(`error_${campoId}`);
    if (errorElement) {
        errorElement.textContent = '';
    }
}

// ============================================
// Logout
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const btnLogout = document.getElementById('btnLogout');
    
    if (btnLogout) {
        btnLogout.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                fetch('/loom/controladores/auth_router.php?action=logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exito) {
                        window.location.href = data.redirect || '/loom/';
                    } else {
                        alert('Error al cerrar sesión: ' + data.mensaje);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cerrar sesión');
                });
            }
        });
    }
});

