<?php
/**
 * Modelo Usuario - CRUD de usuarios
 * Sprint 1 - Proyecto Loom
 * 
 * @author Lidia Artero Fernández
 * @version 1.0
 */

require_once __DIR__ . '/Database.php';

class Usuario {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Registra un nuevo usuario
     * 
     * @param array $datos Datos del usuario (nombre_usuario, email, contraseña, fecha_nacimiento)
     * @return array ['exito' => bool, 'mensaje' => string, 'id_usuario' => int|null]
     */
    public function registrar($datos) {
        try {
            // Validar que el email no exista
            if ($this->existeEmail($datos['email'])) {
                return [
                    'exito' => false,
                    'mensaje' => 'Este email ya está registrado',
                    'id_usuario' => null
                ];
            }
            
            // Validar que el nombre de usuario no exista
            if ($this->existeNombreUsuario($datos['nombre_usuario'])) {
                return [
                    'exito' => false,
                    'mensaje' => 'Este nombre de usuario ya está en uso',
                    'id_usuario' => null
                ];
            }
            
            // Validar edad mínima usando funciones básicas
            $timestampNacimiento = strtotime($datos['fecha_nacimiento']);
            $timestampHoy = time();
            $diferenciaSegundos = $timestampHoy - $timestampNacimiento;
            $edad = floor($diferenciaSegundos / (365.25 * 24 * 60 * 60));
            
            if ($edad < EDAD_MINIMA) {
                return [
                    'exito' => false,
                    'mensaje' => 'Debes tener al menos ' . EDAD_MINIMA . ' años para registrarte',
                    'id_usuario' => null
                ];
            }
            
            // Hash de la contraseña
            $hashContraseña = password_hash($datos['contraseña'], PASSWORD_DEFAULT);
            
            // Insertar usuario (usar backticks para nombres de columnas con caracteres especiales)
            $sql = "INSERT INTO usuarios (`nombre_usuario`, `email`, `contraseña`, `fecha_nacimiento`, `biografia`, `rol`)
                    VALUES (:nombre_usuario, :email, :contraseña, :fecha_nacimiento, :biografia, :rol)";
            
            $stmt = $this->db->prepare($sql);
            $biografia = null;
            if (isset($datos['biografia']) && !empty($datos['biografia'])) {
                $biografia = $datos['biografia'];
            }
            
            $stmt->execute([
                ':nombre_usuario' => $datos['nombre_usuario'],
                ':email' => $datos['email'],
                ':contraseña' => $hashContraseña,
                ':fecha_nacimiento' => $datos['fecha_nacimiento'],
                ':biografia' => $biografia,
                ':rol' => 'usuario'
            ]);
            
            $idUsuario = $this->db->lastInsertId();
            
            return [
                'exito' => true,
                'mensaje' => 'Usuario registrado exitosamente',
                'id_usuario' => $idUsuario
            ];
            
        } catch (PDOException $e) {
            error_log('Error al registrar usuario: ' . $e->getMessage());
            return [
                'exito' => false,
                'mensaje' => 'Error al procesar el registro. Por favor, intenta de nuevo.',
                'id_usuario' => null
            ];
        }
    }
    
    /**
     * Autentica un usuario (login)
     * 
     * @param string $email Email del usuario
     * @param string $contraseña Contraseña sin hash
     * @return array ['exito' => bool, 'mensaje' => string, 'usuario' => array|null]
     */
    public function autenticar($email, $contraseña) {
        try {
            $sql = "SELECT `id_usuario`, `nombre_usuario`, `email`, `contraseña`, `rol`, `activo`, `foto_perfil`, `biografia`
                    FROM usuarios 
                    WHERE `email` = :email AND `activo` = 1
                    LIMIT 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch();
            
            if (!$usuario) {
                return [
                    'exito' => false,
                    'mensaje' => 'Email o contraseña incorrectos',
                    'usuario' => null
                ];
            }
            
            // Verificar contraseña
            if (!password_verify($contraseña, $usuario['contraseña'] ?? '')) {
                return [
                    'exito' => false,
                    'mensaje' => 'Email o contraseña incorrectos',
                    'usuario' => null
                ];
            }
            
            // Actualizar último acceso
            $this->actualizarUltimoAcceso($usuario['id_usuario']);
            
            // Eliminar contraseña del array antes de devolver
            unset($usuario['contraseña']);
            
            return [
                'exito' => true,
                'mensaje' => 'Login exitoso',
                'usuario' => $usuario
            ];
            
        } catch (PDOException $e) {
            return [
                'exito' => false,
                'mensaje' => 'Error al autenticar: ' . $e->getMessage(),
                'usuario' => null
            ];
        }
    }
    
    /**
     * Obtiene un usuario por ID
     * 
     * @param int $idUsuario
     * @return array|null
     */
    public function obtenerPorId($idUsuario) {
        try {
            $sql = "SELECT id_usuario, nombre_usuario, email, fecha_nacimiento, biografia, 
                           foto_perfil, rol, fecha_registro
                    FROM usuarios 
                    WHERE id_usuario = :id_usuario AND activo = 1
                    LIMIT 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_usuario' => $idUsuario]);
            return $stmt->fetch();
            
        } catch (PDOException $e) {
            return null;
        }
    }
    
    /**
     * Verifica si un email existe
     * 
     * @param string $email
     * @return bool
     */
    public function existeEmail($email) {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Verifica si un nombre de usuario existe
     * 
     * @param string $nombreUsuario
     * @return bool
     */
    public function existeNombreUsuario($nombreUsuario) {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :nombre_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':nombre_usuario' => $nombreUsuario]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Actualiza el último acceso del usuario
     * 
     * @param int $idUsuario
     */
    private function actualizarUltimoAcceso($idUsuario) {
        try {
            $sql = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_usuario' => $idUsuario]);
        } catch (PDOException $e) {
            // Silenciar error, no es crítico
        }
    }
}

