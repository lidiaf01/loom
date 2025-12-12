<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title><?php echo isset($titulo) ? $titulo . ' - ' : ''; ?>Loom</title>
    <link rel="icon" type="image/png" href="<?php echo LOGO_URL; ?>/loom-icon.png">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/style.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/auth.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/inicio.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/dashboard.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/diario.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/diario_extra.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/perfil.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/modals.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/numeros.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/iconos.css">
</head>
<body data-assets-url="<?php echo ASSETS_URL; ?>">
    <?php if (isset($mostrarHeader) && $mostrarHeader): ?>
    <header class="header-principal">
        <div class="container">
            <a href="<?php echo ASSETS_URL; ?>/?page=dashboard" class="logo">
                <img src="<?php echo LOGO_URL; ?>/loom-logo.png" alt="Loom" class="logo-img">
            </a>
            <?php if (estaAutenticado()): ?>
            <nav class="nav-usuario">
                <span><?php echo htmlspecialchars($_SESSION['nombre_usuario'] ?? 'Usuario'); ?></span>
                <a href="#" id="btnLogout">Cerrar sesión</a>
            </nav>
            <?php endif; ?>
        </div>
    </header>
    <?php endif; ?>

