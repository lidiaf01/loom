<?php
// Punto de entrada principal - Router MVC

require_once __DIR__ . '/config.php';

// Obtener página solicitada
$page = $_GET['page'] ?? 'inicio';
$page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);

// Redireccionar si está autenticado y pide login/registro/menu o pasos de registro
if (estaAutenticado() && in_array($page, ['login', 'registro', 'menu', 'registro_paso2', 'registro_paso3'])) {
    $page = 'dashboard';
}

// Redireccionar si NO está autenticado y pide página protegida
if (!estaAutenticado() && in_array($page, ['dashboard', 'perfil', 'editar_perfil', 'diario', 'diario_entrada'])) {
    $page = 'inicio';
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
    case 'registro_paso2':
        include __DIR__ . '/src/www/vistas/autenticacion/registro_paso2.php';
        break;
    case 'registro_paso3':
        include __DIR__ . '/src/www/vistas/autenticacion/registro_paso3.php';
        break;
    case 'inicio':
        include __DIR__ . '/src/www/vistas/inicio/pantalla_principal.php';
        break;
    case 'dashboard':
        include __DIR__ . '/src/www/vistas/inicio/dashboard.php';
        break;
    case 'perfil':
        include __DIR__ . '/src/www/vistas/perfil/perfil.php';
        break;
    case 'editar_perfil':
        include __DIR__ . '/src/www/vistas/perfil/editar_perfil.php';
        break;
    case 'diario':
        include __DIR__ . '/src/www/vistas/diario/diario.php';
        break;
    case 'diario_entrada':
        include __DIR__ . '/src/www/vistas/diario/diario_entrada.php';
        break;
    default:
        http_response_code(404);
        echo '<h1>Página no encontrada</h1>';
        exit;
}
