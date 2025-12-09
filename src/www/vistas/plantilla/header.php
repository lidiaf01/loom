<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo . ' - ' : ''; ?>Loom</title>
    <link rel="stylesheet" href="<?php echo url('estilos/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('estilos/auth.css'); ?>">
</head>
<body>
    <?php if (isset($mostrarHeader) && $mostrarHeader): ?>
    <header class="header-principal">
        <div class="container">
            <a href="<?php echo url('vistas/inicio/pantalla_principal.php'); ?>" class="logo">Loom</a>
            <?php if (estaAutenticado()): ?>
            <nav class="nav-usuario">
                <span><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
                <a href="#" id="btnLogout">Cerrar sesión</a>
            </nav>
            <?php endif; ?>
        </div>
    </header>
    <?php endif; ?>

