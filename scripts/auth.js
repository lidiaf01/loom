/**
 * JavaScript para autenticación
 * Sprint 1 - Proyecto Loom
 * 
 * @author Lidia Artero Fernández
 */

document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // Formulario de registro
    // ============================================
    const formRegistro = document.getElementById('formRegistro');
    
    if (formRegistro) {
        // Validación en tiempo real
        const campos = ['nombre_usuario', 'email', 'fecha_nacimiento', 'contraseña', 'confirmar_contraseña'];
        
        campos.forEach(campoId => {
            const campo = document.getElementById(campoId);
            if (campo) {
                campo.addEventListener('blur', function() {
                    const valor = this.value;
                    
                    switch(campoId) {
                        case 'nombre_usuario':
                            const errorNombre = validarNombreUsuario(valor);
                            if (errorNombre) {
                                mostrarError('nombre_usuario', errorNombre);
                            } else {
                                limpiarError('nombre_usuario');
                            }
                            break;
                            
                        case 'email':
                            const errorEmail = validarEmail(valor);
                            if (errorEmail) {
                                mostrarError('email', errorEmail);
                            } else {
                                limpiarError('email');
                            }
                            break;
                            
                        case 'fecha_nacimiento':
                            const errorFecha = validarFechaNacimiento(valor);
                            if (errorFecha) {
                                mostrarError('fecha_nacimiento', errorFecha);
                            } else {
                                limpiarError('fecha_nacimiento');
                            }
                            break;
                            
                        case 'contraseña':
                            const errorContraseña = validarContraseña(valor);
                            if (errorContraseña) {
                                mostrarError('contraseña', errorContraseña);
                            } else {
                                limpiarError('contraseña');
                            }
                            break;
                            
                        case 'confirmar_contraseña':
                            const contraseña = document.getElementById('contraseña')?.value || '';
                            const errorConfirmar = validarConfirmarContraseña(contraseña, valor);
                            if (errorConfirmar) {
                                mostrarError('confirmar_contraseña', errorConfirmar);
                            } else {
                                limpiarError('confirmar_contraseña');
                            }
                            break;
                    }
                });
            }
        });
        
        // Validar confirmación de contraseña cuando cambia la contraseña
        const campoContraseña = document.getElementById('contraseña');
        const campoConfirmar = document.getElementById('confirmar_contraseña');
        
        if (campoContraseña && campoConfirmar) {
            campoContraseña.addEventListener('input', function() {
                if (campoConfirmar.value) {
                    const errorElement = document.getElementById('error_confirmar_contraseña');
                    let error = '';
                    if (typeof validarConfirmarContraseña === 'function') {
                        error = validarConfirmarContraseña(this.value, campoConfirmar.value);
                    }
                    if (errorElement) {
                        errorElement.textContent = error || '';
                    }
                }
            });
        }
        
        // Envío del formulario
        formRegistro.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Limpiar errores manualmente
            const errores = document.querySelectorAll('.error-message');
            errores.forEach(error => {
                error.textContent = '';
            });
            
            if (typeof validarFormularioRegistro === 'function' && !validarFormularioRegistro()) {
                return;
            }
            
            const btnRegistrar = document.getElementById('btnRegistrar');
            const mensajeResultado = document.getElementById('mensajeResultado');
            
            btnRegistrar.disabled = true;
            btnRegistrar.textContent = 'Registrando...';
            
            const formData = new FormData(formRegistro);
            
            fetch(formRegistro.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.includes("application/json")) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        console.error('Respuesta no JSON:', text);
                        throw new Error('Respuesta del servidor no es JSON: ' + text);
                    });
                }
            })
            .then(data => {
                console.log('Respuesta del servidor (registro):', data);
                if (data && data.exito) {
                    if (mensajeResultado) {
                        mensajeResultado.textContent = data.mensaje || 'Registro exitoso';
                        mensajeResultado.className = 'mensaje-resultado mensaje-exito';
                        mensajeResultado.style.display = 'block';
                    }
                    setTimeout(() => {
                        window.location.href = data.redirect || '/loom/vistas/inicio/pantalla_principal.php';
                    }, 1500);
                } else {
                    if (mensajeResultado) {
                        mensajeResultado.textContent = (data && data.mensaje) || 'Error al registrar';
                        mensajeResultado.className = 'mensaje-resultado mensaje-error';
                        mensajeResultado.style.display = 'block';
                    }
                    btnRegistrar.disabled = false;
                    btnRegistrar.textContent = 'Registrarse';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (mensajeResultado) {
                    mensajeResultado.textContent = 'Error al registrar. Por favor, intenta de nuevo.';
                    mensajeResultado.className = 'mensaje-resultado mensaje-error';
                    mensajeResultado.style.display = 'block';
                }
                btnRegistrar.disabled = false;
                btnRegistrar.textContent = 'Registrarse';
            });
        });
    }
    
    // ============================================
    // Formulario de login
    // ============================================
    const formLogin = document.getElementById('formLogin');
    
    if (formLogin) {
        // Validación en tiempo real
        const campoEmail = document.getElementById('email');
        const campoContraseña = document.getElementById('contraseña');
        
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
        
        if (campoContraseña) {
            campoContraseña.addEventListener('blur', function() {
                const errorElement = document.getElementById('error_contraseña');
                if (!this.value || this.value === '') {
                    if (errorElement) errorElement.textContent = 'La contraseña es requerida';
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
            
            const formData = new FormData(formLogin);
            
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
                        mensajeResultado.textContent = (data && data.mensaje) || 'Error al iniciar sesión';
                        mensajeResultado.className = 'mensaje-resultado mensaje-error';
                        mensajeResultado.style.display = 'block';
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

