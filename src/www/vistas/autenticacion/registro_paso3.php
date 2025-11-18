<?php
// Activar mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// IMPORTANTE: No enviar headers todavía, primero recopilar toda la información
ob_start();

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../modelos/Usuario.php';

$registroExitoso = false;
$mensajeError = '';
$debugInfo = []; // Array para información de depuración
$mostrarDebug = true; // Forzar mostrar debug siempre

$debugInfo[] = '=== INICIO DE REGISTRO_PASO3.PHP ===';
$debugInfo[] = 'REQUEST_METHOD: ' . ($_SERVER['REQUEST_METHOD'] ?? 'NO DEFINIDO');
$debugInfo[] = 'REQUEST_URI: ' . ($_SERVER['REQUEST_URI'] ?? 'NO DEFINIDO');
$debugInfo[] = 'SESSION iniciada: ' . (session_status() === PHP_SESSION_ACTIVE ? 'Sí' : 'No');
$debugInfo[] = 'Session ID: ' . (session_id() ?: 'NO HAY ID');
$debugInfo[] = 'Usuario autenticado: ' . (estaAutenticado() ? 'Sí' : 'No');
$debugInfo[] = 'Registro paso1 en sesión: ' . (isset($_SESSION['registro_paso1']) ? 'Sí' : 'No');
$debugInfo[] = 'Registro paso2 en sesión: ' . (isset($_SESSION['registro_paso2']) ? 'Sí' : 'No');

// Mostrar contenido completo de sesión
$debugInfo[] = 'Contenido completo de $_SESSION:';
$debugInfo[] = print_r($_SESSION, true);

