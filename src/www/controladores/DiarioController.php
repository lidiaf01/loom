<?php
/**
 * Controlador de Diario
 * 
 * Gestiona las operaciones relacionadas con el diario personal
 * 
 * @package Loom
 * @subpackage Controladores
 */

require_once __DIR__ . '/../modelos/Diario.php';

class DiarioController
{
    private $diario;

    public function __construct()
    {
        $this->diario = new Diario();
    }

    /**
     * Lista todas las entradas del diario con paginación
     */
    public function listar()
    {
        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            header('Location: ' . ASSETS_URL . '/?page=login');
            exit;
        }

        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $termino = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

        if (!empty($termino)) {
            $resultado = $this->diario->buscar($idUsuario, $termino, $pagina);
        } else {
            $resultado = $this->diario->obtenerTodas($idUsuario, $pagina);
        }

        return $resultado;
    }

    /**
     * Muestra una entrada individual del diario con navegación
     */
    public function mostrar($id)
    {
        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            header('Location: ' . ASSETS_URL . '/?page=login');
            exit;
        }

        $entrada = $this->diario->obtenerPorId($id, $idUsuario);
        if (!$entrada) {
            header('Location: ' . ASSETS_URL . '/?page=diario');
            exit;
        }

        // Obtener entradas anterior y siguiente para navegación
        $entrada['anterior'] = $this->diario->obtenerAnterior($id, $idUsuario);
        $entrada['siguiente'] = $this->diario->obtenerSiguiente($id, $idUsuario);

        return $entrada;
    }

    /**
     * Muestra formulario de creación o procesa la creación
     */
    public function crear()
    {
        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            header('Location: ' . ASSETS_URL . '/?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->procesarCrear($idUsuario);
        }

        return null; // Mostrar formulario
    }

    /**
     * Procesa la creación de una entrada
     */
    private function procesarCrear($idUsuario)
    {
        $datos = [
            'id_usuario' => $idUsuario,
            'titulo' => limpiar($_POST['titulo'] ?? ''),
            'contenido' => trim($_POST['contenido'] ?? ''),
            'fecha_entrada' => date('Y-m-d H:i:s'), // Siempre usar la fecha actual
            'estado_animo' => $_POST['estado_animo'] ?? null
        ];

        // Validaciones
        $errores = $this->validarEntrada($datos, true); // true = es creación
        if (!empty($errores)) {
            return [
                'exito' => false,
                'mensaje' => implode(', ', $errores),
                'datos' => $datos
            ];
        }

        $resultado = $this->diario->crear($datos);
        
        if ($resultado['exito']) {
            return [
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => ASSETS_URL . '/?page=diario'
            ];
        }

        return [
            'exito' => false,
            'mensaje' => $resultado['mensaje'],
            'datos' => $datos
        ];
    }

    /**
     * Muestra formulario de edición o procesa la edición
     */
    public function editar($id)
    {
        $idUsuario = obtenerUsuarioId();
        if (!$idUsuario) {
            header('Location: ' . ASSETS_URL . '/?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->procesarEditar($id, $idUsuario);
        }

        // Mostrar formulario con datos existentes
        return $this->mostrar($id);
    }

    /**
     * Procesa la edición de una entrada
     */
    private function procesarEditar($idEntrada, $idUsuario)
    {
        // Obtener la entrada existente para mantener la fecha original
        $entradaExistente = $this->diario->obtenerPorId($idEntrada, $idUsuario);
        if (!$entradaExistente) {
            return [
                'exito' => false,
                'mensaje' => 'Entrada no encontrada',
                'datos' => []
            ];
        }

        $datos = [
            'titulo' => limpiar($_POST['titulo'] ?? ''),
            'contenido' => trim($_POST['contenido'] ?? ''),
            'fecha_entrada' => $entradaExistente['fecha_entrada'], // Mantener la fecha original
            'estado_animo' => $_POST['estado_animo'] ?? null
        ];

        // Validaciones
        $errores = $this->validarEntrada($datos, false); // false = es edición
        if (!empty($errores)) {
            return [
                'exito' => false,
                'mensaje' => implode(', ', $errores),
                'datos' => $datos
            ];
        }

        // No actualizar la fecha_entrada al editar
        unset($datos['fecha_entrada']);
        
        $resultado = $this->diario->actualizar($idEntrada, $idUsuario, $datos);
        
        if ($resultado['exito']) {
            return [
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => ASSETS_URL . '/?page=diario'
            ];
        }

        return [
            'exito' => false,
            'mensaje' => $resultado['mensaje'],
            'datos' => $datos
        ];
    }

    /**
     * Procesa la eliminación de una entrada
     */
    public function eliminar($id)
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

        $resultado = $this->diario->eliminar($id, $idUsuario);

        if ($resultado['exito']) {
            echo json_encode([
                'exito' => true,
                'mensaje' => $resultado['mensaje'],
                'redirect' => ASSETS_URL . '/?page=diario'
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['exito' => false, 'mensaje' => $resultado['mensaje']]);
        }
    }

    /**
     * Valida los datos de una entrada
     * 
     * @param array $datos Datos a validar
     * @param bool $esCreacion Si es true, no valida fecha (se usa la actual)
     */
    private function validarEntrada($datos, $esCreacion = false)
    {
        $errores = [];

        if (!empty($datos['titulo']) && strlen($datos['titulo']) > 100) {
            $errores[] = 'El título no puede exceder 100 caracteres';
        }

        if (empty($datos['contenido']) || trim($datos['contenido']) === '') {
            $errores[] = 'El contenido es requerido';
        }

        // Solo validar fecha si no es creación (en creación siempre es la fecha actual)
        if (!$esCreacion && !empty($datos['fecha_entrada'])) {
            $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $datos['fecha_entrada']);
            if (!$fecha) {
                $fecha = DateTime::createFromFormat('Y-m-d', $datos['fecha_entrada']);
            }
            if (!$fecha) {
                $errores[] = 'Fecha inválida';
            }
        }

        $estadosPermitidos = ['feliz', 'triste', 'neutral', 'ansioso', 'emocionado', 'relajado', 'estresado', null];
        if (!empty($datos['estado_animo']) && !in_array($datos['estado_animo'], $estadosPermitidos)) {
            $errores[] = 'Estado de ánimo inválido';
        }

        return $errores;
    }
}

