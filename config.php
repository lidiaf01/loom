<?php
// Configuración principal - Loom (Simplificado)

// Sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Zona horaria
date_default_timezone_set('Europe/Madrid');

// ========== BASE DE DATOS ==========
define('DB_HOST', 'localhost');
define('DB_NAME', 'loom_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// ========== RUTAS Y URLs ==========
define('WWW_PATH', __DIR__);
define('MODELOS_PATH', WWW_PATH . '/modelos');
define('CONTROLADORES_PATH', WWW_PATH . '/controladores');
define('VISTAS_PATH', WWW_PATH . '/vistas');
define('RECURSOS_PATH', WWW_PATH . '/recursos');
define('ASSETS_URL', '/loom');

// ========== SEGURIDAD ==========
define('PASSWORD_MIN_LENGTH', 8);
define('EDAD_MINIMA', 13);

// ========== AUTOLOADER ==========
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

// ========== FUNCIONES AUXILIARES ==========
function estaAutenticado() {
    return !empty($_SESSION['usuario_id']);
}

function obtenerUsuarioId() {
    return $_SESSION['usuario_id'] ?? null;
}

function requerirAutenticacion() {
    if (!estaAutenticado()) {
        header('Location: ' . ASSETS_URL . '/vistas/autenticacion/login.php');
        exit;
    }
}

function limpiar($texto) {
    return htmlspecialchars(trim($texto ?? ''));
}

function url($ruta) {
    return ASSETS_URL . '/' . ltrim($ruta, '/');
}

