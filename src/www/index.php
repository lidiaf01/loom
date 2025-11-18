<?php
/**
 * Punto de entrada principal
 * Sprint 1 - Proyecto Loom
 */

require_once __DIR__ . '/config.php';

// Redirigir según estado de autenticación
if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
} else {
    header('Location: ' . url('vistas/autenticacion/menu_login_registro.php'));
}
exit;

