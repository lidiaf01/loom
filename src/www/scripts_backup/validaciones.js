/**
 * Validaciones del lado del cliente
 * Sprint 1 - Proyecto Loom
 * 
 * @author Lidia Artero Fernández
 */

// ============================================
// Validación de nombre de usuario
// ============================================
function validarNombreUsuario(nombre) {
    if (!nombre || nombre.trim() === '') {
        return 'El nombre de usuario es requerido';
    }
    
    if (nombre.length < 3) {
        return 'El nombre de usuario debe tener al menos 3 caracteres';
    }
    
    if (nombre.length > 50) {
        return 'El nombre de usuario no puede exceder 50 caracteres';
    }
    
    if (!/^[a-zA-Z0-9_]+$/.test(nombre)) {
        return 'El nombre de usuario solo puede contener letras, números y guiones bajos';
    }
    
    return '';
}

// ============================================
// Validación de email
// ============================================
function validarEmail(email) {
    if (!email || email.trim() === '') {
        return 'El email es requerido';
    }
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        return 'El email no es válido';
    }
    
    return '';
}

// ============================================
// Validación de contraseña
// ============================================
function validarContraseña(contraseña) {
    if (!contraseña || contraseña === '') {
        return 'La contraseña es requerida';
    }
    
    if (contraseña.length < 8) {
        return 'La contraseña debe tener al menos 8 caracteres';
    }
    
    if (!/[A-Z]/.test(contraseña)) {
        return 'La contraseña debe contener al menos una mayúscula';
    }
    
    if (!/[a-z]/.test(contraseña)) {
        return 'La contraseña debe contener al menos una minúscula';
    }
    
    if (!/[0-9]/.test(contraseña)) {
        return 'La contraseña debe contener al menos un número';
    }
    
    return '';
}

// ============================================
// Validación de confirmación de contraseña
// ============================================
function validarConfirmarContraseña(contraseña, confirmarContraseña) {
    if (!confirmarContraseña || confirmarContraseña === '') {
        return 'Debes confirmar tu contraseña';
    }
    
    if (contraseña !== confirmarContraseña) {
        return 'Las contraseñas no coinciden';
    }
    
    return '';
}

// ============================================
// Validación de fecha de nacimiento
// ============================================
function validarFechaNacimiento(fecha) {
    if (!fecha || fecha === '') {
        return 'La fecha de nacimiento es requerida';
    }
    
    const fechaNacimiento = new Date(fecha);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    const mes = hoy.getMonth() - fechaNacimiento.getMonth();
    
    let edadReal = edad;
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edadReal--;
    }
    
    if (edadReal < 13) {
        return 'Debes tener al menos 13 años para registrarte';
    }
    
    return '';
}

// ============================================
// Validación completa del formulario de registro
// ============================================
function validarFormularioRegistro() {
    const nombreUsuario = document.getElementById('nombre_usuario')?.value || '';
    const email = document.getElementById('email')?.value || '';
    const fechaNacimiento = document.getElementById('fecha_nacimiento')?.value || '';
    const contraseña = document.getElementById('contraseña')?.value || '';
    const confirmarContraseña = document.getElementById('confirmar_contraseña')?.value || '';
    
    let esValido = true;
    
    // Validar nombre de usuario
    const errorNombre = validarNombreUsuario(nombreUsuario);
    if (errorNombre) {
        mostrarError('nombre_usuario', errorNombre);
        esValido = false;
    } else {
        limpiarError('nombre_usuario');
    }
    
    // Validar email
    const errorEmail = validarEmail(email);
    if (errorEmail) {
        mostrarError('email', errorEmail);
        esValido = false;
    } else {
        limpiarError('email');
    }
    
    // Validar fecha de nacimiento
    const errorFecha = validarFechaNacimiento(fechaNacimiento);
    if (errorFecha) {
        mostrarError('fecha_nacimiento', errorFecha);
        esValido = false;
    } else {
        limpiarError('fecha_nacimiento');
    }
    
    // Validar contraseña
    const errorContraseña = validarContraseña(contraseña);
    if (errorContraseña) {
        mostrarError('contraseña', errorContraseña);
        esValido = false;
    } else {
        limpiarError('contraseña');
    }
    
    // Validar confirmación de contraseña
    const errorConfirmar = validarConfirmarContraseña(contraseña, confirmarContraseña);
    if (errorConfirmar) {
        mostrarError('confirmar_contraseña', errorConfirmar);
        esValido = false;
    } else {
        limpiarError('confirmar_contraseña');
    }
    
    return esValido;
}

// ============================================
// Validación del formulario de login
// ============================================
function validarFormularioLogin() {
    const email = document.getElementById('email')?.value || '';
    const contraseña = document.getElementById('contraseña')?.value || '';
    
    let esValido = true;
    
    // Validar email
    const errorEmail = validarEmail(email);
    if (errorEmail) {
        mostrarError('email', errorEmail);
        esValido = false;
    } else {
        limpiarError('email');
    }
    
    // Validar contraseña
    if (!contraseña || contraseña === '') {
        mostrarError('contraseña', 'La contraseña es requerida');
        esValido = false;
    } else {
        limpiarError('contraseña');
    }
    
    return esValido;
}
