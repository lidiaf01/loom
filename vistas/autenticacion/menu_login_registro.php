<?php
/**
 * Menú de Login/Registro
 * Sprint 1 - Proyecto Loom
 */

require_once __DIR__ . '/../../config.php';

// Si ya está autenticado, redirigir a inicio
if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
    exit;
}

$titulo = 'Bienvenido a Loom';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-logo">
            <?php 
            $logoPath = RECURSOS_PATH . '/logo/loom-logo.png';
            if (file_exists($logoPath)): 
            ?>
                <img src="/loom/recursos/logo/loom-logo.png" alt="Loom" class="logo-grande" style="height: 120px !important; max-width: 350px !important; width: auto !important; display: block !important; margin: 0 auto 1rem auto !important;">
            <?php else: ?>
                <h1 class="logo-grande">Loom</h1>
            <?php endif; ?>
            <p class="tagline">Tu espacio para crecer y aprender</p>
        </div>
        
        <div class="auth-options">
            <a href="<?php echo url('vistas/autenticacion/login.php'); ?>" class="btn-auth btn-primary">
                Iniciar Sesión
            </a>
            <a href="<?php echo url('vistas/autenticacion/registro.php'); ?>" class="btn-auth btn-secondary">
                Registrarse
            </a>
        </div>
    </div>
</main>


