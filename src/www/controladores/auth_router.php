<?php
/**
 * Router para Autenticación
 * Sprint 1 - Proyecto Loom
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/AuthController.php';

// Configurar respuesta JSON
header('Content-Type: application/json; charset=utf-8');

// Obtener acción
$action = $_GET['action'] ?? $_POST['action'] ?? '';

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
        echo json_encode(['exito' => false, 'mensaje' => 'Acción no válida']);
        break;
}

