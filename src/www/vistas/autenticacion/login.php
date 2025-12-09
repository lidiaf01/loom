<?php
require_once __DIR__ . '/../../config.php';

if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
    exit;
}

$titulo = 'Iniciar Sesión';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <div class="auth-form-wrapper">
        <h2>Iniciar sesión</h2>
        
        <form id="formLogin" method="POST" action="<?php echo url('controladores/auth_router.php'); ?>">
            <input type="hidden" name="action" value="login">
            
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

<script src="<?php echo url('js/auth.js'); ?>"></script>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>

