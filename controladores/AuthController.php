<?php
/**
 * Controlador de Autenticación
 * Sprint 1 - Proyecto Loom
 * 
 * @author Lidia Artero Fernández
 * @version 1.0
 */

require_once __DIR__ . '/../modelos/Usuario.php';

class AuthController {
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
    }
    
    /**
     * Procesa el registro de un nuevo usuario
     */
    public function registrar() {
        // Verificar que sea petición POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
            return;
        }
        
        // Obtener y limpiar datos
        $datos = [
            'nombre_usuario' => limpiar($_POST['nombre_usuario'] ?? ''),
            'email' => limpiar($_POST['email'] ?? ''),
            'contraseña' => $_POST['contraseña'] ?? '',
            'fecha_nacimiento' => limpiar($_POST['fecha_nacimiento'] ?? ''),
            'biografia' => limpiar($_POST['biografia'] ?? '')
        ];
        
        // Validaciones básicas
        $errores = $this->validarRegistro($datos);
        
        if (!empty($errores)) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => implode(', ', $errores)]);
            return;
        }
        
        // Registrar usuario
        $resultado = $this->usuario->registrar($datos);
        
        if ($resultado['exito']) {
            // Iniciar sesión automáticamente tras registro
            $_SESSION['usuario_id'] = $resultado['id_usuario'];
            $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
            $_SESSION['email'] = $datos['email'];
            
            http_response_code(201);
            echo json_encode([
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => url('vistas/inicio/pantalla_principal.php')
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }
    
    /**
     * Procesa el login de un usuario
     */
    public function login() {
        // Verificar que sea petición POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
            return;
        }
        
        $email = limpiar($_POST['email'] ?? '');
        $contraseña = $_POST['contraseña'] ?? '';
        
        // Validaciones básicas
        if (empty($email) || empty($contraseña)) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'Email y contraseña son requeridos']);
            return;
        }
        
        // Autenticar
        $resultado = $this->usuario->autenticar($email, $contraseña);
        
        if ($resultado['exito']) {
            // Guardar datos en sesión
            $_SESSION['usuario_id'] = $resultado['usuario']['id_usuario'];
            $_SESSION['nombre_usuario'] = $resultado['usuario']['nombre_usuario'];
            $_SESSION['email'] = $resultado['usuario']['email'];
            $_SESSION['rol'] = $resultado['usuario']['rol'];
            
            // Opción "Recordar sesión" (cookie)
            if (isset($_POST['recordar']) && $_POST['recordar'] === '1') {
                setcookie('loom_session', session_id(), time() + SESSION_LIFETIME, '/');
            }
            
            http_response_code(200);
            echo json_encode([
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => url('vistas/inicio/pantalla_principal.php')
            ]);
        } else {
            http_response_code(401);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }
    
    /**
     * Cierra la sesión del usuario
     */
    public function logout() {
        // Destruir sesión
        $_SESSION = [];
        
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        if (isset($_COOKIE['loom_session'])) {
            setcookie('loom_session', '', time() - 3600, '/');
        }
        
        session_destroy();
        
        http_response_code(200);
        echo json_encode([
            'exito' => true,
            'mensaje' => 'Sesión cerrada correctamente',
            'redirect' => url('index.php')
        ]);
    }
    
    /**
     * Valida los datos de registro
     * 
     * @param array $datos
     * @return array Errores encontrados
     */
    private function validarRegistro($datos) {
        $errores = [];
        
        // Validar nombre de usuario
        if (empty($datos['nombre_usuario'])) {
            $errores[] = 'El nombre de usuario es requerido';
        } elseif (strlen($datos['nombre_usuario']) < 3) {
            $errores[] = 'El nombre de usuario debe tener al menos 3 caracteres';
        } elseif (strlen($datos['nombre_usuario']) > 50) {
            $errores[] = 'El nombre de usuario no puede exceder 50 caracteres';
        }
        
        // Validar email
        if (empty($datos['email'])) {
            $errores[] = 'El email es requerido';
        } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El email no es válido';
        }
        
        // Validar contraseña
        if (empty($datos['contraseña'])) {
            $errores[] = 'La contraseña es requerida';
        } elseif (strlen($datos['contraseña']) < PASSWORD_MIN_LENGTH) {
            $errores[] = 'La contraseña debe tener al menos ' . PASSWORD_MIN_LENGTH . ' caracteres';
        } elseif (!preg_match('/[A-Z]/', $datos['contraseña'])) {
            $errores[] = 'La contraseña debe contener al menos una mayúscula';
        } elseif (!preg_match('/[a-z]/', $datos['contraseña'])) {
            $errores[] = 'La contraseña debe contener al menos una minúscula';
        } elseif (!preg_match('/[0-9]/', $datos['contraseña'])) {
            $errores[] = 'La contraseña debe contener al menos un número';
        }
        
        // Validar fecha de nacimiento
        if (empty($datos['fecha_nacimiento'])) {
            $errores[] = 'La fecha de nacimiento es requerida';
        } else {
            $fechaNacimiento = new DateTime($datos['fecha_nacimiento']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;
            
            if ($edad < EDAD_MINIMA) {
                $errores[] = 'Debes tener al menos ' . EDAD_MINIMA . ' años para registrarte';
            }
        }
        
        return $errores;
    }
}
