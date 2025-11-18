<?php
/**
 * Pantalla Principal
 * Sprint 1 - Proyecto Loom
 */

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../modelos/Usuario.php';

// Requerir autenticación
requerirAutenticacion();

// Obtener datos del usuario
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
        <!-- Banner de bienvenida -->
        <section class="banner-bienvenida">
            <div class="banner-content">
                <h2>¡Hola, <?php echo htmlspecialchars($usuario['nombre_usuario']); ?>! 👋</h2>
                <p>Bienvenido a tu espacio en Loom</p>
            </div>
        </section>
        
        <!-- Menú de navegación principal -->
        <nav class="menu-navegacion">
            <h3 class="menu-titulo">Navegación</h3>
            <ul class="menu-lista">
                <li>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">✏️</span>
                        <span class="menu-texto">Crear</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">🔍</span>
                        <span class="menu-texto">Búsqueda</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">👤</span>
                        <span class="menu-texto">Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">📔</span>
                        <span class="menu-texto">Diario</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">📚</span>
                        <span class="menu-texto">Biblioteca</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">⚙️</span>
                        <span class="menu-texto">Ajustes</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Información del perfil -->
        <section class="perfil-resumen">
            <div class="perfil-card">
                <div class="perfil-avatar">
                    <?php 
                    $avatarPath = file_exists(RECURSOS_PATH . '/imagenes/' . $usuario['foto_perfil']) 
                        ? url('recursos/imagenes/' . $usuario['foto_perfil']) 
                        : 'https://via.placeholder.com/100?text=' . urlencode(substr($usuario['nombre_usuario'], 0, 1));
                    ?>
                    <img src="<?php echo $avatarPath; ?>" 
                         alt="Avatar de <?php echo htmlspecialchars($usuario['nombre_usuario']); ?>">
                </div>
                <div class="perfil-info">
                    <h3><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></h3>
                    <p class="perfil-email"><?php echo htmlspecialchars($usuario['email']); ?></p>
                    <?php if ($usuario['biografia']): ?>
                        <p class="perfil-biografia"><?php echo htmlspecialchars($usuario['biografia']); ?></p>
                    <?php endif; ?>
                    <p class="perfil-rol">Rol: <?php echo ucfirst($usuario['rol']); ?></p>
                </div>
            </div>
        </section>
        
        <!-- Mensaje informativo -->
        <section class="info-sprint">
            <div class="info-card">
                <h4>🚀 Sprint 1 - Funcionalidades disponibles</h4>
                <ul>
                    <li>✅ Registro de usuarios</li>
                    <li>✅ Inicio de sesión</li>
                    <li>✅ Pantalla principal</li>
                    <li>⏳ Más funcionalidades en próximos sprints</li>
                </ul>
            </div>
        </section>
    </div>
</main>

<?php include __DIR__ . '/../plantilla/footer.php'; ?>

