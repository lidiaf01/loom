<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../modelos/Usuario.php';

requerirAutenticacion();

$usuarioModel = new Usuario();
$usuario = $usuarioModel->obtenerPorId(obtenerUsuarioId());

if (!$usuario) {
    session_destroy();
    header('Location: ' . url('vistas/autenticacion/login.php'));
    exit;
}

$titulo = 'Inicio';
$mostrarHeader = true;
include __DIR__ . '/../plantilla/header.php';
?>

<main class="home-container">
    <div class="container">
        <h2>¡Hola, <?php echo htmlspecialchars($usuario['nombre_usuario']); ?>!</h2>
        <p>Bienvenido a Loom</p>
        
        <div class="perfil-info">
            <h3><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h3>
            <p><?php echo htmlspecialchars($usuario['email']); ?></p>
            <?php if ($usuario['biografia']): ?>
                <p><?php echo htmlspecialchars($usuario['biografia']); ?></p>
            <?php endif; ?>
        </div>
        
        <p>Más funcionalidades próximamente...</p>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>

