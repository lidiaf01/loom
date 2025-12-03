<?php
/**
 * Configuración principal del proyecto Loom
 * Sprint 1 - Proyecto Loom
// Sprint 1 - Lidia
    define('LOOM_APP', true);
}

// Configuración de errores (solo en desarrollo)
// Si es una petición API, no mostrar errores como HTML
if (!defined('LOOM_API')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
}
error_reporting(E_ALL);

// Zona horaria
date_default_timezone_set('Europe/Madrid');

// Configuración de sesiones
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Cambiar a 1 en producción con HTTPS
// Iniciar sesión solo si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// CONFIGURACIÓN DE BASE DE DATOS
// ============================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'loom_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // Dejar vacío por defecto en XAMPP
define('DB_CHARSET', 'utf8mb4');

// ============================================
// CONFIGURACIÓN DE LA APLICACIÓN
// ============================================
define('APP_NAME', 'Loom');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/loom');

// Rutas del sistema
define('ROOT_PATH', dirname(__DIR__));
define('WWW_PATH', __DIR__);
define('MODELOS_PATH', WWW_PATH . '/modelos');
define('CONTROLADORES_PATH', WWW_PATH . '/controladores');
define('VISTAS_PATH', WWW_PATH . '/vistas');
define('RECURSOS_PATH', WWW_PATH . '/recursos');

// URLs públicas
define('CSS_URL', '/loom/estilos');
define('JS_URL', '/loom/scripts');
define('IMG_URL', '/loom/recursos/imagenes');

// ============================================
// CONFIGURACIÓN DE SEGURIDAD
// ============================================
define('SESSION_LIFETIME', 3600 * 24); // 24 horas
define('PASSWORD_MIN_LENGTH', 8);
define('EDAD_MINIMA', 13);

// ============================================
// AUTOLOADER SIMPLE
// ============================================
spl_autoload_register(function ($class) {
    $paths = [
        MODELOS_PATH . '/' . $class . '.php',
        CONTROLADORES_PATH . '/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Alias para compatibilidad
define('ASSETS_PATH', RECURSOS_PATH);

// ============================================
// FUNCIONES AUXILIARES
// ============================================

/**
 * Verifica si el usuario está autenticado
 */
function estaAutenticado() {
    return isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id']);
}

/**
 * Requiere autenticación, redirige si no está autenticado
 */
function requerirAutenticacion() {
    if (!estaAutenticado()) {
        header('Location: ' . url('vistas/autenticacion/login.php'));
        exit;
    }
}

/**
 * Obtiene el ID del usuario actual
 */
function obtenerUsuarioId() {
    return $_SESSION['usuario_id'] ?? null;
}

/**
 * Sanitiza datos de entrada
 */
function limpiar($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Genera URL relativa
 */
function url($path = '') {
    return '/loom/' . ltrim($path, '/');
}

