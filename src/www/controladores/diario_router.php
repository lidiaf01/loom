<?php
// Router de diario

ob_start();

try {
    require_once __DIR__ . '/../../../config.php';
    require_once __DIR__ . '/DiarioController.php';

    header('Content-Type: application/json; charset=utf-8');

    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    
    if (empty($action)) {
        http_response_code(400);
        echo json_encode(['exito' => false, 'mensaje' => 'Acción no especificada']);
        ob_end_flush();
        exit;
    }
    
    $controller = new DiarioController();

    switch ($action) {
        case 'eliminar':
            $id = $_POST['id'] ?? $_GET['id'] ?? 0;
            $controller->eliminar($id);
            break;
        default:
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'Acción inválida: ' . $action]);
    }
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    $mensaje = 'Error del servidor: ' . $e->getMessage();
    if (defined('DEBUG') && DEBUG) {
        $mensaje .= ' | Archivo: ' . $e->getFile() . ' | Línea: ' . $e->getLine();
    }
    echo json_encode(['exito' => false, 'mensaje' => $mensaje]);
} catch (Error $e) {
    ob_clean();
    http_response_code(500);
    $mensaje = 'Error fatal: ' . $e->getMessage();
    if (defined('DEBUG') && DEBUG) {
        $mensaje .= ' | Archivo: ' . $e->getFile() . ' | Línea: ' . $e->getLine();
    }
    echo json_encode(['exito' => false, 'mensaje' => $mensaje]);
}

ob_end_flush();
?>

