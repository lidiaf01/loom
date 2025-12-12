/**
 * Módulo JavaScript para Perfil - Solo funciones UI/decorativas
 * Separación Frontend/Backend
 */

// Configuración de URLs (se inyecta desde PHP)
const PERFIL_CONFIG = {
    assetsUrl: window.ASSETS_URL || '/loom',
    routerUrl: null, // Se inicializa en initPerfil
    authRouterUrl: null
};

/**
 * Inicializa el módulo de perfil
 */
function initPerfil() {
    if (typeof ASSETS_URL !== 'undefined') {
        PERFIL_CONFIG.assetsUrl = ASSETS_URL;
    }
    PERFIL_CONFIG.routerUrl = PERFIL_CONFIG.assetsUrl + '/src/www/controladores/perfil_router.php';
    PERFIL_CONFIG.authRouterUrl = PERFIL_CONFIG.assetsUrl + '/src/www/controladores/auth_router.php';
}

/**
 * Cierra sesión desde el perfil (solo UI)
 * La lógica real está en PHP
 */
function cerrarSesionPerfil() {
    if (typeof showConfirmModal !== 'function') {
        // Fallback si no está disponible el modal
        if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
            ejecutarCerrarSesion();
        }
        return;
    }

    showConfirmModal({
        title: 'Cerrar sesión',
        message: '¿Estás seguro de que quieres cerrar sesión?',
        confirmText: 'Cerrar sesión',
        cancelText: 'Cancelar',
        confirmClass: 'danger',
        onConfirm: function() {
            ejecutarCerrarSesion();
        },
        onCancel: function() {
            // No hacer nada si cancela
        }
    });
}

/**
 * Ejecuta el cierre de sesión (comunicación con backend)
 */
function ejecutarCerrarSesion() {
    fetch(PERFIL_CONFIG.authRouterUrl + '?action=logout', {
        method: 'POST',
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (data.exito) {
            if (typeof showToast === 'function') {
                showToast('Sesión cerrada correctamente', 'success', 'Sesión cerrada');
            }
            
            setTimeout(() => {
                window.location.href = data.redirect || PERFIL_CONFIG.assetsUrl + '/?page=inicio';
            }, 500);
        } else {
            if (typeof showToast === 'function') {
                showToast(data.mensaje || 'Error al cerrar sesión', 'error', 'Error');
            } else {
                alert('Error: ' + (data.mensaje || 'Error al cerrar sesión'));
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
 * Maneja el envío del formulario de editar perfil (solo UI)
 */
function manejarFormularioEditarPerfil() {
    const form = document.getElementById('formEditarPerfil');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btnSubmit = form.querySelector('button[type="submit"]');
        const textoOriginal = btnSubmit ? btnSubmit.textContent : 'Guardar';
        
        // Deshabilitar botón
        if (btnSubmit) {
            btnSubmit.disabled = true;
            btnSubmit.textContent = 'Guardando...';
        }

        const formData = new FormData(form);
        formData.append('actualizar_perfil', '1');

        fetch(form.action, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                if (typeof showToast === 'function') {
                    showToast(data.mensaje || 'Perfil actualizado correctamente', 'success', 'Éxito');
                } else {
                    alert(data.mensaje || 'Perfil actualizado correctamente');
                }
                
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            } else {
                if (typeof showToast === 'function') {
                    showToast(data.mensaje || 'Error al actualizar perfil', 'error', 'Error');
                } else {
                    alert('Error: ' + (data.mensaje || 'Error al actualizar perfil'));
                }
                
                if (btnSubmit) {
                    btnSubmit.disabled = false;
                    btnSubmit.textContent = textoOriginal;
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
            
            if (btnSubmit) {
                btnSubmit.disabled = false;
                btnSubmit.textContent = textoOriginal;
            }
        });
    });
}

/**
 * Maneja la subida de foto de perfil (solo UI)
 */
function manejarSubidaFoto() {
    const inputFoto = document.getElementById('foto_perfil');
    if (!inputFoto) return;

    inputFoto.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Validación básica de tipo de archivo
        const tiposPermitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!tiposPermitidos.includes(file.type)) {
            if (typeof showToast === 'function') {
                showToast('Por favor, selecciona una imagen válida (JPG, PNG, GIF o WEBP)', 'error', 'Error');
            } else {
                alert('Por favor, selecciona una imagen válida');
            }
            e.target.value = '';
            return;
        }

        // Validación de tamaño (máximo 5MB)
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            if (typeof showToast === 'function') {
                showToast('La imagen es demasiado grande. Máximo 5MB', 'error', 'Error');
            } else {
                alert('La imagen es demasiado grande. Máximo 5MB');
            }
            e.target.value = '';
            return;
        }

        // Mostrar preview
        const preview = document.getElementById('preview_foto');
        if (preview) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">';
            };
            reader.readAsDataURL(file);
        }
    });
}

