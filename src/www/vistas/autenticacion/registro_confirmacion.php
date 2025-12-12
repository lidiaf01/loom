<?php
/**
 * Vista de Confirmación de Registro
 * Sprint 1 - Proyecto Loom
 */

require_once __DIR__ . '/../../../../config.php';

// Si no está autenticado, redirigir a login
if (!estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=login');
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
    
    <div class="auth-form-wrapper auth-form-wrapper-centered">
        <div class="auth-logo-small">
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
        
        <div class="auth-header">
            <h2 class="welcome-title">¡Bienvenido, <?php echo htmlspecialchars($nombreUsuario); ?>!</h2>
            <p class="welcome-subtitle">Tu cuenta ha sido creada exitosamente</p>
        </div>
        
        <div class="welcome-message-box">
            <p class="welcome-message-text">
                Estamos emocionados de tenerte en Loom. Ahora puedes comenzar a explorar todas las funcionalidades 
                que tenemos para ti.
            </p>
        </div>
        
        <div class="form-actions form-actions-centered">
            <a href="<?php echo ASSETS_URL; ?>/?page=dashboard" class="btn-submit btn-link">Comenzar</a>
        </div>
    </div>
</main>

<script>
// Redirigir automáticamente después de 5 segundos
setTimeout(function() {
    window.location.href = '<?php echo ASSETS_URL; ?>/?page=dashboard';
}, 5000);
</script>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>

