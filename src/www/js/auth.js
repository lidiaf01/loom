// Autenticación simplificada

document.addEventListener('DOMContentLoaded', function() {
    // Formulario de login
    const formLogin = document.getElementById('formLogin');
    if (formLogin) {
        formLogin.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('btnLogin');
            btn.disabled = true;
            btn.textContent = 'Procesando...';
            
            const formData = new FormData(formLogin);
            
            fetch(formLogin.action, {
                method: 'POST',
                body: formData
            })
            .then(async r => {
                const data = await r.json();
                if (!r.ok) {
                    return { error: true, status: r.status, ...data };
                }
                return data;
            })
            .then(data => {
                if (data.error) {
                    showToast(data.mensaje || 'Error del servidor', 'error', 'Error');
                    btn.disabled = false;
                    btn.textContent = 'Iniciar sesión';
                    return;
                }
                
                if (data.exito) {
                    showToast('Sesión iniciada correctamente', 'success', 'Éxito');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 500);
                } else {
                    showToast(data.mensaje || 'Error al iniciar sesión', 'error', 'Error');
                    btn.disabled = false;
                    btn.textContent = 'Iniciar sesión';
                }
            })
            .catch(e => {
                showToast('Error de conexión. Por favor, verifica tu conexión a internet.', 'error', 'Error de conexión');
                btn.disabled = false;
                btn.textContent = 'Iniciar sesión';
            });
        });
    }
    
    // Formulario de registro (solo para validación, no intercepta el envío)
    // El registro ahora funciona en 3 pasos, así que dejamos que el formulario se envíe normalmente
    const formRegistro = document.getElementById('formRegistro');
    if (formRegistro) {
        // Solo validar antes de enviar, pero permitir el envío normal del formulario
        formRegistro.addEventListener('submit', function(e) {
            // Validaciones básicas del lado del cliente
            const nombreUsuario = document.getElementById('nombre_usuario');
            const email = document.getElementById('email');
            const fechaNacimiento = document.getElementById('fecha_nacimiento');
            
            if (nombreUsuario && nombreUsuario.value.length < 3) {
                e.preventDefault();
                showToast('El nombre de usuario debe tener al menos 3 caracteres', 'error', 'Error de validación');
                return false;
            }
            
            if (email && !email.value.includes('@')) {
                e.preventDefault();
                showToast('Por favor, ingresa un email válido', 'error', 'Error de validación');
                return false;
            }
            
            if (fechaNacimiento && !fechaNacimiento.value) {
                e.preventDefault();
                showToast('Por favor, selecciona tu fecha de nacimiento', 'error', 'Error de validación');
                return false;
            }
            
            // Si todo está bien, permitir el envío normal del formulario
        });
    }
    
    // Botón logout
    const btnLogout = document.getElementById('btnLogout');
    if (btnLogout) {
        btnLogout.addEventListener('click', function(e) {
            e.preventDefault();
            showConfirmModal({
                title: 'Cerrar sesión',
                message: '¿Estás seguro de que deseas cerrar sesión?',
                confirmText: 'Cerrar sesión',
                cancelText: 'Cancelar',
                confirmClass: 'danger',
                onConfirm: function() {
                    const assetsUrl = window.ASSETS_URL || '/loom';
                    fetch(assetsUrl + '/src/www/controladores/auth_router.php?action=logout', {
                        method: 'POST'
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.exito) {
                            showToast('Sesión cerrada correctamente', 'success', 'Sesión cerrada');
                            setTimeout(() => {
                                const assetsUrl = window.ASSETS_URL || '/loom';
                                window.location.href = data.redirect || assetsUrl + '/?page=inicio';
                            }, 500);
                        } else {
                            showToast('Error al cerrar sesión', 'error', 'Error');
                        }
                    })
                    .catch(e => {
                        showToast('Error de conexión', 'error', 'Error');
                    });
                },
                onCancel: function() {
                    // No hacer nada
                }
            });
        });
    }
});

