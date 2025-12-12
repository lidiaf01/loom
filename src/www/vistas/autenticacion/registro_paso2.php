<?php
require_once __DIR__ . '/../../../../config.php';

if (estaAutenticado()) {
    header('Location: ' . ASSETS_URL . '/?page=dashboard');
    exit;
}

// Procesar datos del paso 1
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['fecha_nacimiento']) && !isset($_POST['clave'])) {
    $nombreUsuario = limpiar($_POST['nombre_usuario']);
    $email = limpiar($_POST['email']);
    $fechaNacimiento = limpiar($_POST['fecha_nacimiento']);
    
    $errores = [];
    if (empty($nombreUsuario) || strlen($nombreUsuario) < 3) {
        $errores[] = 'error_nombre=Nombre+inválido';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'error_email=Email+inválido';
    }
    if (empty($fechaNacimiento)) {
        $errores[] = 'error_fecha=Fecha+requerida';
    } else {
        $timestampNacimiento = strtotime($fechaNacimiento);
        $timestampHoy = time();
        $edad = floor(($timestampHoy - $timestampNacimiento) / (365.25 * 24 * 60 * 60));
        if ($edad < EDAD_MINIMA) {
            $errores[] = 'error_fecha=Debes+tener+al+menos+' . EDAD_MINIMA . '+años';
        }
    }
    
    if (!empty($errores)) {
        $urlBase = ASSETS_URL . '/?page=registro';
        $separador = (strpos($urlBase, '?') !== false) ? '&' : '?';
        header('Location: ' . $urlBase . $separador . implode('&', $errores));
        exit;
    }
    
    $_SESSION['registro_paso1'] = [
        'nombre_usuario' => $nombreUsuario,
        'email' => $email,
        'fecha_nacimiento' => $fechaNacimiento
    ];
}

if (!isset($_SESSION['registro_paso1'])) {
    header('Location: ' . ASSETS_URL . '/?page=registro');
    exit;
}

// Procesar datos del paso 2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave'])) {
    $clave = $_POST['clave'];
    $confirmarClave = isset($_POST['confirmar_clave']) ? $_POST['confirmar_clave'] : '';
    
    $errores = [];
    if (empty($clave) || strlen($clave) < PASSWORD_MIN_LENGTH) {
        $errores[] = 'error_clave=Clave+inválida';
    } elseif (!preg_match('/[A-Z]/', $clave) || !preg_match('/[a-z]/', $clave) || !preg_match('/[0-9]/', $clave)) {
        $errores[] = 'error_clave=Debe+contener+mayúscula,+minúscula+y+número';
    }
    if ($clave !== $confirmarClave) {
        $errores[] = 'error_confirmar=Las+claves+no+coinciden';
    }
    
    if (!empty($errores)) {
        $urlBase = ASSETS_URL . '/?page=registro_paso2';
        $separador = (strpos($urlBase, '?') !== false) ? '&' : '?';
        header('Location: ' . $urlBase . $separador . implode('&', $errores));
        exit;
    }
    
    $_SESSION['registro_paso2'] = ['clave' => $clave];
    header('Location: ' . ASSETS_URL . '/?page=registro_paso3');
    exit;
}

$titulo = 'Registro - Paso 2';
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
    
    <div class="auth-step-container">
        <div class="auth-step-header">
            <?php 
            $logoIconPath = RECURSOS_PATH . '/logo/loom-icon.png';
            $logoPath = RECURSOS_PATH . '/logo/loom-logo.png';
            if (file_exists($logoIconPath)): 
            ?>
                <div class="logo-icon-container">
                    <img src="<?php echo LOGO_URL; ?>/loom-icon.png" alt="Loom">
                </div>
            <?php elseif (file_exists($logoPath)): ?>
                <img src="<?php echo LOGO_URL; ?>/loom-logo.png" alt="Loom" class="logo-grande">
            <?php else: ?>
                <h1 class="logo-text">Loom</h1>
            <?php endif; ?>
        </div>
        
        <div class="auth-form-wrapper">
        <div class="auth-header">
            <h2>Crear cuenta</h2>
            <p>Seguridad</p>
        </div>
        
        <form id="formRegistro" class="auth-form" method="POST" action="<?php echo ASSETS_URL; ?>/?page=registro_paso2">
            <div class="form-group">
                <label for="clave">Clave *</label>
                <input type="password" id="clave" name="clave" required minlength="<?php echo PASSWORD_MIN_LENGTH; ?>" placeholder="Mínimo 8 caracteres">
                <small class="help-text">Debe contener: mayúscula, minúscula y número</small>
                <?php if (isset($_GET['error_clave'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_clave'])); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirmar_clave">Confirmar clave *</label>
                <input type="password" id="confirmar_clave" name="confirmar_clave" required placeholder="Repite tu clave">
                <?php if (isset($_GET['error_confirmar'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_confirmar'])); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-actions-horizontal">
                <a href="<?php echo ASSETS_URL; ?>/?page=registro" class="btn-submit">Volver</a>
                <button type="submit" class="btn-submit">Continuar</button>
            </div>
        </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
