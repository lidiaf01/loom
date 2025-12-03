<?php
// Sprint 1 - Lidia

require_once __DIR__ . '/Database.php';

class Usuario {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Sprint 1 - Lidia
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
            
            // Validar edad mínima
            $fechaNacimiento = new DateTime($datos['fecha_nacimiento']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;
            
            if ($edad < EDAD_MINIMA) {
                return [
                    'exito' => false,
                    'mensaje' => 'Debes tener al menos ' . EDAD_MINIMA . ' años para registrarte',
                    'id_usuario' => null
                ];
            }
            
            // Hash de la clave
            $hashClave = password_hash($datos['clave'], PASSWORD_DEFAULT);
            
            // Insertar usuario
                $sql = "INSERT INTO usuarios (nombre_usuario, email, clave, fecha_nacimiento, biografia, rol)
                    VALUES (:nombre_usuario, :email, :clave, :fecha_nacimiento, :biografia, :rol)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombre_usuario' => $datos['nombre_usuario'],
                ':email' => $datos['email'],
                ':clave' => $hashClave,
                ':fecha_nacimiento' => $datos['fecha_nacimiento'],
                ':biografia' => $datos['biografia'] ?? null,
                ':rol' => 'usuario'
            ]);
            
            $idUsuario = $this->db->lastInsertId();
            
            return [
                'exito' => true,
                'mensaje' => 'Usuario registrado exitosamente',
                'id_usuario' => $idUsuario
            ];
            
        } catch (PDOException $e) {
            return [
                'exito' => false,
                'mensaje' => 'Error al registrar usuario: ' . $e->getMessage(),
                'id_usuario' => null
            ];
        }
    }
    
    // Sprint 1 - Lidia
    public function autenticar($email, $clave) {
        try {
                $sql = "SELECT id_usuario, nombre_usuario, email, clave, rol, activo, foto_perfil, biografia
                    FROM usuarios 
                    WHERE email = :email AND activo = 1
                    LIMIT 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch();
            
            if (!$usuario) {
                return [
                    'exito' => false,
                    'mensaje' => 'Email o clave incorrectos',
                    'usuario' => null
                ];
            }
            
            // Verificar clave
            if (!password_verify($clave, $usuario['clave'])) {
                return [
                    'exito' => false,
                    'mensaje' => 'Email o clave incorrectos',
                    'usuario' => null
                ];
            }
            
            // Actualizar último acceso
            $this->actualizarUltimoAcceso($usuario['id_usuario']);
            
            // Eliminar clave del array antes de devolver
            unset($usuario['clave']);
            
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
    
    // Sprint 1 - Lidia
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
    
    // Sprint 1 - Lidia
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
    
    // Sprint 1 - Lidia
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
    
    // Sprint 1 - Lidia
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

