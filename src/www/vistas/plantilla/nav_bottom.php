<?php
// Navegación inferior reutilizable
// Aparece en todas las páginas autenticadas

if (!estaAutenticado()) {
    return; // No mostrar nav si no está autenticado
}

$pageActual = $_GET['page'] ?? 'dashboard';
?>
<!-- Bottom Navigation -->
<div class="dashboard-bottom-nav">
    <div class="dashboard-nav-content">
        <a href="<?php echo ASSETS_URL; ?>/?page=dashboard" class="dashboard-nav-item <?php echo $pageActual === 'dashboard' ? 'dashboard-nav-active' : ''; ?>">
            <div class="dashboard-nav-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 2L3 7V18H8V12H12V18H17V7L10 2Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="dashboard-nav-label">Principal</div>
        </a>
        <a href="<?php echo ASSETS_URL; ?>/?page=busqueda" class="dashboard-nav-item <?php echo $pageActual === 'busqueda' ? 'dashboard-nav-active' : ''; ?>">
            <div class="dashboard-nav-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M15.5 14H14.71L14.43 13.73C15.41 12.59 16 11.11 16 9.5C16 5.91 13.09 3 9.5 3C5.91 3 3 5.91 3 9.5C3 13.09 5.91 16 9.5 16C11.11 16 12.59 15.41 13.73 14.43L14 14.71V15.5L19 20.49L20.49 19L15.5 14ZM9.5 14C7.01 14 5 11.99 5 9.5C5 7.01 7.01 5 9.5 5C11.99 5 14 7.01 14 9.5C14 11.99 11.99 14 9.5 14Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="dashboard-nav-label">Buscar</div>
        </a>
        <a href="<?php echo ASSETS_URL; ?>/?page=biblioteca" class="dashboard-nav-item <?php echo $pageActual === 'biblioteca' ? 'dashboard-nav-active' : ''; ?>">
            <div class="dashboard-nav-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M4 6H2V18C2 19.1 2.9 20 4 20H16V18H4V6ZM18 2H8C6.9 2 6 2.9 6 4V16C6 17.1 6.9 18 8 18H18C19.1 18 20 17.1 20 16V4C20 2.9 19.1 2 18 2ZM18 16H8V4H18V16Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="dashboard-nav-label">Biblioteca</div>
        </a>
        <a href="<?php echo ASSETS_URL; ?>/?page=perfil" class="dashboard-nav-item <?php echo in_array($pageActual, ['perfil', 'editar_perfil']) ? 'dashboard-nav-active' : ''; ?>">
            <div class="dashboard-nav-icon">
                <svg width="17.5" height="20" viewBox="0 0 17.5 20" fill="none">
                    <path d="M8.75 0C6.68 0 5 1.68 5 3.75C5 5.82 6.68 7.5 8.75 7.5C10.82 7.5 12.5 5.82 12.5 3.75C12.5 1.68 10.82 0 8.75 0ZM8.75 10C5.68 10 0 11.68 0 14.75V20H17.5V14.75C17.5 11.68 11.82 10 8.75 10Z" fill="currentColor"/>
                </svg>
            </div>
            <div class="dashboard-nav-label">Perfil</div>
        </a>
    </div>
</div>

