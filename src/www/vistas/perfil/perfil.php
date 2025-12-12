<?php
require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../controladores/PerfilController.php';

requerirAutenticacion();

$controller = new PerfilController();
$usuario = $controller->mostrar();

if (!$usuario) {
    header('Location: ' . ASSETS_URL . '/?page=dashboard');
    exit;
}

$titulo = 'Mi Perfil';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main>
    <h1>Mi Perfil</h1>
    
    <div>
        <h2>Información Personal</h2>
        
        <?php if (!empty($usuario['foto_perfil']) && $usuario['foto_perfil'] !== 'default_avatar.png'): ?>
            <img src="<?php echo ASSETS_URL; ?>/src/www/uploads/perfiles/<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" 
                 alt="Foto de perfil" class="preview-foto">
            <?php else: ?>
            <div class="preview-foto-placeholder"></div>
        <?php endif; ?>
        
        <p><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($usuario['nombre_usuario']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><strong>Fecha de nacimiento:</strong> <?php echo htmlspecialchars($usuario['fecha_nacimiento']); ?></p>
        <?php if (!empty($usuario['biografia'])): ?>
            <p><strong>Biografía:</strong> <?php echo htmlspecialchars($usuario['biografia']); ?></p>
        <?php else: ?>
            <p><strong>Biografía:</strong> <em>No has añadido una biografía aún</em></p>
        <?php endif; ?>
        
        <p><strong>Fecha de registro:</strong> <?php echo htmlspecialchars($usuario['fecha_registro']); ?></p>
    </div>
    
    <div class="perfil-acciones">
        <a href="<?php echo ASSETS_URL; ?>/?page=editar_perfil" class="btn-editar-perfil">Editar perfil</a>
        <a href="<?php echo ASSETS_URL; ?>/?page=dashboard" class="btn-volver-dashboard">Volver al dashboard</a>
        <a href="#" id="btnLogoutPerfil" class="btn-cerrar-sesion">Cerrar sesión</a>
    </div>
</main>

<style>
.perfil-acciones {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 2px solid rgba(92, 75, 81, 0.1);
}

.btn-editar-perfil,
.btn-volver-dashboard,
.btn-cerrar-sesion {
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-family: var(--font-texto), 'Heading Now', sans-serif;
    font-size: 0.9375rem;
    font-weight: 500;
    transition: all 0.3s ease;
    text-align: center;
    display: block;
}

.btn-editar-perfil {
    background: linear-gradient(90deg, #E8D5FF 0%, #B481F1 100%);
    color: #5C4B51;
}

.btn-editar-perfil:hover {
    transform: translateY(-2px);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-volver-dashboard {
    background: linear-gradient(90deg, #C7F5E8 0%, #70EAC8 100%);
    color: #5C4B51;
}

.btn-volver-dashboard:hover {
    transform: translateY(-2px);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
}

.btn-cerrar-sesion {
    background: rgba(255, 179, 217, 0.8);
    color: #5C4B51;
    border: 2px solid rgba(92, 75, 81, 0.2);
}

.btn-cerrar-sesion:hover {
    background: rgba(255, 179, 217, 1);
    transform: translateY(-2px);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
}
</style>


<?php include __DIR__ . '/../plantilla/nav_bottom.php'; ?>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>

