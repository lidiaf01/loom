<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../controladores/AuthController.php';

if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
    exit;
}

if (!isset($_SESSION['registro_paso1']) || !isset($_SESSION['registro_paso2'])) {
    header('Location: ' . url('vistas/autenticacion/registro.php'));
    exit;
}

$datosPaso1 = $_SESSION['registro_paso1'];
$datosPaso2 = $_SESSION['registro_paso2'];
$nombreUsuario = $datosPaso1['nombre_usuario'];

$registroExitoso = false;
$mensajeError = '';

$metodoOriginal = $_SERVER['REQUEST_METHOD'];
$_POST['nombre_usuario'] = $datosPaso1['nombre_usuario'];
$_POST['email'] = $datosPaso1['email'];
$_POST['fecha_nacimiento'] = $datosPaso1['fecha_nacimiento'];
$_POST['contraseña'] = $datosPaso2['contraseña'];
$_POST['biografia'] = '';
$_SERVER['REQUEST_METHOD'] = 'POST';

$controller = new AuthController();
ob_start();
$controller->registrar();
$respuesta = ob_get_clean();
$_SERVER['REQUEST_METHOD'] = $metodoOriginal;

$resultado = json_decode($respuesta, true);

if ($resultado && isset($resultado['exito']) && $resultado['exito']) {
    $registroExitoso = true;
    unset($_SESSION['registro_paso1']);
    unset($_SESSION['registro_paso2']);
} else {
    // Mensaje de error amigable sin detalles técnicos
    $mensajeError = 'No se pudo completar el registro. Por favor, verifica tus datos e intenta de nuevo.';
    if (isset($resultado['mensaje']) && !empty($resultado['mensaje'])) {
        // Solo mostrar mensajes de validación amigables
        $mensajeError = $resultado['mensaje'];
    }
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
        
        <?php if ($registroExitoso): ?>
            <div class="auth-header">
                <h2 class="welcome-title">¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>! 🎉</h2>
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
                <h2>Error al completar el registro</h2>
                <p class="error-text" style="margin-bottom: 7rem;"><?php echo htmlspecialchars($mensajeError); ?></p>
            </div>
            
            <div class="form-actions" style="text-align: center;">
                <a href="<?php echo url('vistas/autenticacion/registro.php'); ?>" class="btn-submit btn-link">Volver al inicio</a>
            </div>
        <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