/**
 * Maneja el envío del formulario de subida de foto (solo UI)
 */
function manejarFormularioSubidaFoto() {
    const form = document.getElementById('formSubirFoto');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btnSubmit = form.querySelector('button[type="submit"]');
        const textoOriginal = btnSubmit ? btnSubmit.textContent : 'Subir foto';
        
        // Deshabilitar botón
        if (btnSubmit) {
            btnSubmit.disabled = true;
            btnSubmit.textContent = 'Subiendo...';
        }

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.exito) {
                if (typeof showToast === 'function') {
                    showToast(data.mensaje || 'Foto subida correctamente', 'success', 'Éxito');
                } else {
                    alert(data.mensaje || 'Foto subida correctamente');
                }
                
                if (data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            } else {
                if (typeof showToast === 'function') {
                    showToast(data.mensaje || 'Error al subir foto', 'error', 'Error');
                } else {
                    alert('Error: ' + (data.mensaje || 'Error al subir foto'));
                }
                
                if (btnSubmit) {
                    btnSubmit.disabled = false;
                    btnSubmit.textContent = textoOriginal;
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
            
            if (btnSubmit) {
                btnSubmit.disabled = false;
                btnSubmit.textContent = textoOriginal;
            }
        });
    });
}

/**
 * Inicializa el contador de biografía
 */
function initContadorBiografia() {
    const biografiaInput = document.getElementById('biografia');
    const contador = document.getElementById('contador_biografia');
    
    if (biografiaInput && contador) {
        // Actualizar contador
        function actualizarContador() {
            contador.textContent = biografiaInput.value.length + '/500';
        }
        
        // Inicializar
        actualizarContador();
        
        // Escuchar cambios
        biografiaInput.addEventListener('input', actualizarContador);
    }
}

/**
 * Muestra un mensaje del perfil usando toasts
 */
function mostrarMensajePerfil(mensaje, tipo = 'info', titulo = null) {
    if (typeof showToast === 'function') {
        showToast(mensaje, tipo, titulo);
    } else {
        alert(mensaje);
    }
}

/**
 * Inicializa los event listeners para el perfil
 */
function initEventListenersPerfil() {
    // Botón de cerrar sesión en el perfil
    const btnLogout = document.getElementById('btnLogoutPerfil');
    if (btnLogout) {
        btnLogout.addEventListener('click', function(e) {
            e.preventDefault();
            cerrarSesionPerfil();
        });
    }
}

// Inicializar cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        initPerfil();
        manejarFormularioEditarPerfil();
        manejarSubidaFoto();
        manejarFormularioSubidaFoto();
        initContadorBiografia();
        initEventListenersPerfil();
    });
} else {
    initPerfil();
    manejarFormularioEditarPerfil();
    manejarSubidaFoto();
    manejarFormularioSubidaFoto();
    initContadorBiografia();
    initEventListenersPerfil();
}

