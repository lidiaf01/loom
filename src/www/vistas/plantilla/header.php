<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo . ' - ' : ''; ?>Loom</title>
    <link rel="icon" type="image/png" href="/loom/src/www/recursos/logo/loom-icon.png">
    <link rel="stylesheet" href="/loom/src/www/css/style.css">
    <link rel="stylesheet" href="/loom/src/www/css/auth.css">
    <link rel="stylesheet" href="/loom/src/www/css/iconos.css">
</head>
<body>
    <?php if (isset($mostrarHeader) && $mostrarHeader): ?>
    <header class="header-principal">
        <div class="container">
            <a href="<?php echo ASSETS_URL; ?>/?page=inicio" class="logo">
                <img src="/loom/src/www/recursos/logo/loom-logo.png" alt="Loom" class="logo-img">
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