// NO redirigir, siempre mostrar la página con información de depuración
if (!isset($_SESSION['registro_paso1']) || !isset($_SESSION['registro_paso2'])) {
    $mensajeError = 'Error: No se encontraron los datos del registro en la sesión.';
    $debugInfo[] = 'Faltan datos de sesión - mostrando error';
    $debugInfo[] = 'Paso1 existe: ' . (isset($_SESSION['registro_paso1']) ? 'Sí' : 'No');
    $debugInfo[] = 'Paso2 existe: ' . (isset($_SESSION['registro_paso2']) ? 'Sí' : 'No');
    
    if (isset($_SESSION['registro_paso1'])) {
        $debugInfo[] = 'Contenido paso1: ' . print_r($_SESSION['registro_paso1'], true);
    }
    if (isset($_SESSION['registro_paso2'])) {
        $debugInfo[] = 'Contenido paso2: ' . print_r($_SESSION['registro_paso2'], true);
    }
    
    // NO redirigir, mostrar error con debug
} else {
    $datosPaso1 = $_SESSION['registro_paso1'];
    $datosPaso2 = $_SESSION['registro_paso2'];
    $nombreUsuario = isset($datosPaso1['nombre_usuario']) ? $datosPaso1['nombre_usuario'] : 'Usuario';
    
    $debugInfo[] = 'Datos paso1: ' . print_r($datosPaso1, true);
    $debugInfo[] = 'Datos paso2: ' . print_r($datosPaso2, true);

    // Preparar datos para el registro
    // NOTA: La biografía no se incluye en el registro, se puede editar después
    $datos = [
        'nombre_usuario' => isset($datosPaso1['nombre_usuario']) ? limpiar($datosPaso1['nombre_usuario']) : '',
        'email' => isset($datosPaso1['email']) ? limpiar($datosPaso1['email']) : '',
        'clave' => isset($datosPaso2['clave']) ? $datosPaso2['clave'] : '',
        'fecha_nacimiento' => isset($datosPaso1['fecha_nacimiento']) ? limpiar($datosPaso1['fecha_nacimiento']) : ''
    ];

    $debugInfo[] = 'Datos preparados: ' . print_r($datos, true);

    // Validaciones básicas
    $errores = [];
    if (empty($datos['nombre_usuario']) || strlen($datos['nombre_usuario']) < 3) {
        $errores[] = 'El nombre de usuario es inválido';
    }
    if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email es inválido';
    }
    if (empty($datos['clave']) || strlen($datos['clave']) < PASSWORD_MIN_LENGTH) {
        $errores[] = 'La clave es inválida';
    } elseif (!preg_match('/[A-Z]/', $datos['clave']) || !preg_match('/[a-z]/', $datos['clave']) || !preg_match('/[0-9]/', $datos['clave'])) {
        $errores[] = 'La clave debe contener mayúscula, minúscula y número';
    }
    if (empty($datos['fecha_nacimiento'])) {
        $errores[] = 'La fecha de nacimiento es requerida';
    } else {
        $timestampNacimiento = strtotime($datos['fecha_nacimiento']);
        $timestampHoy = time();
        $diferenciaSegundos = $timestampHoy - $timestampNacimiento;
        $edad = floor($diferenciaSegundos / (365.25 * 24 * 60 * 60));
        if ($edad < EDAD_MINIMA) {
            $errores[] = 'Debes tener al menos ' . EDAD_MINIMA . ' años para registrarte';
        }
    }

    $debugInfo[] = 'Errores de validación: ' . (empty($errores) ? 'Ninguno' : implode(', ', $errores));

    // Si hay errores de validación, mostrar mensaje
    if (!empty($errores)) {
        $mensajeError = implode(', ', $errores);
        $debugInfo[] = 'Validación falló - mostrando errores';
    } else {
        // Intentar registrar el usuario
        try {
            // Verificar conexión a la base de datos antes de continuar
            require_once __DIR__ . '/../../modelos/Database.php';
            $db = Database::getInstance()->getConnection();
            $debugInfo[] = 'Conexión DB: ' . ($db ? 'OK' : 'FALLO');
            
            if (!$db) {
                throw new Exception('No se pudo conectar a la base de datos. Verifica config.php');
            }
            
            // Verificar que la tabla existe
            try {
                $stmt = $db->query("SHOW TABLES LIKE 'usuarios'");
                $tablaExiste = $stmt->rowCount() > 0;
                $debugInfo[] = 'Tabla usuarios existe: ' . ($tablaExiste ? 'Sí' : 'No');
                
                if (!$tablaExiste) {
                    throw new Exception('La tabla usuarios no existe en la base de datos');
                }
            } catch (PDOException $e) {
                $debugInfo[] = 'Error al verificar tabla: ' . $e->getMessage();
                throw new Exception('Error al verificar la base de datos: ' . $e->getMessage());
            }
            
            $usuario = new Usuario();
            $debugInfo[] = 'Instancia de Usuario creada';
            
            $resultado = $usuario->registrar($datos);
            $debugInfo[] = 'Resultado del registro: ' . print_r($resultado, true);
            $debugInfo[] = 'Tipo de resultado: ' . gettype($resultado);
            $debugInfo[] = 'Resultado es null: ' . ($resultado === null ? 'Sí' : 'No');
            $debugInfo[] = 'Resultado es array: ' . (is_array($resultado) ? 'Sí' : 'No');
            
            // Verificar que el resultado sea válido
            if ($resultado === null) {
                $mensajeError = 'Error crítico: El método registrar() devolvió null. Verifica los logs del servidor.';
                $debugInfo[] = 'ERROR: resultado es null';
                error_log('ERROR CRÍTICO en registro_paso3.php - resultado es null');
            } elseif (!is_array($resultado)) {
                $mensajeError = 'Error crítico: El método registrar() devolvió un tipo inesperado: ' . gettype($resultado);
                $debugInfo[] = 'ERROR: resultado no es array';
                error_log('ERROR CRÍTICO en registro_paso3.php - resultado no es array: ' . print_r($resultado, true));
            } elseif (!isset($resultado['exito'])) {
                $mensajeError = 'Error crítico: El resultado no contiene la clave "exito". Resultado: ' . print_r($resultado, true);
                $debugInfo[] = 'ERROR: resultado no tiene clave "exito"';
                error_log('ERROR CRÍTICO en registro_paso3.php - resultado sin clave exito: ' . print_r($resultado, true));
            } elseif ($resultado['exito'] === true) {
                // Iniciar sesión automáticamente tras registro
                $_SESSION['usuario_id'] = $resultado['id_usuario'];
                $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
                $_SESSION['email'] = $datos['email'];
                $_SESSION['rol'] = 'usuario';
                
                $registroExitoso = true;
                unset($_SESSION['registro_paso1']);
                unset($_SESSION['registro_paso2']);
                $debugInfo[] = 'Registro exitoso, sesión iniciada';
            } else {
                // Obtener mensaje de error más detallado
                if (isset($resultado['mensaje']) && !empty($resultado['mensaje'])) {
                    $mensajeError = $resultado['mensaje'];
                } else {
                    $mensajeError = 'No se pudo completar el registro. Por favor, verifica tus datos e intenta de nuevo.';
                }
                
                $debugInfo[] = 'Registro falló - exito: ' . ($resultado['exito'] ?? 'no definido');
                $debugInfo[] = 'Registro falló - mensaje: ' . ($resultado['mensaje'] ?? 'no definido');
                
                // Log detallado para depuración
                error_log('Error en registro_paso3.php - Resultado: ' . print_r($resultado, true));
                error_log('Error en registro_paso3.php - Datos enviados: ' . print_r($datos, true));
            }
        } catch (PDOException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            $errorInfo = $e->errorInfo();
            
            $debugInfo[] = '=== ERROR PDOException ===';
            $debugInfo[] = 'Mensaje: ' . $errorMessage;
            $debugInfo[] = 'Código: ' . $errorCode;
            $debugInfo[] = 'SQL State: ' . ($errorInfo[0] ?? 'N/A');
            $debugInfo[] = 'Driver Code: ' . ($errorInfo[1] ?? 'N/A');
            $debugInfo[] = 'Driver Message: ' . ($errorInfo[2] ?? 'N/A');
            $debugInfo[] = 'Trace: ' . $e->getTraceAsString();
            
            error_log('Error PDOException en registro_paso3.php: ' . $errorMessage);
            error_log('Código de error: ' . $errorCode);
            error_log('Error Info: ' . print_r($errorInfo, true));
            
            // Mensaje más amigable según el tipo de error
            if ($errorCode == 23000 || (isset($errorInfo[1]) && $errorInfo[1] == 1062)) {
                // Error de duplicado
                if (stripos($errorMessage, 'email') !== false) {
                    $mensajeError = 'Este email ya está registrado. Por favor, usa otro email.';
                } elseif (stripos($errorMessage, 'nombre_usuario') !== false) {
                    $mensajeError = 'Este nombre de usuario ya está en uso. Por favor, elige otro.';
                } else {
                    $mensajeError = 'Los datos que intentas registrar ya existen en el sistema.';
                }
            } elseif (stripos($errorMessage, 'Unknown column') !== false) {
                $mensajeError = 'Error en la estructura de la base de datos. Por favor, contacta al administrador.';
            } elseif (stripos($errorMessage, 'Table') !== false && stripos($errorMessage, "doesn't exist") !== false) {
                $mensajeError = 'La tabla de usuarios no existe. Por favor, contacta al administrador.';
            } elseif (stripos($errorMessage, 'Access denied') !== false) {
                $mensajeError = 'Error de acceso a la base de datos. Por favor, contacta al administrador.';
            } else {
                $mensajeError = 'Error al guardar los datos: ' . $errorMessage;
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $debugInfo[] = '=== ERROR Exception ===';
            $debugInfo[] = 'Mensaje: ' . $errorMsg;
            $debugInfo[] = 'Tipo: ' . get_class($e);
            $debugInfo[] = 'Trace: ' . $e->getTraceAsString();
            
            error_log('Error Exception en registro_paso3.php: ' . $errorMsg);
            error_log('Tipo: ' . get_class($e));
            error_log('Trace: ' . $e->getTraceAsString());
            
            $mensajeError = 'Error al procesar el registro: ' . $errorMsg;
        }
    }
}

