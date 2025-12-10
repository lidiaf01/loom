<?php
/**
 * Página principal de Loom
 * 
 * Muestra la pantalla principal después del login.
 * 
 * @package Loom
 * @subpackage Vistas
 */

// Verificar autenticación
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['error'] = 'Acceso no autorizado. Por favor inicie sesión.';
    echo '<meta http-equiv="refresh" content="0;url=index.php?controlador=usuario&metodo=iniciarSesion">';
    exit;
}

// Obtener datos del usuario
require_once __DIR__ . '/../../modelos/usuario.php';
$usuarioModel = new Usuario();
$usuario = $usuarioModel->buscarPorId($_SESSION['usuario_id']);

if (!$usuario) {
    session_destroy();
    $_SESSION['error'] = 'Usuario no encontrado.';
    echo '<meta http-equiv="refresh" content="0;url=index.php?controlador=usuario&metodo=iniciarSesion">';
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Inicio - Loom</title>
</head>
<body>
<header>
    <?php
    // Mostrar mensajes de sesión
    if (!empty($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']);
    }
    if (!empty($_SESSION['success'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_SESSION['success']) . '</p>';
        unset($_SESSION['success']);
    }
    ?>
    <nav>
        <a href="index.php?controlador=usuario&metodo=cerrarSesion">Cerrar sesión</a>
    </nav>
</header>
<main class="home-container">
    <div class="container">
        <h2>¡Hola, <?php echo htmlspecialchars($usuario['nombre_usuario']); ?>!</h2>
        <p>Bienvenido a Loom</p>
        
        <div class="perfil-info">
            <h3><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h3>
            <p><?php echo htmlspecialchars($usuario['correo']); ?></p>
            <?php if (!empty($usuario['fecha_nacimiento'])): ?>
                <p>Fecha de nacimiento: <?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?></p>
            <?php endif; ?>
        </div>
        
        <p>Más funcionalidades próximamente...</p>
    </div>
</main>
</body>
</html>
