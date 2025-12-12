/**
 * Módulo JavaScript para Diario - Solo funciones UI/decorativas
 * Separación Frontend/Backend
 */

// Configuración de URLs (se inyecta desde PHP)
const DIARIO_CONFIG = {
    assetsUrl: window.ASSETS_URL || '/loom',
    routerUrl: null // Se inicializa en initDiario
};

/**
 * Inicializa el módulo de diario
 */
function initDiario() {
    if (typeof ASSETS_URL !== 'undefined') {
        DIARIO_CONFIG.assetsUrl = ASSETS_URL;
    }
    DIARIO_CONFIG.routerUrl = DIARIO_CONFIG.assetsUrl + '/src/www/controladores/diario_router.php';
}

/**
 * Elimina una entrada del diario (solo UI)
 * La lógica real está en PHP
 */
function eliminarEntradaDiario(id) {
    if (typeof showConfirmModal !== 'function') {
        // Fallback si no está disponible el modal
        if (confirm('¿Estás seguro de que quieres eliminar esta entrada? Esta acción no se puede deshacer.')) {
            ejecutarEliminacionEntrada(id);
        }
        return;
    }

    showConfirmModal({
        title: 'Eliminar entrada',
        message: '¿Estás seguro de que quieres eliminar esta entrada? Esta acción no se puede deshacer.',
        confirmText: 'Eliminar',
        cancelText: 'Cancelar',
        confirmClass: 'danger',
        onConfirm: function() {
            ejecutarEliminacionEntrada(id);
        },
        onCancel: function() {
            // No hacer nada si cancela
        }
    });
}

/**
 * Ejecuta la eliminación de la entrada (comunicación con backend)
 */
function ejecutarEliminacionEntrada(id) {
    const formData = new FormData();
    formData.append('id', id);

    fetch(DIARIO_CONFIG.routerUrl + '?action=eliminar', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.exito) {
            if (typeof showToast === 'function') {
                showToast(data.mensaje || 'Entrada eliminada correctamente', 'success', 'Éxito');
            } else {
                alert(data.mensaje || 'Entrada eliminada correctamente');
            }
            
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 500);
            } else {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            }
        } else {
            if (typeof showToast === 'function') {
                showToast(data.mensaje || 'Error al eliminar entrada', 'error', 'Error');
            } else {
                alert('Error: ' + (data.mensaje || 'Error al eliminar entrada'));
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (typeof showToast === 'function') {
            showToast('Error de conexión. Por favor, verifica tu conexión a internet.', 'error', 'Error de conexión');
        } else {
            alert('Error de conexión');
        }
    });
}

/**
 * Muestra un mensaje del diario usando toasts
 */
function mostrarMensajeDiario(mensaje, tipo = 'info', titulo = null) {
    if (typeof showToast === 'function') {
        showToast(mensaje, tipo, titulo);
    } else {
        alert(mensaje);
    }
}

/**
 * Inicializa el contador de caracteres del título
 */
function initContadorTitulo() {
    const tituloInput = document.getElementById('titulo');
    const contador = document.getElementById('contador_titulo');
    
    if (tituloInput && contador) {
        // Actualizar contador
        function actualizarContador() {
            contador.textContent = tituloInput.value.length + '/100';
        }
        
        // Inicializar
        actualizarContador();
        
        // Escuchar cambios
        tituloInput.addEventListener('input', actualizarContador);
    }
}

/**
 * Inicializa los event listeners para botones de eliminar
 */
function initEventListenersDiario() {
    // Event listeners para botones de eliminar
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-eliminar-entrada') || 
            e.target.closest('.btn-eliminar-entrada')) {
            e.preventDefault();
            const btn = e.target.classList.contains('btn-eliminar-entrada') 
                ? e.target 
                : e.target.closest('.btn-eliminar-entrada');
            const id = btn.dataset.id;
            if (id) {
                eliminarEntradaDiario(parseInt(id, 10));
            }
        }
    });
}

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        initDiario();
        initContadorTitulo();
        initEventListenersDiario();
    });
} else {
    initDiario();
    initContadorTitulo();
    initEventListenersDiario();
}

