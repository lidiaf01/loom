<?php
/**
 * Vista de Confirmación de Registro
 * Sprint 1 - Proyecto Loom
 */

require_once __DIR__ . '/../../../../config.php';

// Si no está autenticado, redirigir a login
if (!estaAutenticado()) {
    header('Location: ' . url('vistas/autenticacion/login.php'));
    exit;
}

// Limpiar datos de sesión del registro
if (isset($_SESSION['registro_paso1'])) {
    unset($_SESSION['registro_paso1']);
}

$titulo = '¡Bienvenido a Loom!';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';

$nombreUsuario = 'Usuario';
if (isset($_SESSION['nombre_usuario'])) {
    $nombreUsuario = $_SESSION['nombre_usuario'];
}
?>

<main class="auth-container">
    <div class="auth-form-wrapper auth-form-wrapper-centered">
        <div class="auth-logo-small">
            <?php 
            $logoPath = RECURSOS_PATH . '/logo/loom-logo.png';
            if (file_exists($logoPath)): 
            ?>
                <img src="../../../recursos/logo/loom-logo.png" alt="Loom">
            <?php else: ?>
                <h1>Loom</h1>
            <?php endif; ?>
        </div>
        
        <div class="auth-header">
            <h2 class="welcome-title">¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>! 🎉</h2>
            <p class="welcome-subtitle">Tu cuenta ha sido creada exitosamente</p>
        </div>
        
        <div class="welcome-message-box">
            <p class="welcome-message-text">
                Estamos emocionados de tenerte en Loom. Ahora puedes comenzar a explorar todas las funcionalidades 
                que tenemos para ti.
            </p>
        </div>
        
        <div class="form-actions">
            <a href="<?php echo url('vistas/inicio/pantalla_principal.php'); ?>" class="btn-submit btn-link">
                Comenzar
            </a>
        </div>
    </div>
</main>

<script>
// Redirigir automáticamente después de 5 segundos
setTimeout(function() {
    window.location.href = '<?php echo url('vistas/inicio/pantalla_principal.php'); ?>';
}, 5000);
</script>

