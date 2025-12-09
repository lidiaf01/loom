<?php
require_once __DIR__ . '/../../../../config.php';

if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=inicio');
    exit;
}

$titulo = 'Error de Inicio de Sesión';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <div class="auth-form-wrapper">
        <h2>Inicio de sesión fallido</h2>
        
        <div class="error-box">
            <p style="color: #ef4444; font-size: 1.1rem; margin: 1.5rem 0;">
                ❌ No ha sido posible iniciar sesión
            </p>
            <p style="color: #6B6B6B; margin: 1rem 0;">
                Email o contraseña incorrectos. Por favor, verifica tus datos e intenta de nuevo.
            </p>
        </div>
        
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
            
            <button type="submit" id="btnLogin">Iniciar sesión</button>
            
            <p>¿No tienes cuenta? <a href="<?php echo url('vistas/autenticacion/registro.php'); ?>">Regístrate</a></p>
        </form>
        
        <div id="mensajeResultado"></div>
    </div>
</main>

<script src="/loom/src/www/js/auth.js"></script>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>
