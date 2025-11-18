<?php
require_once __DIR__ . '/../../config.php';

if (estaAutenticado()) {
    header('Location: ' . url('vistas/inicio/pantalla_principal.php'));
    exit;
}

// Procesar datos del paso 1
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_usuario']) && isset($_POST['email']) && isset($_POST['fecha_nacimiento']) && !isset($_POST['contraseña'])) {
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
        $urlBase = url('vistas/autenticacion/registro.php');
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
    header('Location: ' . url('vistas/autenticacion/registro.php'));
    exit;
}

// Procesar datos del paso 2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contraseña'])) {
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = isset($_POST['confirmar_contraseña']) ? $_POST['confirmar_contraseña'] : '';
    
    $errores = [];
    if (empty($contraseña) || strlen($contraseña) < PASSWORD_MIN_LENGTH) {
        $errores[] = 'error_contraseña=Contraseña+inválida';
    } elseif (!preg_match('/[A-Z]/', $contraseña) || !preg_match('/[a-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña)) {
        $errores[] = 'error_contraseña=Debe+contener+mayúscula,+minúscula+y+número';
    }
    if ($contraseña !== $confirmarContraseña) {
        $errores[] = 'error_confirmar=Las+contraseñas+no+coinciden';
    }
    
    if (!empty($errores)) {
        $urlBase = url('vistas/autenticacion/registro_paso2.php');
        $separador = (strpos($urlBase, '?') !== false) ? '&' : '?';
        header('Location: ' . $urlBase . $separador . implode('&', $errores));
        exit;
    }
    
    $_SESSION['registro_paso2'] = ['contraseña' => $contraseña];
    header('Location: ' . url('vistas/autenticacion/registro_paso3.php'));
    exit;
}

$titulo = 'Registro - Paso 2';
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
        
        <form class="auth-form" method="POST" action="<?php echo url('vistas/autenticacion/registro_paso2.php'); ?>">
            <div class="form-group">
                <label for="contraseña">Contraseña *</label>
                <input type="password" id="contraseña" name="contraseña" required minlength="<?php echo PASSWORD_MIN_LENGTH; ?>" placeholder="Mínimo 8 caracteres">
                <small class="help-text">Debe contener: mayúscula, minúscula y número</small>
                <?php if (isset($_GET['error_contraseña'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_contraseña'])); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirmar_contraseña">Confirmar contraseña *</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required placeholder="Repite tu contraseña">
                <?php if (isset($_GET['error_confirmar'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars(urldecode($_GET['error_confirmar'])); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-actions-horizontal" style="display: flex !important; flex-direction: row !important; gap: 1rem !important; width: 100% !important;">
                <button type="button" onclick="window.location.href='<?php echo url('vistas/autenticacion/registro.php'); ?>'" class="btn-submit" style="flex: 1 !important; width: 0 !important; min-width: 0 !important;">Volver</button>
                <button type="submit" class="btn-submit" style="flex: 1 !important; width: 0 !important; min-width: 0 !important;">Continuar</button>
            </div>
        </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>
