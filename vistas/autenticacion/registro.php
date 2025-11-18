<?php
require_once __DIR__ . '/../../config.php';

if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
    exit;
}

$titulo = 'Registro - Paso 1';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="auth-container">
    <div style="display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 450px;">
        <div style="text-align: center; margin-bottom: 1.5rem; width: 100%;">
            <?php 
            $logoPath = RECURSOS_PATH . '/logo/loom-logo.png';
            if (file_exists($logoPath)): 
            ?>
                <img src="/loom/recursos/logo/loom-logo.png" alt="Loom" style="height: 120px; max-width: 350px; width: auto; display: block; margin: 0 auto;">
            <?php else: ?>
                <h1 style="font-size: 2.5rem; margin: 0;">Loom</h1>
            <?php endif; ?>
        </div>
        
        <div class="auth-form-wrapper" style="margin-left: 1rem; margin-right: 1rem;">
        <div class="auth-header">
            <h2>Crear cuenta</h2>
        </div>
        
        <form class="auth-form" method="POST" action="<?php echo url('vistas/autenticacion/registro_paso2.php'); ?>" id="formRegistroPaso1">
            <div class="form-group">
                <label for="nombre_usuario">Nombre de usuario *</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required minlength="3" maxlength="50" placeholder="Ej: juan_perez" autocomplete="username">
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required placeholder="tu@email.com" autocomplete="email">
            </div>
            
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de nacimiento *</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required max="<?php echo date('Y-m-d', strtotime('-' . EDAD_MINIMA . ' years')); ?>" autocomplete="bday">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Continuar</button>
            </div>
            
            <div class="form-footer">
                <p>¿Ya tienes cuenta? <a href="<?php echo url('vistas/autenticacion/login.php'); ?>">Inicia sesión</a></p>
            </div>
        </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
