<?php
<<<<<<< HEAD
/**
 * Punto de entrada principal - Redirige a src/www/index.php
 */
require_once __DIR__ . '/src/www/index.php';
=======
// Punto de entrada principal - Router MVC

require_once __DIR__ . '/config.php';

// Obtener página solicitada
$page = $_GET['page'] ?? 'menu';
$page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);

// Redireccionar si está autenticado y pide login/registro
if (estaAutenticado() && in_array($page, ['login', 'registro', 'menu'])) {
    $page = 'inicio';
}

// Redireccionar si NO está autenticado y pide página protegida
if (!estaAutenticado() && in_array($page, ['inicio'])) {
    $page = 'menu';
}

// Incluir vista correspondiente
switch ($page) {
    case 'menu':
        include __DIR__ . '/src/www/vistas/autenticacion/menu_login_registro.php';
        break;
    case 'login':
        include __DIR__ . '/src/www/vistas/autenticacion/login.php';
        break;
    case 'error_login':
        include __DIR__ . '/src/www/vistas/autenticacion/error_login.php';
        break;
    case 'registro':
        include __DIR__ . '/src/www/vistas/autenticacion/registro.php';
        break;
    case 'inicio':
        include __DIR__ . '/src/www/vistas/inicio/pantalla_principal.php';
        break;
    default:
        http_response_code(404);
        echo '<h1>Página no encontrada</h1>';
        exit;
}
>>>>>>> 53c5bf011309e270d2c5e4fa9544df665db30bd6
