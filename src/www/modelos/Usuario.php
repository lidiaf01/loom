<?php
// Modelo Usuario

require_once __DIR__ . '/Database.php';

class Usuario {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function registrar($datos) {
        try {
            // Verificar email duplicado
            if ($this->existeEmail($datos['email'])) {
                return ['exito' => false, 'mensaje' => 'Email ya registrado'];
            }
            
            // Verificar usuario duplicado
            if ($this->existeNombreUsuario($datos['nombre_usuario'])) {
                return ['exito' => false, 'mensaje' => 'Usuario ya existe'];
            }
            
            // Validar edad
            $fecha = new DateTime($datos['fecha_nacimiento']);
            $edad = date_diff($fecha, new DateTime())->y;
            if ($edad < EDAD_MINIMA) {
                return ['exito' => false, 'mensaje' => 'Debes tener ' . EDAD_MINIMA . ' años'];
            }
            
            // Insertar usuario
            $hash = password_hash($datos['clave'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nombre_usuario, email, clave, fecha_nacimiento, biografia, rol)
                    VALUES (:usuario, :email, :clave, :fecha, :bio, 'usuario')";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':usuario' => $datos['nombre_usuario'],
                ':email' => $datos['email'],
                ':clave' => $hash,
                ':fecha' => $datos['fecha_nacimiento'],
                ':bio' => $datos['biografia'] ?? null
            ]);
            
            return [
                'exito' => true,
                'mensaje' => 'Usuario registrado',
                'id_usuario' => $this->db->lastInsertId()
            ];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    
    public function autenticar($email, $clave) {
        try {
            $sql = "SELECT id_usuario, nombre_usuario, email, clave, rol, foto_perfil, biografia
                    FROM usuarios WHERE email = :email LIMIT 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch();
            
            if (!$usuario || !password_verify($clave, $usuario['clave'])) {
                return ['exito' => false, 'mensaje' => 'Email o clave incorrectos'];
            }
            
            // Actualizar último acceso
            $this->actualizarUltimoAcceso($usuario['id_usuario']);
            unset($usuario['clave']);
            
            return ['exito' => true, 'mensaje' => 'Login OK', 'usuario' => $usuario];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    
    public function obtenerPorId($id) {
        try {
            $sql = "SELECT id_usuario, nombre_usuario, email, fecha_nacimiento, 
                    biografia, foto_perfil, rol FROM usuarios 
                    WHERE id_usuario = :id AND activo = 1 LIMIT 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            return null;
        }
    }
    
    public function existeEmail($email) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function existeNombreUsuario($usuario) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario' => $usuario]);
        return $stmt->fetchColumn() > 0;
    }
    
    private function actualizarUltimoAcceso($id) {
        try {
            $sql = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id_usuario = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            // Ignorar error
        }
    }
}

