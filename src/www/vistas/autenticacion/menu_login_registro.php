<?php
/**
 * Menú de Login/Registro
 * Sprint 1 - Proyecto Loom
 */

// Sprint 1 - Lidia

require_once __DIR__ . '/../../../../config.php';

// Si ya está autenticado, redirigir a inicio
if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=inicio');
    exit;
}

$titulo = 'Bienvenido a Loom';
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
    
    <div class="auth-wrapper">
        <div class="auth-logo">
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
                <h1 class="logo-grande">Loom</h1>
            <?php endif; ?>
            <p class="tagline">Tu espacio para crecer y aprender</p>
        </div>
        
        <div class="auth-options">
            <a href="<?php echo ASSETS_URL; ?>/?page=login" class="btn-auth btn-primary">
                Iniciar Sesión
            </a>
            <a href="<?php echo ASSETS_URL; ?>/?page=registro" class="btn-auth btn-secondary">
                Registrarse
            </a>
        </div>
        
        <div class="auth-info">
            <p>Únete a nuestra comunidad de jóvenes que comparten conocimiento y experiencias.</p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>

