<?php
// Sprint 1 - Lidia

require_once __DIR__ . '/../../config.php';

// Si ya está autenticado, redirigir a inicio
if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
    exit;
}

$titulo = 'Registro';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <div class="auth-form-wrapper">
        <div class="auth-header">
            <h2>Crear cuenta</h2>
            <p>Únete a Loom y comienza tu viaje</p>
        </div>
        
        <form id="formRegistro" class="auth-form" method="POST" action="<?php echo url('controladores/auth_router.php'); ?>">
            <input type="hidden" name="action" value="registrar">
            
            <div class="form-group">
                <label for="nombre_usuario">Nombre de usuario *</label>
                <input 
                    type="text" 
                    id="nombre_usuario" 
                    name="nombre_usuario" 
                    required 
                    minlength="3" 
                    maxlength="50"
                    placeholder="Ej: juan_perez"
                >
                <span class="error-message" id="error_nombre_usuario"></span>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    placeholder="tu@email.com"
                >
                <span class="error-message" id="error_email"></span>
            </div>
            
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento *</label>
                <input 
                    type="date" 
                    id="fecha_nacimiento" 
                    name="fecha_nacimiento" 
                    required
                    max="<?php echo date('Y-m-d', strtotime('-' . EDAD_MINIMA . ' years')); ?>"
                >
                <span class="error-message" id="error_fecha_nacimiento"></span>
            </div>
            
            <div class="form-group">
                <label for="clave">Clave *</label>
                <input 
                    type="password" 
                    id="clave" 
                    name="clave" 
                    required 
                    minlength="<?php echo PASSWORD_MIN_LENGTH; ?>"
                    placeholder="Mínimo 8 caracteres"
                >
                <div class="password-requirements">
                    <small>Debe contener: mayúscula, minúscula y número</small>
                </div>
                <span class="error-message" id="error_clave"></span>
            </div>
            
            <div class="form-group">
                <label for="confirmar_clave">Confirmar clave *</label>
                <input 
                    type="password" 
                    id="confirmar_clave" 
                    name="confirmar_clave" 
                    required
                    placeholder="Repite tu clave"
                >
                <span class="error-message" id="error_confirmar_clave"></span>
            </div>
            
            <div class="form-group">
                <label for="biografia">Biografía (opcional)</label>
                <textarea 
                    id="biografia" 
                    name="biografia" 
                    rows="3" 
                    maxlength="500"
                    placeholder="Cuéntanos un poco sobre ti..."
                ></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit" id="btnRegistrar">
                    Registrarse
                </button>
            </div>
            
            <div class="form-footer">
                <p>¿Ya tienes cuenta? <a href="<?php echo url('vistas/autenticacion/login.php'); ?>">Inicia sesión</a></p>
            </div>
        </form>
        
        <div id="mensajeResultado" class="mensaje-resultado"></div>
    </div>
</main>

<script src="/loom/js/validaciones.js"></script>
<script src="/loom/js/auth.js"></script>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>

