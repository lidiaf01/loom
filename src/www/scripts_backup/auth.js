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
                    const error = validarConfirmarContraseña(this.value, campoConfirmar.value);
                    if (error) {
                        mostrarError('confirmar_contraseña', error);
                    } else {
                        limpiarError('confirmar_contraseña');
                    }
                }
            });
        }
        
        // Envío del formulario
        formRegistro.addEventListener('submit', function(e) {
            e.preventDefault();
            
            limpiarErrores();
            
            if (!validarFormularioRegistro()) {
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
            .then(response => response.json())
            .then(data => {
                if (data.exito) {
                    mostrarMensaje(mensajeResultado, data.mensaje, 'exito');
                    setTimeout(() => {
                        window.location.href = data.redirect || '/loom/';
                    }, 1500);
                } else {
                    mostrarMensaje(mensajeResultado, data.mensaje, 'error');
                    btnRegistrar.disabled = false;
                    btnRegistrar.textContent = 'Registrarse';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarMensaje(mensajeResultado, 'Error al registrar. Por favor, intenta de nuevo.', 'error');
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
                if (error) {
                    mostrarError('email', error);
                } else {
                    limpiarError('email');
                }
            });
        }
        
        if (campoContraseña) {
            campoContraseña.addEventListener('blur', function() {
                if (!this.value || this.value === '') {
                    mostrarError('contraseña', 'La contraseña es requerida');
                } else {
                    limpiarError('contraseña');
                }
            });
        }
        
        // Envío del formulario
        formLogin.addEventListener('submit', function(e) {
            e.preventDefault();
            
            limpiarErrores();
            
            if (!validarFormularioLogin()) {
                return;
            }
            
            const btnLogin = document.getElementById('btnLogin');
            const mensajeResultado = document.getElementById('mensajeResultado');
            
            btnLogin.disabled = true;
            btnLogin.textContent = 'Iniciando sesión...';
            
            const formData = new FormData(formLogin);
            
            fetch(formLogin.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.exito) {
                    mostrarMensaje(mensajeResultado, data.mensaje, 'exito');
                    setTimeout(() => {
                        window.location.href = data.redirect || '/loom/';
                    }, 1500);
                } else {
                    mostrarMensaje(mensajeResultado, data.mensaje, 'error');
                    btnLogin.disabled = false;
                    btnLogin.textContent = 'Iniciar sesión';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarMensaje(mensajeResultado, 'Error al iniciar sesión. Por favor, intenta de nuevo.', 'error');
                btnLogin.disabled = false;
                btnLogin.textContent = 'Iniciar sesión';
            });
        });
    }
});
