<?php
require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../modelos/Usuario.php';

if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=dashboard');
    exit;
}

// Verificar que existan los datos de los pasos anteriores
if (!isset($_SESSION['registro_paso1']) || !isset($_SESSION['registro_paso2'])) {
    header('Location: ' . ASSETS_URL . '/?page=registro');
    exit;
}

$datosPaso1 = $_SESSION['registro_paso1'];
$datosPaso2 = $_SESSION['registro_paso2'];
$registroExitoso = false;
$mensajeError = '';

// Procesar registro final automáticamente (sin biografía)
// Solo procesar si aún no se ha completado el registro
if (!$registroExitoso && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Preparar datos para el registro
    $datos = [
        'nombre_usuario' => limpiar($datosPaso1['nombre_usuario']),
        'email' => limpiar($datosPaso1['email']),
        'clave' => $datosPaso2['clave'],
        'fecha_nacimiento' => limpiar($datosPaso1['fecha_nacimiento']),
        'biografia' => '' // Sin biografía
    ];
    
    // Intentar registrar el usuario
    try {
        $usuario = new Usuario();
        $resultado = $usuario->registrar($datos);
        
        if ($resultado['exito']) {
            // Iniciar sesión automáticamente tras registro
            $_SESSION['usuario_id'] = $resultado['id_usuario'];
            $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
            $_SESSION['email'] = $datos['email'];
            $_SESSION['rol'] = 'usuario';
            
            // Limpiar datos de sesión del registro
            unset($_SESSION['registro_paso1']);
            unset($_SESSION['registro_paso2']);
            
            $registroExitoso = true;
            $nombreUsuario = $datos['nombre_usuario'];
        } else {
            $mensajeError = $resultado['mensaje'] ?? 'No se pudo completar el registro. Por favor, verifica tus datos e intenta de nuevo.';
        }
    } catch (Exception $e) {
        $mensajeError = 'Error al procesar el registro: ' . $e->getMessage();
        error_log('Error en registro_paso3.php: ' . $e->getMessage());
    }
}

$titulo = 'Registro - Paso 3';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <!-- Círculos decorativos de fondo -->
    <div class="decorative-circles">
        <div class="decorative-circle circle-large-1"></div>
        <div class="decorative-circle circle-medium-1"></div>
        <div class="decorative-circle circle-large-2"></div>
        <div class="decorative-circle circle-medium-2"></div>
        <div class="decorative-circle circle-small-1"></div>
        <div class="decorative-circle circle-small-2"></div>
        <div class="decorative-circle circle-small-3"></div>
        <div class="decorative-circle circle-small-4"></div>
    </div>
    
    <div class="auth-step-container">
        <div class="auth-step-header">
            <?php 
            $logoIconPath = RECURSOS_PATH . '/logo/loom-icon.png';
            $logoPath = RECURSOS_PATH . '/logo/loom-logo.png';
            if (file_exists($logoIconPath)): 
            ?>
                <div class="logo-icon-container">
                    <img src="<?php echo LOGO_URL; ?>/loom-icon.png" alt="Loom">
                </div>
            <?php elseif (file_exists($logoPath)): ?>
                <img src="<?php echo LOGO_URL; ?>/loom-logo.png" alt="Loom" class="logo-grande">
            <?php else: ?>
                <h1 class="logo-text">Loom</h1>
            <?php endif; ?>
        </div>
        
        <div class="auth-form-wrapper">
            <?php if ($registroExitoso): ?>
                <div class="auth-header">
                    <h2 class="welcome-title">¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h2>
                    <p class="welcome-subtitle">Tu cuenta ha sido creada exitosamente</p>
                </div>
                
                <div class="welcome-message-box">
                    <p class="welcome-message-text">
                        Estamos emocionados de tenerte en Loom. Ahora puedes comenzar a explorar todas las funcionalidades que tenemos para ti.
                    </p>
                </div>
                
                <div class="form-actions form-actions-centered">
                    <a href="<?php echo ASSETS_URL; ?>/?page=dashboard" class="btn-submit btn-link">Comenzar</a>
                </div>
                
                <script>
                // Redirigir automáticamente después de 5 segundos
                setTimeout(function() {
                    window.location.href = '<?php echo ASSETS_URL; ?>/?page=dashboard';
                }, 5000);
                </script>
            <?php else: ?>
                <?php if ($mensajeError): ?>
                    <div class="error-box">
                        <p class="error-text"><?php echo htmlspecialchars($mensajeError); ?></p>
                    </div>
                    
                    <div class="form-actions">
                        <a href="<?php echo ASSETS_URL; ?>/?page=registro" class="btn-submit btn-link">Volver al inicio</a>
                    </div>
                <?php else: ?>
                    <div class="auth-header">
                        <h2>Completando registro...</h2>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
