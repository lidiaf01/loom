<?php
require_once __DIR__ . '/../../../../config.php';

if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=inicio');
    exit;
}

$titulo = 'Registro';
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
        <div class="auth-header">
            <h2>Crear cuenta</h2>
            <p>Información básica</p>
        </div>
        
        <form id="formRegistro" method="POST" action="<?php echo ASSETS_URL; ?>/?page=registro_paso2">
            
            <div class="form-group">
                <label for="nombre_usuario">Nombre de usuario *</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required minlength="3" maxlength="50" placeholder="juan_perez">
                <?php if (isset($_GET['error_nombre'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_nombre'])); ?></span>
                <?php else: ?>
                    <span class="error-message" id="error_nombre_usuario"></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required placeholder="tu@email.com">
                <?php if (isset($_GET['error_email'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_email'])); ?></span>
                <?php else: ?>
                    <span class="error-message" id="error_email"></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento *</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?php echo date('Y-m-d', strtotime('-' . EDAD_MINIMA . ' years')); ?>">
                <?php if (isset($_GET['error_fecha'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_fecha'])); ?></span>
                <?php else: ?>
                    <span class="error-message" id="error_fecha_nacimiento"></span>
                <?php endif; ?>
            </div>
            
            <button type="submit" id="btnRegistrar" class="btn-submit">Continuar</button>
        </form>
        
        <div class="form-footer">
            <p>¿Ya tienes cuenta? <a href="<?php echo ASSETS_URL; ?>/?page=login">Inicia sesión</a></p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>

