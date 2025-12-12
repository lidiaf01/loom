<?php
require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../controladores/PerfilController.php';

requerirAutenticacion();

$controller = new PerfilController();
$usuario = $controller->editar();

if (!$usuario) {
    header('Location: ' . ASSETS_URL . '/?page=perfil');
    exit;
}

$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_perfil'])) {
    // El controlador manejará esto vía AJAX, pero por si acaso
    $mensaje = 'Por favor, usa el formulario correctamente';
    $tipoMensaje = 'error';
}

$titulo = 'Editar Perfil';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main>
    <h1>Editar Perfil</h1>
    
    <?php if ($mensaje): ?>
        <div class="mensaje-<?php echo $tipoMensaje; ?>">
            <?php echo htmlspecialchars($mensaje); ?>
        </div>
    <?php endif; ?>
    
    <form id="formEditarPerfil" method="POST" action="<?php echo ASSETS_URL; ?>/src/www/controladores/perfil_router.php?action=actualizar">
        <div>
            <label for="nombre_usuario">Nombre de usuario *</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" 
                   value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>" 
                   required minlength="3" maxlength="50" 
                   pattern="[a-zA-Z0-9_]+" 
                   title="Solo letras, números y guiones bajos">
                <span id="error_nombre_usuario" class="error-message"></span>
        </div>
        
        <div>
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" 
                   value="<?php echo htmlspecialchars($usuario['email']); ?>" 
                   required>
                <span id="error_email" class="error-message"></span>
        </div>
        
        <div>
            <label for="biografia">Biografía (máximo 500 caracteres)</label>
            <textarea id="biografia" name="biografia" maxlength="500" rows="5"><?php echo htmlspecialchars($usuario['biografia'] ?? ''); ?></textarea>
            <span id="contador_biografia">0/500</span>
                <span id="error_biografia" class="error-message"></span>
        </div>
        
        <div>
            <label for="fecha_nacimiento">Fecha de nacimiento *</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" 
                   value="<?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?>" 
                   required 
                   max="<?php echo date('Y-m-d', strtotime('-' . EDAD_MINIMA . ' years')); ?>">
                <span id="error_fecha_nacimiento" class="error-message"></span>
        </div>
        
        <div>
            <button type="submit">Guardar cambios</button>
            <a href="<?php echo ASSETS_URL; ?>/?page=perfil">Cancelar</a>
        </div>
    </form>
    
    <hr>
    
    <h2>Cambiar foto de perfil</h2>
    <form id="formSubirFoto" method="POST" enctype="multipart/form-data" 
          action="<?php echo ASSETS_URL; ?>/src/www/controladores/perfil_router.php?action=subirFoto">
        <div>
            <label for="foto_perfil">Seleccionar imagen (JPG, PNG, WebP - máx. 5MB)</label>
            <input type="file" id="foto_perfil" name="foto_perfil" 
                   accept="image/jpeg,image/png,image/webp" required>
            <span id="error_foto_perfil" style="color: red;"></span>
        </div>
        
        <div id="preview_foto" class="preview-foto-container">
            <?php if (!empty($usuario['foto_perfil']) && $usuario['foto_perfil'] !== 'default_avatar.png'): ?>
                <img src="<?php echo ASSETS_URL; ?>/src/www/uploads/perfiles/<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" 
                     alt="Foto actual" class="preview-foto">
            <?php endif; ?>
        </div>
        
        <div>
            <button type="submit">Subir foto</button>
        </div>
    </form>
</main>


<?php include __DIR__ . '/../plantilla/nav_bottom.php'; ?>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>

