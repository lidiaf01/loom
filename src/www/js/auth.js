/**
 * JavaScript para autenticación
 * Sprint 1 - Proyecto Loom
 * 
 * @author Lidia Artero Fernández
 */

document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // Formulario de registro - Paso 2
    // ============================================
    const formRegistro = document.getElementById('formRegistro');
    
    if (formRegistro) {
        // Validación en tiempo real del paso 2
        const campoClave = document.getElementById('clave');
        const campoConfirmar = document.getElementById('confirmar_clave');
        
        if (campoClave) {
            campoClave.addEventListener('blur', function() {
                const errorClave = validarClave(this.value);
                if (errorClave) {
                    mostrarError('clave', errorClave);
                } else {
                    limpiarError('clave');
                }
            });
        }
        
        if (campoConfirmar) {
            campoConfirmar.addEventListener('blur', function() {
                const clave = campoClave?.value || '';
                const errorConfirmar = validarConfirmarClave(clave, this.value);
                if (errorConfirmar) {
                    mostrarError('confirmar_clave', errorConfirmar);
                } else {
                    limpiarError('confirmar_clave');
                }
            });
        }
        
        // Validar confirmación de clave cuando cambia la clave
        if (campoClave && campoConfirmar) {
            campoClave.addEventListener('input', function() {
                if (campoConfirmar.value) {
                    const errorElement = document.getElementById('error_confirmar_clave');
                    let error = '';
                    if (typeof validarConfirmarClave === 'function') {
                        error = validarConfirmarClave(this.value, campoConfirmar.value);
                    }
                    if (errorElement) {
                        errorElement.textContent = error || '';
                    }
                }
            });
        }
        
        // Validación antes del envío (permitir envío normal del formulario)
        formRegistro.addEventListener('submit', function(e) {
            // Validar claves antes de enviar
            const clave = campoClave?.value || '';
            const confirmarClave = campoConfirmar?.value || '';
            
            let hayErrores = false;
            
            const errorClave = validarClave(clave);
            if (errorClave) {
                mostrarError('clave', errorClave);
                hayErrores = true;
            }
            
            const errorConfirmar = validarConfirmarClave(clave, confirmarClave);
            if (errorConfirmar) {
                mostrarError('confirmar_clave', errorConfirmar);
                hayErrores = true;
            }
            
            // Si hay errores, prevenir el envío para que el usuario los corrija
            if (hayErrores) {
                e.preventDefault();
                return false;
            }
            
            // Si no hay errores, permitir que el formulario se envíe normalmente
            // El servidor manejará la redirección al paso 3
        });
    }
    
    // ============================================
    // Formulario de login
    // ============================================
    const formLogin = document.getElementById('formLogin');
    
    if (formLogin) {
        // Validación en tiempo real
        const campoEmail = document.getElementById('email');
        const campoClave = document.getElementById('clave');
        
        if (campoEmail) {
            campoEmail.addEventListener('blur', function() {
                const error = validarEmail(this.value);
                const errorElement = document.getElementById('error_email');
                if (error) {
                    if (errorElement) errorElement.textContent = error;
                } else {
                    if (errorElement) errorElement.textContent = '';
                }
            });
        }
        
        if (campoClave) {
            campoClave.addEventListener('blur', function() {
                const errorElement = document.getElementById('error_clave');
                if (!this.value || this.value === '') {
                    if (errorElement) errorElement.textContent = 'La clave es requerida';
                } else {
                    if (errorElement) errorElement.textContent = '';
                }
            });
        }
        
        // Envío del formulario
        formLogin.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Limpiar errores manualmente
            const errores = document.querySelectorAll('.error-message');
            errores.forEach(error => {
                error.textContent = '';
            });
            
            if (typeof validarFormularioLogin === 'function' && !validarFormularioLogin()) {
                return;
            }
            
            const btnLogin = document.getElementById('btnLogin');
            const mensajeResultado = document.getElementById('mensajeResultado');
            
            btnLogin.disabled = true;
            btnLogin.textContent = 'Iniciando sesión...';
            
            // Crear FormData y asegurar que el campo se llame 'clave' y no 'contraseña'
            const formData = new FormData(formLogin);
            
            // IMPORTANTE: Asegurar que el campo de contraseña se llame 'clave'
            // Si existe un campo con nombre 'contraseña', cambiarlo a 'clave'
            const campoClave = formLogin.querySelector('[name="clave"]');
            const campoContraseña = formLogin.querySelector('[name="contraseña"]');
            
            if (campoContraseña) {
                // Si existe un campo con nombre 'contraseña', renombrarlo
                campoContraseña.setAttribute('name', 'clave');
                formData.delete('contraseña');
                formData.append('clave', campoContraseña.value);
            }
            
            // Verificar que el FormData tenga 'clave' y no 'contraseña'
            if (formData.has('contraseña')) {
                const valor = formData.get('contraseña');
                formData.delete('contraseña');
                formData.append('clave', valor);
            }
            
            // Obtener la URL del action del formulario
            const actionUrl = formLogin.getAttribute('action') || formLogin.action;
            
            // Debug: mostrar la URL que se está llamando
            console.log('URL del formulario (getAttribute):', formLogin.getAttribute('action'));
            console.log('URL del formulario (action):', formLogin.action);
            console.log('URL final:', actionUrl);
            console.log('Método:', formLogin.method);
            console.log('Datos del formulario:', Object.fromEntries(formData));
            
            // Si no hay action o es la misma página, usar la URL correcta
            const finalUrl = actionUrl && actionUrl !== window.location.href 
                ? actionUrl 
                : '/loom/controladores/auth_router.php';
            
            console.log('URL final a usar:', finalUrl);
            
            fetch(finalUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                console.log('Status:', response.status);
                console.log('Headers:', Object.fromEntries(response.headers.entries()));
                
                // Verificar si la respuesta es JSON
                const contentType = response.headers.get("content-type");
                console.log('Content-Type:', contentType);
                
                if (contentType && contentType.includes("application/json")) {
                    return response.json();
                } else {
                    // Si no es JSON, leer como texto para debug
                    return response.text().then(text => {
                        console.error('Respuesta no JSON (primeros 500 caracteres):', text.substring(0, 500));
                        throw new Error('Respuesta del servidor no es JSON: ' + text.substring(0, 200));
                    });
                }
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);  // Debug
                if (data && data.exito) {
                    // Mostrar mensaje
                    if (mensajeResultado) {
                        mensajeResultado.textContent = data.mensaje || 'Login exitoso';
                        mensajeResultado.className = 'mensaje-resultado mensaje-exito';
                        mensajeResultado.style.display = 'block';
                    }
                    
                    // Redirigir inmediatamente
                    const redirectUrl = data.redirect || '/loom/vistas/inicio/pantalla_principal.php';
                    console.log('Redirigiendo a:', redirectUrl);
                    window.location.href = redirectUrl;
                } else {
                    // Mostrar error
                    if (mensajeResultado) {
                        const mensajeError = (data && data.mensaje) || 'Error al iniciar sesión';
                        mensajeResultado.textContent = mensajeError;
                        mensajeResultado.className = 'mensaje-resultado mensaje-error';
                        mensajeResultado.style.display = 'block';
                        
                        // Si el mensaje menciona 'contraseña' o SQL, hacerlo más visible
                        if (mensajeError.includes('contraseña') || mensajeError.includes('ALTER TABLE')) {
                            mensajeResultado.style.background = '#fff3cd';
                            mensajeResultado.style.border = '2px solid #ffc107';
                            mensajeResultado.style.padding = '15px';
                            mensajeResultado.style.fontSize = '14px';
                            mensajeResultado.style.whiteSpace = 'pre-wrap';
                        }
                    }
                    btnLogin.disabled = false;
                    btnLogin.textContent = 'Iniciar sesión';
                }
            })
            .catch(error => {
                console.error('Error completo:', error);
                if (mensajeResultado) {
                    mensajeResultado.textContent = 'Error al iniciar sesión. Por favor, intenta de nuevo.';
                    mensajeResultado.className = 'mensaje-resultado mensaje-error';
                    mensajeResultado.style.display = 'block';
                }
                btnLogin.disabled = false;
                btnLogin.textContent = 'Iniciar sesión';
            });
        });
    }
});

