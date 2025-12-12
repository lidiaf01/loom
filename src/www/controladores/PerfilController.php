<?php
/**
 * Controlador de Perfil
 * 
 * Gestiona las operaciones relacionadas con el perfil de usuario
 * 
 * @package Loom
 * @subpackage Controladores
 */

require_once __DIR__ . '/../modelos/Usuario.php';

class PerfilController
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    /**
     * Muestra el perfil del usuario autenticado
     */
    public function mostrar()
    {
        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            header('Location: ' . ASSETS_URL . '/?page=login');
            exit;
        }

        $usuario = $this->usuario->obtenerPorId($idUsuario);
        if (!$usuario) {
            header('Location: ' . ASSETS_URL . '/?page=dashboard');
            exit;
        }

        return $usuario;
    }

    /**
     * Muestra el formulario de edición de perfil
     */
    public function editar()
    {
        return $this->mostrar();
    }

    /**
     * Procesa la actualización del perfil
     */
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
            return;
        }

        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            http_response_code(401);
            echo json_encode(['exito' => false, 'mensaje' => 'No autenticado']);
            return;
        }

        $datos = [
            'nombre_usuario' => limpiar($_POST['nombre_usuario'] ?? ''),
            'email' => limpiar($_POST['email'] ?? ''),
            'biografia' => limpiar($_POST['biografia'] ?? ''),
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? ''
        ];

        // Validaciones
        $errores = $this->validarDatos($datos, $idUsuario);
        if (!empty($errores)) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => implode(', ', $errores)]);
            return;
        }

        $resultado = $this->usuario->actualizarPerfil($idUsuario, $datos);

        if ($resultado['exito']) {
            // Actualizar sesión con nuevos datos
            if (!empty($datos['nombre_usuario'])) {
                $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
            }
            if (!empty($datos['email'])) {
                $_SESSION['email'] = $datos['email'];
            }

            echo json_encode([
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => ASSETS_URL . '/?page=perfil'
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }

    /**
     * Procesa la subida de foto de perfil
     */
    public function subirFoto()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido']);
            return;
        }

        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            http_response_code(401);
            echo json_encode(['exito' => false, 'mensaje' => 'No autenticado']);
            return;
        }

        if (!isset($_FILES['foto_perfil']) || $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'Error al subir la imagen']);
            return;
        }

        $archivo = $_FILES['foto_perfil'];
        
        // Validar tipo de archivo
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
        $tipoArchivo = $archivo['type'];
        if (!in_array($tipoArchivo, $tiposPermitidos)) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'Tipo de archivo no permitido. Use JPG, PNG o WebP']);
            return;
        }

        // Validar tamaño (5MB máximo)
        $tamañoMaximo = 5 * 1024 * 1024; // 5MB
        if ($archivo['size'] > $tamañoMaximo) {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => 'El archivo es demasiado grande. Máximo 5MB']);
            return;
        }

        // Generar nombre único
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombreArchivo = 'perfil_' . $idUsuario . '_' . time() . '.' . $extension;

        // Ruta de destino
        $directorioUploads = __DIR__ . '/../uploads/perfiles/';
        if (!is_dir($directorioUploads)) {
            mkdir($directorioUploads, 0755, true);
        }
        $rutaDestino = $directorioUploads . $nombreArchivo;

        // Mover archivo
        if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            http_response_code(500);
            echo json_encode(['exito' => false, 'mensaje' => 'Error al guardar la imagen']);
            return;
        }

        // Actualizar en base de datos
        $resultado = $this->usuario->actualizarFoto($idUsuario, $nombreArchivo);

        if ($resultado['exito']) {
            echo json_encode([
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'foto' => $nombreArchivo,
                'redirect' => ASSETS_URL . '/?page=perfil'
            ]);
        } else {
            // Eliminar archivo si falló la actualización en BD
            @unlink($rutaDestino);
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }

    /**
     * Valida los datos del perfil
     */
    private function validarDatos($datos, $idUsuario)
    {
        $errores = [];

        if (!empty($datos['nombre_usuario'])) {
            if (strlen($datos['nombre_usuario']) < 3 || strlen($datos['nombre_usuario']) > 50) {
                $errores[] = 'Nombre de usuario debe tener entre 3 y 50 caracteres';
            }
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $datos['nombre_usuario'])) {
                $errores[] = 'Nombre de usuario solo puede contener letras, números y guiones bajos';
            }
            if ($this->usuario->verificarUnicidadNombreUsuario($datos['nombre_usuario'], $idUsuario)) {
                $errores[] = 'El nombre de usuario ya está en uso';
            }
        }

        if (!empty($datos['email'])) {
            if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
                $errores[] = 'Email inválido';
            }
            if ($this->usuario->verificarUnicidadEmail($datos['email'], $idUsuario)) {
                $errores[] = 'El email ya está en uso';
            }
        }

        if (!empty($datos['biografia']) && strlen($datos['biografia']) > 500) {
            $errores[] = 'La biografía no puede exceder 500 caracteres';
        }

        if (!empty($datos['fecha_nacimiento'])) {
            $fecha = new DateTime($datos['fecha_nacimiento']);
            $edad = date_diff($fecha, new DateTime())->y;
            if ($edad < EDAD_MINIMA) {
                $errores[] = 'Debes tener al menos ' . EDAD_MINIMA . ' años';
            }
        }

        return $errores;
    }
}

