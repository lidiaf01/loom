<?php
require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../controladores/DiarioController.php';

requerirAutenticacion();

$controller = new DiarioController();
$accion = $_GET['accion'] ?? ($_GET['id'] ? 'ver' : 'crear');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$entrada = null;
$resultado = null;

// Si hay ID y no es editar ni crear, es modo visualización
if ($id > 0 && $accion === 'ver') {
    $entrada = $controller->mostrar($id);
    if (!$entrada) {
        header('Location: ' . ASSETS_URL . '/?page=diario');
        exit;
    }
} elseif ($accion === 'editar' && $id > 0) {
    $entrada = $controller->mostrar($id);
    if (!$entrada) {
        header('Location: ' . ASSETS_URL . '/?page=diario');
        exit;
    }
} elseif ($accion === 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controller->crear();
    if ($resultado && $resultado['exito']) {
        header('Location: ' . $resultado['redirect']);
        exit;
    }
} elseif ($accion === 'editar' && $id > 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controller->editar($id);
    if ($resultado && $resultado['exito']) {
        header('Location: ' . $resultado['redirect']);
        exit;
    }
}

$titulo = $accion === 'crear' ? 'Nueva Entrada' : ($accion === 'editar' ? 'Editar Entrada' : 'Ver Entrada');
$mostrarHeader = false;
include __DIR__ . '/../plantilla/header.php';
?>

<link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/src/www/estilos/diario.css">

