<?php
// Controlador de Autenticación

require_once __DIR__ . '/../modelos/Usuario.php';

class AuthController {
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
    }
    
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
            return;
        }
        
        $datos = [
            'nombre_usuario' => limpiar($_POST['nombre_usuario'] ?? ''),
            'email' => limpiar($_POST['email'] ?? ''),
            'clave' => $_POST['clave'] ?? '',
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
            'biografia' => limpiar($_POST['biografia'] ?? '')
        ];
        
        // Validaciones
        $errores = $this->validarRegistro($datos);
        if (!empty($errores)) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => implode(', ', $errores)]);
            return;
        }
        
        $resultado = $this->usuario->registrar($datos);
        
        if ($resultado['exito']) {
            $_SESSION['usuario_id'] = $resultado['id_usuario'];
            $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
            $_SESSION['email'] = $datos['email'];
            
            echo json_encode([
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => ASSETS_URL . '/?page=dashboard'
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
            return;
        }
        
        $email = limpiar($_POST['email'] ?? '');
        $clave = $_POST['clave'] ?? '';
        
        if (empty($email) || empty($clave)) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'Email y clave son requeridos']);
            return;
        }
        
        $resultado = $this->usuario->autenticar($email, $clave);
        
        if ($resultado['exito']) {
            $_SESSION['usuario_id'] = $resultado['usuario']['id_usuario'];
            $_SESSION['nombre_usuario'] = $resultado['usuario']['nombre_usuario'];
            $_SESSION['email'] = $resultado['usuario']['email'];
            
            echo json_encode([
                'exito' => true,
                'mensaje' => 'Login exitoso',
                'redirect' => ASSETS_URL . '/?page=dashboard'
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }
    
    public function logout() {
        $_SESSION = [];
        session_destroy();
        
        echo json_encode([
            'exito' => true,
            'mensaje' => 'Sesión cerrada',
            'redirect' => '/loom/?page=menu'
        ]);
    }
    
    private function validarRegistro($datos) {
        $errores = [];
        
        if (empty($datos['nombre_usuario']) || strlen($datos['nombre_usuario']) < 3) {
            $errores[] = 'Usuario: mín 3 caracteres';
        }
        if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Email inválido';
        }
        if (empty($datos['clave']) || strlen($datos['clave']) < PASSWORD_MIN_LENGTH) {
            $errores[] = 'Clave: mín ' . PASSWORD_MIN_LENGTH . ' caracteres';
        }
        if (!preg_match('/[A-Z]/', $datos['clave']) || !preg_match('/[a-z]/', $datos['clave']) || 
            !preg_match('/[0-9]/', $datos['clave'])) {
            $errores[] = 'Clave: mayúscula, minúscula y número requeridos';
        }
        if (empty($datos['fecha_nacimiento'])) {
            $errores[] = 'Fecha de nacimiento requerida';
        }
        
        return $errores;
    }
}
