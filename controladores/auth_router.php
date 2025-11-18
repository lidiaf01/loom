<?php
/**
 * Router para Autenticación
 * Sprint 1 - Proyecto Loom
 */

// Detener cualquier output previo
if (ob_get_level()) {
    ob_end_clean();
}

// Iniciar nuevo buffer
ob_start();

// Configurar headers PRIMERO (antes de cualquier output)
header('Content-Type: application/json; charset=utf-8');

// Evitar que se muestren errores como HTML
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Limpiar cualquier output previo ANTES de incluir archivos
    ob_clean();
    
    // Definir constante para indicar que estamos en una petición API
    define('LOOM_API', true);
    
    // Incluir config sin que genere output
    require_once __DIR__ . '/../config.php';
    require_once __DIR__ . '/AuthController.php';
    
    // Limpiar de nuevo por si acaso
    ob_clean();
    
    // Obtener acción
    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    
    if (empty($action)) {
        http_response_code(400);
        echo json_encode(['exito' => false, 'mensaje' => 'Acción no especificada']);
        exit;
    }
    
    // Crear instancia del controlador
    $controller = new AuthController();
    
    // Enrutar según acción
    switch ($action) {
        case 'registrar':
            $controller->registrar();
            break;
            
        case 'login':
            $controller->login();
            break;
            
        case 'logout':
            $controller->logout();
            break;
            
        default:
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'Acción no válida: ' . $action]);
            break;
    }
    
} catch (Exception $e) {
    // Limpiar cualquier output previo
    ob_clean();
    
    // Capturar cualquier error y devolverlo como JSON
    http_response_code(500);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error del servidor: ' . $e->getMessage(),
        'error' => $e->getFile() . ':' . $e->getLine()
    ]);
} catch (Error $e) {
    // Capturar errores fatales también
    ob_clean();
    
    http_response_code(500);
    echo json_encode([
        'exito' => false,
        'mensaje' => 'Error fatal: ' . $e->getMessage(),
        'error' => $e->getFile() . ':' . $e->getLine()
    ]);
}

// Finalizar output buffering y enviar respuesta
if (ob_get_level()) {
    ob_end_flush();
}
exit;

