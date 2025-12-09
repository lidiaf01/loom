<?php
// Router de autenticación

ob_start();

try {
    require_once __DIR__ . '/../../../config.php';
    require_once __DIR__ . '/AuthController.php';

    header('Content-Type: application/json; charset=utf-8');

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
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['exito' => false, 'mensaje' => 'Error del servidor: ' . $e->getMessage()]);
}

ob_end_flush();
?>