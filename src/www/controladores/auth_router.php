<?php
// Router de autenticación

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/AuthController.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';
$controller = new AuthController();

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
        echo json_encode(['exito' => false, 'mensaje' => 'Acción inválida']);
}