<main class="diario-entrada-container">
    <?php if ($accion === 'ver' && $entrada): ?>
        <!-- Vista de solo lectura -->
        <div class="diario-entrada-view">
            <div class="diario-entrada-header">
                <h1 class="diario-entrada-titulo">
                    <?php echo !empty($entrada['titulo']) ? htmlspecialchars($entrada['titulo']) : 'Sin título'; ?>
                </h1>
                <div class="diario-entrada-fecha">
                    <?php echo date('d/m/Y H:i', strtotime($entrada['fecha_entrada'])); ?>
                </div>
            </div>
            
            <?php if (!empty($entrada['estado_animo'])): ?>
                <div class="diario-entrada-estado">
                    <span class="estado-label">Estado de ánimo:</span>
                    <span class="estado-valor estado-<?php echo htmlspecialchars($entrada['estado_animo']); ?>">
                        <?php 
                        $estados = [
                            'feliz' => '😊 Feliz',
                            'triste' => '😢 Triste',
                            'neutral' => '😐 Neutral',
                            'ansioso' => '😰 Ansioso',
                            'emocionado' => '🎉 Emocionado',
                            'relajado' => '😌 Relajado',
                            'estresado' => '😓 Estresado'
                        ];
                        echo $estados[$entrada['estado_animo']] ?? htmlspecialchars(ucfirst($entrada['estado_animo']));
                        ?>
                    </span>
                </div>
            <?php endif; ?>
            
            <div class="diario-entrada-contenido">
                <?php echo nl2br(htmlspecialchars($entrada['contenido'])); ?>
            </div>
            
            <div class="diario-entrada-navegacion">
                <?php if (!empty($entrada['anterior'])): ?>
                    <a href="<?php echo ASSETS_URL; ?>/?page=diario_entrada&id=<?php echo $entrada['anterior']['id_entrada']; ?>" class="btn-nav btn-anterior">
                        <span class="nav-icon">←</span>
                        <span class="nav-text">
                            <span class="nav-label">Anterior</span>
                            <span class="nav-titulo"><?php echo htmlspecialchars(!empty($entrada['anterior']['titulo']) ? $entrada['anterior']['titulo'] : 'Sin título'); ?></span>
                        </span>
                    </a>
                <?php else: ?>
                    <div class="btn-nav btn-anterior btn-disabled">
                        <span class="nav-icon">←</span>
                        <span class="nav-text">
                            <span class="nav-label">Anterior</span>
                            <span class="nav-titulo">No hay más entradas</span>
                        </span>
                    </div>
                <?php endif; ?>
                
                <a href="<?php echo ASSETS_URL; ?>/?page=diario" class="btn-volver">Volver al diario</a>
                
                <?php if (!empty($entrada['siguiente'])): ?>
                    <a href="<?php echo ASSETS_URL; ?>/?page=diario_entrada&id=<?php echo $entrada['siguiente']['id_entrada']; ?>" class="btn-nav btn-siguiente">
                        <span class="nav-text">
                            <span class="nav-label">Siguiente</span>
                            <span class="nav-titulo"><?php echo htmlspecialchars(!empty($entrada['siguiente']['titulo']) ? $entrada['siguiente']['titulo'] : 'Sin título'); ?></span>
                        </span>
                        <span class="nav-icon">→</span>
                    </a>
                <?php else: ?>
                    <div class="btn-nav btn-siguiente btn-disabled">
                        <span class="nav-text">
                            <span class="nav-label">Siguiente</span>
                            <span class="nav-titulo">No hay más entradas</span>
                        </span>
                        <span class="nav-icon">→</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- Formulario de creación/edición -->
        <h1><?php echo $accion === 'crear' ? 'Nueva Entrada de Diario' : 'Editar Entrada de Diario'; ?></h1>
        
        <?php if ($resultado && !$resultado['exito']): ?>
            <div class="mensaje-error">
                <?php echo htmlspecialchars($resultado['mensaje']); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo ASSETS_URL; ?>/?page=diario_entrada<?php echo $id > 0 ? '&id=' . $id . '&accion=editar' : '&accion=crear'; ?>">
            <div>
                <label for="titulo">Título (opcional, máximo 100 caracteres)</label>
                <input type="text" id="titulo" name="titulo" 
                       value="<?php echo htmlspecialchars($entrada['titulo'] ?? ($resultado['datos']['titulo'] ?? '')); ?>" 
                       maxlength="100">
                <span id="contador_titulo">0/100</span>
            </div>
            
            <div>
                <label for="contenido">Contenido *</label>
                <textarea id="contenido" name="contenido" rows="10" required><?php echo htmlspecialchars($entrada['contenido'] ?? ($resultado['datos']['contenido'] ?? '')); ?></textarea>
            </div>
            
            <div>
                <label for="estado_animo">Estado de ánimo (opcional)</label>
                <select id="estado_animo" name="estado_animo">
                    <option value="">Seleccionar...</option>
                    <option value="feliz" <?php echo ($entrada['estado_animo'] ?? '') === 'feliz' ? 'selected' : ''; ?>>Feliz</option>
                    <option value="triste" <?php echo ($entrada['estado_animo'] ?? '') === 'triste' ? 'selected' : ''; ?>>Triste</option>
                    <option value="neutral" <?php echo ($entrada['estado_animo'] ?? '') === 'neutral' ? 'selected' : ''; ?>>Neutral</option>
                    <option value="ansioso" <?php echo ($entrada['estado_animo'] ?? '') === 'ansioso' ? 'selected' : ''; ?>>Ansioso</option>
                    <option value="emocionado" <?php echo ($entrada['estado_animo'] ?? '') === 'emocionado' ? 'selected' : ''; ?>>Emocionado</option>
                    <option value="relajado" <?php echo ($entrada['estado_animo'] ?? '') === 'relajado' ? 'selected' : ''; ?>>Relajado</option>
                    <option value="estresado" <?php echo ($entrada['estado_animo'] ?? '') === 'estresado' ? 'selected' : ''; ?>>Estresado</option>
                </select>
            </div>
            
            <div>
                <button type="submit">Guardar</button>
                <a href="<?php echo ASSETS_URL; ?>/?page=diario">Cancelar</a>
                <?php if ($id > 0): ?>
                    <button type="button" class="btn-eliminar-entrada" data-id="<?php echo $id; ?>">Eliminar</button>
                <?php endif; ?>
            </div>
        </form>
    <?php endif; ?>
</main>


<?php include __DIR__ . '/../plantilla/nav_bottom.php'; ?>
<?php include __DIR__ . '/../plantilla/footer.php'; ?>

