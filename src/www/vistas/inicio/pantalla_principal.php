<?php
require_once __DIR__ . '/../../../../config.php';

// Esta es la página de inicio para usuarios no autenticados
// Si ya está autenticado, redirigir a otra página
if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=dashboard');
    exit;
}

$titulo = 'Inicio';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/inicio.css">

<main class="home-container">
    <div class="home-wrapper">
        <!-- Círculos decorativos de fondo -->
        <div class="home-decorative-circles">
            <div class="decorative-circle circle-large-1"></div>
            <div class="decorative-circle circle-medium-1"></div>
            <div class="decorative-circle circle-large-2"></div>
            <div class="decorative-circle circle-medium-2"></div>
            <div class="decorative-circle circle-small-1"></div>
            <div class="decorative-circle circle-small-2"></div>
            <div class="decorative-circle circle-small-3"></div>
            <div class="decorative-circle circle-small-4"></div>
        </div>

        <!-- Header con logo -->
        <div class="home-header">
            <div class="home-logo-container">
                <?php 
                $logoIconPath = RECURSOS_PATH . '/logo/loom-icon.png';
                if (file_exists($logoIconPath)): 
                ?>
                    <img src="<?php echo LOGO_URL; ?>/loom-icon.png" alt="Loom">
                <?php else: ?>
                    <img src="<?php echo LOGO_URL; ?>/loom-logo.png" alt="Loom">
                <?php endif; ?>
            </div>
            <h1 class="home-title">Loom</h1>
        </div>

        <!-- Contenido principal -->
        <div class="home-content">
            <!-- Cards de categorías -->
            <div class="home-categories">
                <div class="category-card">
                    <div class="category-icon primary">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div class="category-info">
                        <h3 class="category-title">Salud & Bienestar</h3>
                        <p class="category-description">Cuida tu cuerpo y mente</p>
                    </div>
                </div>

                <div class="category-card">
                    <div class="category-icon secondary">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.57 14.86L22 13.43 20.57 12 17 15.57 8.43 7 12 3.43 10.57 2 9.14 3.43 7.71 2 5.57 4.14 4.14 3 2.71 4.43l1.43 1.43L2 7.71l1.43 1.43L2 10.57 3.43 12 7 8.43 15.57 17 12 20.57 13.43 22l1.43-1.43L16.29 22l2.14-2.14 1.43 1.43 1.43-1.43-1.43-1.43L22 16.29l-1.43-1.43z"/>
                        </svg>
                    </div>
                    <div class="category-info">
                        <h3 class="category-title">Ejercicio & Movimiento</h3>
                        <p class="category-description">Activa tu energía positiva</p>
                    </div>
                </div>

                <div class="category-card">
                    <div class="category-icon primary">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div class="category-info">
                        <h3 class="category-title">Hobbies & Creatividad</h3>
                        <p class="category-description">Explora tu lado artístico</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="home-actions">
            <a href="<?php echo ASSETS_URL; ?>/?page=login" class="btn-primary-action">
                <svg width="20" height="20" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M8 0C3.58 0 0 3.58 0 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm-1-9H6v2h1V5zm0 3H6v2h1V8z"/>
                </svg>
                Iniciar Sesión
            </a>

            <a href="<?php echo ASSETS_URL; ?>/?page=registro" class="btn-secondary-action">
                <svg width="24" height="20" viewBox="0 0 20 16" fill="currentColor">
                    <path d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                </svg>
                Crear Cuenta
            </a>

            <p class="home-footer-text">
                <span>¿Ya tienes cuenta?</span>
                <a href="<?php echo ASSETS_URL; ?>/?page=login"> Toca aquí</a>
            </p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
