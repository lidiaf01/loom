<?php
// Router de perfil

ob_start();

try {
    require_once __DIR__ . '/../../../config.php';
    require_once __DIR__ . '/PerfilController.php';

    header('Content-Type: application/json; charset=utf-8');

    $action = $_GET['action'] ?? $_POST['action'] ?? '';
    
    if (empty($action)) {
        http_response_code(400);
        echo json_encode(['exito' => false, 'mensaje' => 'Acción no especificada']);
        ob_end_flush();
        exit;
    }
    
    $controller = new PerfilController();

    switch ($action) {
        case 'actualizar':
            $controller->actualizar();
            break;
        case 'subirFoto':
            $controller->subirFoto();
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

