<?php
/**
 * Modelo de Usuario
 * 
 * Gestiona todas las operaciones relacionadas con usuarios en la base de datos,
 * incluyendo búsqueda, creación y verificación de credenciales.
 * 
 * @package Loom
 * @subpackage Modelos
 * @author Lidia
 * @version 1.0
 */

require_once __DIR__ . '/Database.php';

class Usuario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Obtiene un usuario por su ID (sin la clave y solo si está activo)
     * 
     * @param int $id ID del usuario
     * @return array|false Datos del usuario si existe y está activo, false si no
     */
    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT id_usuario, nombre_usuario, email, fecha_nacimiento, 
                    biografia, foto_perfil, rol, fecha_registro, ultimo_acceso
                    FROM usuarios 
                    WHERE id_usuario = :id AND activo = 1 LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $usuario = $stmt->fetch();
            
            return $usuario ?: false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Registra un nuevo usuario
     * 
     * @param array $datos Array con nombre_usuario, email, clave, fecha_nacimiento, biografia
     * @return array Resultado con 'exito', 'mensaje' y 'id_usuario' si es exitoso
     */
    public function registrar($datos)
    {
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
            
            $stmt = $this->pdo->prepare($sql);
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
                'id_usuario' => $this->pdo->lastInsertId()
            ];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    
    public function existeEmail($email)
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function existeNombreUsuario($usuario)
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuario]);
        return $stmt->fetchColumn() > 0;
    }
    
    /**
     * Autentica un usuario por email y clave
     * 
     * @param string $email Email del usuario
     * @param string $clave Clave del usuario
     * @return array Resultado con 'exito', 'mensaje' y 'usuario' si es exitoso
     */
    public function autenticar($email, $clave)
    {
        try {
            $email = trim($email);
            if (empty($email) || empty($clave)) {
                return ['exito' => false, 'mensaje' => 'Email y clave son requeridos'];
            }
            
            $sql = "SELECT id_usuario, nombre_usuario, email, clave, rol, foto_perfil, biografia, activo
                    FROM usuarios WHERE email = :email LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch();
            
            if (!$usuario) {
                return ['exito' => false, 'mensaje' => 'Email o clave incorrectos'];
            }
            
            // Verificar si el usuario está activo (si la columna existe)
            if (isset($usuario['activo']) && $usuario['activo'] == 0) {
                return ['exito' => false, 'mensaje' => 'Usuario inactivo'];
            }
            
            // Verificar la clave
            if (!password_verify($clave, trim($usuario['clave']))) {
                return ['exito' => false, 'mensaje' => 'Email o clave incorrectos'];
            }
            
            // Actualizar último acceso
            $this->actualizarUltimoAcceso($usuario['id_usuario']);
            unset($usuario['clave']);
            unset($usuario['activo']);
            
            return ['exito' => true, 'mensaje' => 'Login OK', 'usuario' => $usuario];
        } catch (PDOException $e) {
            return ['exito' => false, 'mensaje' => 'Error de base de datos: ' . $e->getMessage()];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error: ' . $e->getMessage()];
        }
    }
    
    private function actualizarUltimoAcceso($id)
    {
        try {
            $sql = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            // Ignorar error
        }
    }

    /**
     * Verifica si un email existe excluyendo un usuario específico
     * 
     * @param string $email Email a verificar
     * @param int $excluirId ID del usuario a excluir de la verificación
     * @return bool True si el email existe, false si no
     */
    public function verificarUnicidadEmail($email, $excluirId)
    {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email AND id_usuario != :excluir_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':excluir_id' => $excluirId
            ]);
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Verifica si un nombre de usuario existe excluyendo un usuario específico
     * 
     * @param string $nombre Nombre de usuario a verificar
     * @param int $excluirId ID del usuario a excluir de la verificación
     * @return bool True si el nombre existe, false si no
     */
    public function verificarUnicidadNombreUsuario($nombre, $excluirId)
    {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :nombre AND id_usuario != :excluir_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':excluir_id' => $excluirId
            ]);
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Actualiza el perfil de un usuario
     * 
     * @param int $id ID del usuario
     * @param array $datos Array con nombre_usuario, email, biografia, fecha_nacimiento
     * @return array Resultado con 'exito' y 'mensaje'
     */
    public function actualizarPerfil($id, $datos)
    {
        try {
            // Verificar unicidad de email si cambió
            if (isset($datos['email']) && $this->verificarUnicidadEmail($datos['email'], $id)) {
                return ['exito' => false, 'mensaje' => 'El email ya está en uso'];
            }

            // Verificar unicidad de nombre de usuario si cambió
            if (isset($datos['nombre_usuario']) && $this->verificarUnicidadNombreUsuario($datos['nombre_usuario'], $id)) {
                return ['exito' => false, 'mensaje' => 'El nombre de usuario ya está en uso'];
            }

            // Validar edad si se actualiza fecha de nacimiento
            if (isset($datos['fecha_nacimiento'])) {
                $fecha = new DateTime($datos['fecha_nacimiento']);
                $edad = date_diff($fecha, new DateTime())->y;
                if ($edad < EDAD_MINIMA) {
                    return ['exito' => false, 'mensaje' => 'Debes tener al menos ' . EDAD_MINIMA . ' años'];
                }
            }

            // Construir query dinámicamente
            $campos = [];
            $valores = [':id' => $id];

            if (isset($datos['nombre_usuario'])) {
                $campos[] = 'nombre_usuario = :nombre_usuario';
                $valores[':nombre_usuario'] = $datos['nombre_usuario'];
            }
            if (isset($datos['email'])) {
                $campos[] = 'email = :email';
                $valores[':email'] = $datos['email'];
            }
            if (isset($datos['biografia'])) {
                $campos[] = 'biografia = :biografia';
                $valores[':biografia'] = $datos['biografia'];
            }
            if (isset($datos['fecha_nacimiento'])) {
                $campos[] = 'fecha_nacimiento = :fecha_nacimiento';
                $valores[':fecha_nacimiento'] = $datos['fecha_nacimiento'];
            }

            if (empty($campos)) {
                return ['exito' => false, 'mensaje' => 'No hay datos para actualizar'];
            }

            $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valores);

            return ['exito' => true, 'mensaje' => 'Perfil actualizado correctamente'];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error al actualizar perfil: ' . $e->getMessage()];
        }
    }

    /**
     * Actualiza la foto de perfil de un usuario
     * 
     * @param int $id ID del usuario
     * @param string $nombreArchivo Nombre del archivo de la foto
     * @return array Resultado con 'exito' y 'mensaje'
     */
    public function actualizarFoto($id, $nombreArchivo)
    {
        try {
            $sql = "UPDATE usuarios SET foto_perfil = :foto WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':foto' => $nombreArchivo,
                ':id' => $id
            ]);

            return ['exito' => true, 'mensaje' => 'Foto actualizada correctamente'];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error al actualizar foto: ' . $e->getMessage()];
        }
    }

}
