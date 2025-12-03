<?php
// Sprint 1 - Lidia

require_once __DIR__ . '/../../config.php';

// Si ya está autenticado, redirigir a inicio
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
        <div class="auth-header">
            <h2>Iniciar sesión</h2>
            <p>Bienvenido de vuelta a Loom</p>
        </div>
        
        <form id="formLogin" class="auth-form" method="POST" action="<?php echo url('controladores/auth_router.php'); ?>">
            <input type="hidden" name="action" value="login">
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    placeholder="tu@email.com"
                    autocomplete="email"
                >
                <span class="error-message" id="error_email"></span>
            </div>
            
            <div class="form-group">
                <label for="clave">Clave *</label>
                <input 
                    type="password" 
                    id="clave" 
                    name="clave" 
                    required
                    placeholder="Tu clave"
                    autocomplete="current-password"
                >
                <span class="error-message" id="error_clave"></span>
            </div>
            
            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="recordar" value="1">
                    <span>Recordar sesión</span>
                </label>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit" id="btnLogin">
                    Iniciar sesión
                </button>
            </div>
            
            <div class="form-footer">
                <p>¿No tienes cuenta? <a href="<?php echo url('vistas/autenticacion/registro.php'); ?>">Regístrate aquí</a></p>
            </div>
        </form>
        
        <div id="mensajeResultado" class="mensaje-resultado"></div>
    </div>
</main>

<script src="/loom/js/validaciones.js"></script>
<script src="/loom/js/auth.js"></script>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>

