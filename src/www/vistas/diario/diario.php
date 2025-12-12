<?php
require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../controladores/DiarioController.php';

requerirAutenticacion();

$controller = new DiarioController();
$resultado = $controller->listar();

$entradas = $resultado['entradas'] ?? [];
$total = $resultado['total'] ?? 0;
$pagina = $resultado['pagina'] ?? 1;
$totalPaginas = $resultado['total_paginas'] ?? 0;
$buscar = $_GET['buscar'] ?? '';

$titulo = 'Mi Diario';
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<main>
    <h1>Mi Diario Personal</h1>
    
    <div>
        <a href="<?php echo ASSETS_URL; ?>/?page=diario_entrada&accion=crear">Nueva entrada</a>
        <a href="<?php echo ASSETS_URL; ?>/?page=dashboard">Volver al dashboard</a>
    </div>
    
    <hr>
    
    <div>
        <h2>Buscar entradas</h2>
        <form method="GET" action="<?php echo ASSETS_URL; ?>/?page=diario">
            <input type="text" name="buscar" value="<?php echo htmlspecialchars($buscar); ?>" placeholder="Buscar en título o contenido...">
            <button type="submit">Buscar</button>
            <?php if (!empty($buscar)): ?>
                <a href="<?php echo ASSETS_URL; ?>/?page=diario">Limpiar búsqueda</a>
            <?php endif; ?>
        </form>
    </div>
    
    <hr>
    
    <div>
        <p>Total de entradas: <?php echo $total; ?></p>
        
        <?php if (empty($entradas)): ?>
            <p>No hay entradas en tu diario aún. <a href="<?php echo ASSETS_URL; ?>/?page=diario_entrada&accion=crear">Crea tu primera entrada</a></p>
        <?php else: ?>
            <table class="diario-tabla">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Título</th>
                        <th>Estado de ánimo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entradas as $entrada): ?>
                        <tr>
                            <td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($entrada['fecha_entrada']))); ?></td>
                            <td>
                                <?php if (!empty($entrada['titulo'])): ?>
                                    <?php echo htmlspecialchars($entrada['titulo']); ?>
                                <?php else: ?>
                                    <em>Sin título</em>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($entrada['estado_animo'] ?? 'No especificado'); ?></td>
                            <td>
                                <a href="<?php echo ASSETS_URL; ?>/?page=diario_entrada&id=<?php echo $entrada['id_entrada']; ?>">Ver</a> |
                                <a href="#" class="btn-eliminar-entrada" data-id="<?php echo $entrada['id_entrada']; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <?php if ($totalPaginas > 1): ?>
                <div class="diario-paginacion">
                    <p>Página <?php echo $pagina; ?> de <?php echo $totalPaginas; ?></p>
                    <?php if ($pagina > 1): ?>
                        <a href="<?php echo ASSETS_URL; ?>/?page=diario&pagina=<?php echo $pagina - 1; ?><?php echo !empty($buscar) ? '&buscar=' . urlencode($buscar) : ''; ?>">Anterior</a>
                    <?php endif; ?>
                    <?php if ($pagina < $totalPaginas): ?>
                        <a href="<?php echo ASSETS_URL; ?>/?page=diario&pagina=<?php echo $pagina + 1; ?><?php echo !empty($buscar) ? '&buscar=' . urlencode($buscar) : ''; ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>


<?php include __DIR__ . '/../plantilla/nav_bottom.php'; ?>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>