$debugInfo[] = '=== FIN DE PROCESAMIENTO ===';
$debugInfo[] = 'Registro exitoso: ' . ($registroExitoso ? 'Sí' : 'No');
$debugInfo[] = 'Mensaje de error: ' . $mensajeError;
$debugInfo[] = 'Session ID final: ' . session_id();
$debugInfo[] = 'Session status final: ' . (session_status() === PHP_SESSION_ACTIVE ? 'Activa' : 'Inactiva');

// Limpiar cualquier output buffer anterior
if (ob_get_level() > 0) {
    ob_end_clean();
}

$titulo = 'Registro - Paso 3';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <div style="display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 450px;">
        <div style="text-align: center; margin-bottom: 1.5rem; width: 100%;">
            <?php 
            $logoPath = RECURSOS_PATH . '/logo/loom-logo.png';
            if (file_exists($logoPath)): 
            ?>
                <img src="/loom/recursos/logo/loom-logo.png" alt="Loom" style="height: 120px; max-width: 350px; width: auto; display: block; margin: 0 auto;">
            <?php else: ?>
                <h1 style="font-size: 2.5rem; margin: 0;">Loom</h1>
            <?php endif; ?>
        </div>
        
        <div class="auth-form-wrapper" style="margin-left: 1rem; margin-right: 1rem;">
        
        <!-- SIEMPRE mostrar información de depuración primero -->
        <div style="background: #e3f2fd; border: 2px solid #2196F3; padding: 1.5rem; border-radius: 4px; margin-bottom: 2rem; text-align: left; font-size: 0.9rem;">
            <strong style="color: #1565C0; font-size: 1.1rem;">🔍 Información de depuración (SIEMPRE VISIBLE):</strong>
            <div style="background: white; padding: 1rem; margin-top: 0.5rem; border-radius: 4px; max-height: 400px; overflow-y: auto; border: 1px solid #ddd;">
                <pre style="margin: 0; white-space: pre-wrap; word-wrap: break-word; font-family: 'Courier New', monospace; font-size: 0.85rem;"><?php 
                    if (!empty($debugInfo)) {
                        foreach ($debugInfo as $info) {
                            echo htmlspecialchars($info) . "\n";
                        }
                    } else {
                        echo "No hay información de depuración disponible.\n";
                        echo "Esto puede indicar que el código no está llegando a esta sección.\n";
                    }
                    
                    // Añadir información adicional sobre la estructura de la BD
                    echo "\n=== INFORMACIÓN ADICIONAL DE BASE DE DATOS ===\n";
                    try {
                        require_once __DIR__ . '/../../modelos/Database.php';
                        $db = Database::getInstance()->getConnection();
                        $stmt = $db->query("DESCRIBE usuarios");
                        $columnas = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        echo "Columnas de la tabla usuarios:\n";
                        foreach ($columnas as $columna) {
                            $nombre = $columna['Field'];
                            $resaltar = ($nombre === 'clave') ? ' ⭐' : '';
                            echo "  - {$nombre}{$resaltar}\n";
                        }
                    } catch (Exception $e) {
                        echo "Error al obtener información de BD: " . $e->getMessage() . "\n";
                    }
                ?></pre>
            </div>
        </div>
        
        <?php if ($registroExitoso): ?>
            <div class="auth-header">
                <h2 class="welcome-title">¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario ?? 'Usuario'); ?>! 🎉</h2>
                <p class="welcome-subtitle">Tu cuenta ha sido creada exitosamente</p>
            </div>
            
            <div class="welcome-message-box" style="margin-bottom: 7rem;">
                <p class="welcome-message-text">
                    Estamos emocionados de tenerte en Loom. Ahora puedes comenzar a explorar todas las funcionalidades que tenemos para ti.
                </p>
            </div>
            
            <div class="form-actions" style="text-align: center;">
                <a href="<?php echo url('vistas/inicio/pantalla_principal.php'); ?>" class="btn-submit btn-link">Comenzar</a>
            </div>
            
            <script>
            setTimeout(function() {
                window.location.href = '<?php echo url('vistas/inicio/pantalla_principal.php'); ?>';
            }, 5000);
            </script>
        <?php else: ?>
            <div class="auth-header">
                <h2 style="color: #d32f2f;">❌ Error al completar el registro</h2>
                <div style="background: #ffebee; border: 2px solid #d32f2f; padding: 1.5rem; border-radius: 4px; margin: 1.5rem 0;">
                    <p class="error-text" style="margin: 0; color: #d32f2f; font-weight: bold; font-size: 1.1rem;">
                        <?php echo htmlspecialchars($mensajeError ?: 'Error desconocido. Por favor, revisa la información de depuración arriba.'); ?>
                    </p>
                </div>
                <?php if (empty($mensajeError) || $mensajeError === 'Error desconocido'): ?>
                    <div style="background: #fff3cd; border: 1px solid #ffc107; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                        <p style="margin: 0; color: #856404;">
                            <strong>Nota:</strong> Si no ves un mensaje de error específico arriba, revisa la sección de depuración para más detalles.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-actions" style="text-align: center; margin-top: 2rem;">
                <a href="<?php echo url('vistas/autenticacion/registro.php'); ?>" class="btn-submit btn-link">Volver al inicio</a>
            </div>
        <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
