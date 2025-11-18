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
        <!-- Botones principales (cuadrados grandes) -->
        <div class="botones-principales">
            <a href="#" class="btn-principal" data-accion="crear">
                <span class="btn-icon">✏️</span>
                <span class="btn-texto">Crear</span>
            </a>
            <a href="#" class="btn-principal" data-accion="busqueda">
                <span class="btn-icon">🔍</span>
                <span class="btn-texto">Búsqueda</span>
            </a>
            <a href="#" class="btn-principal" data-accion="perfil">
                <span class="btn-icon">👤</span>
                <span class="btn-texto">Perfil</span>
            </a>
            <a href="#" class="btn-principal" data-accion="diario">
                <span class="btn-icon">📔</span>
                <span class="btn-texto">Diario</span>
            </a>
        </div>
        
        <!-- Botones secundarios (circulares sin texto) -->
        <div class="botones-secundarios">
            <a href="#" class="btn-secundario" data-accion="estadisticas" title="Estadísticas">
                <span class="btn-icon-secundario">📊</span>
            </a>
            <a href="#" class="btn-secundario" data-accion="biblioteca" title="Biblioteca">
                <span class="btn-icon-secundario">📚</span>
            </a>
            <a href="#" class="btn-secundario" data-accion="ajustes" title="Ajustes">
                <span class="btn-icon-secundario">⚙️</span>
            </a>
        </div>
    </div>
    
    <!-- Banner decorativo -->
    <div class="banner-decorativo">
        <!-- Contenido decorativo -->
    </div>
</main>


