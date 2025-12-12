<?php
/**
 * Modelo de Diario
 * 
 * Gestiona todas las operaciones relacionadas con entradas de diario personal
 * 
 * @package Loom
 * @subpackage Modelos
 * @author Lidia
 * @version 1.0
 */

require_once __DIR__ . '/Database.php';

class Diario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Obtiene una entrada de diario por su ID (solo si pertenece al usuario)
     * 
     * @param int $idEntrada ID de la entrada
     * @param int $idUsuario ID del usuario propietario
     * @return array|false Datos de la entrada si existe, false si no
     */
    public function obtenerPorId($idEntrada, $idUsuario)
    {
        try {
            $sql = "SELECT id_entrada, id_usuario, titulo, contenido, fecha_entrada, 
                    estado_animo, fecha_creacion, fecha_actualizacion
                    FROM diario 
                    WHERE id_entrada = :id_entrada AND id_usuario = :id_usuario LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_entrada' => $idEntrada,
                ':id_usuario' => $idUsuario
            ]);
            $entrada = $stmt->fetch();
            
            return $entrada ?: false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Obtiene todas las entradas de un usuario con paginación
     * 
     * @param int $idUsuario ID del usuario
     * @param int $pagina Número de página (empezando en 1)
     * @param int $porPagina Cantidad de entradas por página
     * @return array Array con 'entradas' y 'total'
     */
    public function obtenerTodas($idUsuario, $pagina = 1, $porPagina = 10)
    {
        try {
            $offset = ($pagina - 1) * $porPagina;

            $sql = "SELECT id_entrada, titulo, contenido, fecha_entrada, estado_animo, 
                    fecha_creacion, fecha_actualizacion
                    FROM diario 
                    WHERE id_usuario = :id_usuario 
                    ORDER BY fecha_entrada DESC 
                    LIMIT :limit OFFSET :offset";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $entradas = $stmt->fetchAll();
            $total = $this->contar($idUsuario);

            return [
                'entradas' => $entradas,
                'total' => $total,
                'pagina' => $pagina,
                'por_pagina' => $porPagina,
                'total_paginas' => ceil($total / $porPagina)
            ];
        } catch (Exception $e) {
            return ['entradas' => [], 'total' => 0, 'pagina' => 1, 'por_pagina' => $porPagina, 'total_paginas' => 0];
        }
    }

    /**
     * Crea una nueva entrada de diario
     * 
     * @param array $datos Array con id_usuario, titulo, contenido, fecha_entrada, estado_animo
     * @return array Resultado con 'exito', 'mensaje' y 'id_entrada' si es exitoso
     */
    public function crear($datos)
    {
        try {
            $sql = "INSERT INTO diario (id_usuario, titulo, contenido, fecha_entrada, estado_animo)
                    VALUES (:id_usuario, :titulo, :contenido, :fecha_entrada, :estado_animo)";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $datos['id_usuario'],
                ':titulo' => $datos['titulo'] ?? null,
                ':contenido' => $datos['contenido'],
                ':fecha_entrada' => $datos['fecha_entrada'] ?? date('Y-m-d H:i:s'),
                ':estado_animo' => $datos['estado_animo'] ?? null
            ]);

            return [
                'exito' => true,
                'mensaje' => 'Entrada creada correctamente',
                'id_entrada' => $this->pdo->lastInsertId()
            ];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error al crear entrada: ' . $e->getMessage()];
        }
    }

    /**
     * Actualiza una entrada de diario existente
     * 
     * @param int $idEntrada ID de la entrada
     * @param int $idUsuario ID del usuario propietario
     * @param array $datos Array con titulo, contenido, fecha_entrada, estado_animo
     * @return array Resultado con 'exito' y 'mensaje'
     */
    public function actualizar($idEntrada, $idUsuario, $datos)
    {
        try {
            // Verificar que la entrada pertenece al usuario
            $entrada = $this->obtenerPorId($idEntrada, $idUsuario);
            if (!$entrada) {
                return ['exito' => false, 'mensaje' => 'Entrada no encontrada o no tienes permisos'];
            }

            $campos = [];
            $valores = [
                ':id_entrada' => $idEntrada,
                ':id_usuario' => $idUsuario
            ];

            if (isset($datos['titulo'])) {
                $campos[] = 'titulo = :titulo';
                $valores[':titulo'] = $datos['titulo'];
            }
            if (isset($datos['contenido'])) {
                $campos[] = 'contenido = :contenido';
                $valores[':contenido'] = $datos['contenido'];
            }
            if (isset($datos['fecha_entrada'])) {
                $campos[] = 'fecha_entrada = :fecha_entrada';
                $valores[':fecha_entrada'] = $datos['fecha_entrada'];
            }
            if (isset($datos['estado_animo'])) {
                $campos[] = 'estado_animo = :estado_animo';
                $valores[':estado_animo'] = $datos['estado_animo'];
            }

            if (empty($campos)) {
                return ['exito' => false, 'mensaje' => 'No hay datos para actualizar'];
            }

            $sql = "UPDATE diario SET " . implode(', ', $campos) . " 
                    WHERE id_entrada = :id_entrada AND id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($valores);

            return ['exito' => true, 'mensaje' => 'Entrada actualizada correctamente'];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error al actualizar entrada: ' . $e->getMessage()];
        }
    }

    /**
     * Elimina una entrada de diario
     * 
     * @param int $idEntrada ID de la entrada
     * @param int $idUsuario ID del usuario propietario
     * @return array Resultado con 'exito' y 'mensaje'
     */
    public function eliminar($idEntrada, $idUsuario)
    {
        try {
            // Verificar que la entrada pertenece al usuario
            $entrada = $this->obtenerPorId($idEntrada, $idUsuario);
            if (!$entrada) {
                return ['exito' => false, 'mensaje' => 'Entrada no encontrada o no tienes permisos'];
            }

            $sql = "DELETE FROM diario WHERE id_entrada = :id_entrada AND id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_entrada' => $idEntrada,
                ':id_usuario' => $idUsuario
            ]);

            return ['exito' => true, 'mensaje' => 'Entrada eliminada correctamente'];
        } catch (Exception $e) {
            return ['exito' => false, 'mensaje' => 'Error al eliminar entrada: ' . $e->getMessage()];
        }
    }

    /**
     * Busca entradas de diario por término
     * 
     * @param int $idUsuario ID del usuario
     * @param string $termino Término de búsqueda
     * @param int $pagina Número de página
     * @return array Array con 'entradas' y 'total'
     */
    public function buscar($idUsuario, $termino, $pagina = 1)
    {
        try {
            $porPagina = 10;
            $offset = ($pagina - 1) * $porPagina;
            $busqueda = '%' . $termino . '%';

            $sql = "SELECT id_entrada, titulo, contenido, fecha_entrada, estado_animo, 
                    fecha_creacion, fecha_actualizacion
                    FROM diario 
                    WHERE id_usuario = :id_usuario 
                    AND (titulo LIKE :busqueda OR contenido LIKE :busqueda)
                    ORDER BY fecha_entrada DESC 
                    LIMIT :limit OFFSET :offset";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id_usuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindValue(':busqueda', $busqueda, PDO::PARAM_STR);
            $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $entradas = $stmt->fetchAll();

            // Contar total de resultados
            $sqlCount = "SELECT COUNT(*) FROM diario 
                        WHERE id_usuario = :id_usuario 
                        AND (titulo LIKE :busqueda OR contenido LIKE :busqueda)";
            $stmtCount = $this->pdo->prepare($sqlCount);
            $stmtCount->execute([
                ':id_usuario' => $idUsuario,
                ':busqueda' => $busqueda
            ]);
            $total = $stmtCount->fetchColumn();

            return [
                'entradas' => $entradas,
                'total' => $total,
                'pagina' => $pagina,
                'por_pagina' => $porPagina,
                'total_paginas' => ceil($total / $porPagina)
            ];
        } catch (Exception $e) {
            return ['entradas' => [], 'total' => 0, 'pagina' => 1, 'por_pagina' => 10, 'total_paginas' => 0];
        }
    }

    /**
     * Cuenta el total de entradas de un usuario
     * 
     * @param int $idUsuario ID del usuario
     * @return int Número total de entradas
     */
    public function contar($idUsuario)
    {
        try {
            $sql = "SELECT COUNT(*) FROM diario WHERE id_usuario = :id_usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id_usuario' => $idUsuario]);
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Obtiene la entrada anterior (más antigua) a la entrada actual
     * 
     * @param int $idEntrada ID de la entrada actual
     * @param int $idUsuario ID del usuario
     * @return array|false Datos de la entrada anterior o false si no existe
     */
    public function obtenerAnterior($idEntrada, $idUsuario)
    {
        try {
            // Primero obtener la fecha de la entrada actual
            $entradaActual = $this->obtenerPorId($idEntrada, $idUsuario);
            if (!$entradaActual) {
                return false;
            }

            $sql = "SELECT id_entrada, titulo, fecha_entrada 
                    FROM diario 
                    WHERE id_usuario = :id_usuario 
                    AND fecha_entrada < :fecha_entrada
                    ORDER BY fecha_entrada DESC 
                    LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $idUsuario,
                ':fecha_entrada' => $entradaActual['fecha_entrada']
            ]);
            
            return $stmt->fetch() ?: false;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Obtiene la entrada siguiente (más reciente) a la entrada actual
     * 
     * @param int $idEntrada ID de la entrada actual
     * @param int $idUsuario ID del usuario
     * @return array|false Datos de la entrada siguiente o false si no existe
     */
    public function obtenerSiguiente($idEntrada, $idUsuario)
    {
        try {
            // Primero obtener la fecha de la entrada actual
            $entradaActual = $this->obtenerPorId($idEntrada, $idUsuario);
            if (!$entradaActual) {
                return false;
            }

            $sql = "SELECT id_entrada, titulo, fecha_entrada 
                    FROM diario 
                    WHERE id_usuario = :id_usuario 
                    AND fecha_entrada > :fecha_entrada
                    ORDER BY fecha_entrada ASC 
                    LIMIT 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_usuario' => $idUsuario,
                ':fecha_entrada' => $entradaActual['fecha_entrada']
            ]);
            
            return $stmt->fetch() ?: false;
        } catch (Exception $e) {
            return false;
        }
    }
}

