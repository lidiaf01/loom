<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($titulo) ? $titulo . ' - ' : ''; ?>Loom</title>
    <link rel="stylesheet" href="/loom/estilos/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/loom/estilos/auth.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/loom/estilos/iconos.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" href="/loom/recursos/logo/loom-icon.png">
    <style>
        /* Estilos críticos inline para asegurar que se apliquen */
        body {
            background-color: #F8F4DE !important;
            font-family: 'Heading Now', sans-serif;
            color: #474444;
            margin: 0;
            padding: 0;
        }
        .auth-container {
            background-color: #F8F4DE !important;
        }
        .btn-primary {
            background-color: #FBEF74 !important;
            color: #474444 !important;
            font-family: 'Heading Now', sans-serif !important;
        }
        .btn-secondary {
            color: #F1AFF2 !important;
            border-color: #F1AFF2 !important;
            font-family: 'Heading Now', sans-serif !important;
        }
    </style>
</head>
<body>
    <?php if (isset($mostrarHeader) && $mostrarHeader): ?>
    <header class="header-principal">
        <div class="container">
            <div class="header-content">
                <a href="<?php echo url('vistas/inicio/pantalla_principal.php'); ?>" class="logo">
                    <?php if (file_exists(RECURSOS_PATH . '/logo/loom-logo.png')): ?>
                        <img src="/loom/recursos/logo/loom-logo.png" alt="Loom" class="logo-img">
                    <?php else: ?>
                        <h1>Loom</h1>
                    <?php endif; ?>
                </a>
                <?php if (estaAutenticado()): ?>
                <nav class="nav-usuario">
                    <span class="usuario-nombre"><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
                    <a href="#" id="btnLogout" class="btn-logout">Cerrar sesión</a>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <?php endif; ?>

