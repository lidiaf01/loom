<?php
/**
 * Punto de entrada principal - Proyecto Loom
 * Sprint 1 - Proyecto Loom
 * 
 * Este archivo debe estar en la raíz de htdocs/loom/
 */

// Iniciar sesión antes de incluir config
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config.php';

// Redirigir según estado de autenticación
if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
} else {
    header('Location: ' . url('vistas/autenticacion/menu_login_registro.php'));
}
exit;
