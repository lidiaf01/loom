<?php
require_once __DIR__ . '/../../../../config.php';

if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=inicio');
    exit;
}

$titulo = 'Iniciar Sesión';
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
    
    <div class="auth-form-wrapper">
        <h2>Iniciar sesión</h2>
        
        <form id="formLogin" method="POST" action="<?php echo ASSETS_URL; ?>/src/www/controladores/auth_router.php?action=login">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="tu@email.com">
                <span class="error-message" id="error_email"></span>
            </div>
            
            <div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" id="clave" name="clave" required placeholder="Tu clave">
                <span class="error-message" id="error_clave"></span>
            </div>
            
            <button type="submit" id="btnLogin" class="btn-submit">Iniciar sesión</button>
        </form>
        
        <div class="form-footer">
            <p>¿No tienes cuenta? <a href="<?php echo ASSETS_URL; ?>/?page=registro">Regístrate</a></p>
        </div>
        
        <div id="mensajeResultado"></div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
