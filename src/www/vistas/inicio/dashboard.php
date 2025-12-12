<?php
require_once __DIR__ . '/../../../../config.php';

requerirAutenticacion();

$usuarioModel = new Usuario();
$usuario = $usuarioModel->obtenerPorId(obtenerUsuarioId());

if (!$usuario) {
    session_destroy();
    header('Location: ' . ASSETS_URL . '/?page=login');
    exit;
}

$titulo = 'Dashboard';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/dashboard.css">

<div class="dashboard-figma">
    <!-- Header Section -->
    <div class="dashboard-header-section">
        <div class="dashboard-header-content">
            <div class="dashboard-greeting-section">
                <div class="dashboard-greeting-title">Hola, <?php echo htmlspecialchars($usuario['nombre_usuario']); ?> ✨</div>
                <div class="dashboard-greeting-subtitle">Tu espacio de crecimiento</div>
            </div>
            <a href="<?php echo ASSETS_URL; ?>/?page=perfil" class="dashboard-profile-button">
                <div class="dashboard-profile-icon">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M9 9C10.6569 9 12 7.65685 12 6C12 4.34315 10.6569 3 9 3C7.34315 3 6 4.34315 6 6C6 7.65685 7.34315 9 9 9Z" fill="#FFF8F0"/>
                        <path d="M9 10.5C6.51472 10.5 4.5 12.0147 4.5 14V15.75H13.5V14C13.5 12.0147 11.4853 10.5 9 10.5Z" fill="#FFF8F0"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
    
    <!-- Tools Section -->
    <div class="dashboard-tools-section">
        <div class="dashboard-tools-label">Herramientas</div>
        
        <!-- Diario Card -->
        <a href="<?php echo ASSETS_URL; ?>/?page=diario" class="dashboard-tool-card dashboard-card-diario">
            <div class="dashboard-tool-icon-box">
                <div class="dashboard-tool-icon">
                    <svg width="20.25" height="18" viewBox="0 0 20.25 18" fill="none">
                        <path d="M20.25 15.49L0 1.13V0H20.25V15.49Z" fill="#5C4B51"/>
                    </svg>
                </div>
            </div>
            <div class="dashboard-tool-title">Diario</div>
            <div class="dashboard-tool-description">
                <div>Escribe tus</div>
                <div>pensamientos</div>
            </div>
        </a>
        
        <!-- Stats Card -->
        <a href="<?php echo ASSETS_URL; ?>/?page=stats" class="dashboard-tool-card dashboard-card-stats">
            <div class="dashboard-tool-icon-box">
                <div class="dashboard-tool-icon">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M18 15.75L0 1.13V0H18V15.75Z" fill="#5C4B51"/>
                    </svg>
                </div>
            </div>
            <div class="dashboard-tool-title">Stats</div>
            <div class="dashboard-tool-description">Revisa tu evolución</div>
        </a>
        
        <!-- Crear Card -->
        <a href="<?php echo ASSETS_URL; ?>/?page=crear" class="dashboard-tool-card dashboard-card-crear">
            <div class="dashboard-tool-icon-box">
                <div class="dashboard-tool-icon">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M18 15.75L0 1.13V0H18V15.75Z" fill="#5C4B51"/>
                    </svg>
                </div>
            </div>
            <div class="dashboard-tool-title">Crear</div>
            <div class="dashboard-tool-description">Comparte tus hábitos</div>
        </a>
        
        <!-- Últimas lecturas Card -->
        <a href="<?php echo ASSETS_URL; ?>/?page=biblioteca" class="dashboard-tool-card dashboard-card-lecturas">
            <div class="dashboard-tool-icon-box">
                <div class="dashboard-tool-icon">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M18 15.39L0 1.48V0H18V15.39Z" fill="#5C4B51"/>
                    </svg>
                </div>
            </div>
            <div class="dashboard-tool-title">Últimas lecturas</div>
            <div class="dashboard-tool-description">Revisa tus aprendizajes anteriores</div>
        </a>
    </div>
    
</div>

<?php include __DIR__ . '/../plantilla/nav_bottom.php'; ?>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>
