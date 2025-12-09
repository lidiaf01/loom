<?php
// Punto de entrada principal

require_once __DIR__ . '/config.php';

// Redirigir según autenticación
if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
} else {
    header('Location: ' . url('vistas/autenticacion/login.php'));
}
exit;
