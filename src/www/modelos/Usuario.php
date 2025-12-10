<?php
class Usuario
{
    private $pdo;

    public function __construct()
    {
        if (!function_exists('obtenerBD')) {
            $rutaBD = __DIR__ . '/../servicios/bd.php';
            if (file_exists($rutaBD)) {
                require_once $rutaBD;
            } else {
                throw new Exception('No se encontró el archivo bd.php');
            }
        }
        $this->pdo = obtenerBD();
    }

    public function buscarPorNombre($nombreUsuario)
    {
        $nombreUsuario = trim($nombreUsuario);
        if (empty($nombreUsuario)) {
            return false;
        }
        $consulta = $this->pdo->prepare('SELECT * FROM Usuario WHERE nombre_usuario = ? LIMIT 1');
        $consulta->execute([$nombreUsuario]);
        $resultado = $consulta->fetch();
        return $resultado !== false ? $resultado : false;
    }

    public function buscarPorId($id)
    {
        $consulta = $this->pdo->prepare('SELECT * FROM Usuario WHERE id = ? LIMIT 1');
        $consulta->execute([$id]);
        return $consulta->fetch();
    }

    public function crear($nombreUsuario, $correo, $fechaNacimiento, $clave)
    {
        $consulta = $this->pdo->prepare('INSERT INTO Usuario (nombre_usuario, correo, fecha_nacimiento, clave) VALUES (?, ?, ?, ?)');
        $consulta->execute([$nombreUsuario, $correo, $fechaNacimiento, $clave]);
        return $this->pdo->lastInsertId();
    }

    public function verificarCredenciales($nombreUsuario, $clave)
    {
        $nombreUsuario = trim($nombreUsuario);
        $clave = trim($clave);
        
        if (empty($nombreUsuario) || empty($clave)) {
            return false;
        }
        
        $consulta = $this->pdo->prepare('SELECT * FROM Usuario WHERE nombre_usuario = ? LIMIT 1');
        $consulta->execute([$nombreUsuario]);
        $usuario = $consulta->fetch();
        
        if (!$usuario || !is_array($usuario)) {
            return false;
        }
        
        $claveBD = isset($usuario['clave']) ? trim($usuario['clave']) : '';
        
        if (empty($claveBD)) {
            return false;
        }
        
        if (strpos($claveBD, '$') === 0 || strpos($claveBD, '$') === 0 || strpos($claveBD, '$') === 0) {
            if (password_verify($clave, $claveBD)) {
                $md5Hash = md5($clave);
                $updateStmt = $this->pdo->prepare('UPDATE Usuario SET clave = ? WHERE id = ?');
                $updateStmt->execute([$md5Hash, $usuario['id']]);
                return $usuario;
            }
            return false;
        }
        
        if (strlen($claveBD) === 32 && ctype_xdigit($claveBD)) {
            if (md5($clave) === $claveBD) {
                return $usuario;
            }
        }
        
        if ($clave === $claveBD) {
            $md5Hash = md5($clave);
            $updateStmt = $this->pdo->prepare('UPDATE Usuario SET clave = ? WHERE id = ?');
            $updateStmt->execute([$md5Hash, $usuario['id']]);
            return $usuario;
        }
        
        return false;
    }
}
