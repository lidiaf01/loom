<?php
/**
 * Punto de entrada principal de la aplicación
 * 
 * Este archivo actúa como enrutador principal de la aplicación.
 * Gestiona la carga de controladores y métodos según los parámetros
 * GET recibidos, además de manejar la autenticación de usuarios.
 * 
 * @package Loom
 * @author Lidia
 * @version 1.0
 */

try {
    $config = require_once __DIR__ . '/config.php';
    foreach ($config as $key => $value) {
        if (!defined($key)) {
            define($key, $value);
        }
    }
    session_start();

    $controlador = $_GET['controlador'] ?? 'usuario';
    $metodo = $_GET['metodo'] ?? (isset($_SESSION['usuario_id']) ? 'inicio' : 'mostrarMenuInicial');

    $primeraLetra = strtoupper(substr($controlador, 0, 1));
    $resto = substr($controlador, 1);
    $controladorCapitalizado = $primeraLetra . $resto;

    $archivoControlador = __DIR__ . '/' . DIR_CONTROLADORES . '/controlador' . $controladorCapitalizado . '.php';
    if (!file_exists($archivoControlador)) {
        throw new Exception('Controlador no encontrado');
    }

    require_once $archivoControlador;
    $nombreClase = 'Controlador' . $controladorCapitalizado;
    if (!class_exists($nombreClase)) {
        throw new Exception('Clase del controlador no encontrada');
    }

    $rutasPublicas = [
        'usuario' => ['iniciarSesion', 'mostrarMenuInicial', 'mostrarRegistro', 'registrar']
    ];

    if (!isset($_SESSION['usuario_id'])) {
        if (!isset($rutasPublicas[$controlador]) || !in_array($metodo, $rutasPublicas[$controlador])) {
            $_SESSION['error'] = 'Acceso no autorizado. Por favor inicie sesión.';
            echo '<meta http-equiv="refresh" content="0;url=index.php?controlador=usuario&metodo=iniciarSesion">';
            exit;
        }
    }

    $controladorInstancia = new $nombreClase();
    if (!method_exists($controladorInstancia, $metodo)) {
        throw new Exception('Acción no encontrada');
    }

    $controladorInstancia->$metodo();
} catch (Exception $excepcion) {
    echo 'Error: ' . htmlspecialchars($excepcion->getMessage());
}

