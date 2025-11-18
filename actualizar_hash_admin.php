<?php
/**
 * Script para actualizar el hash de contraseña del admin
 * Acceder desde: http://localhost/loom/actualizar_hash_admin.php
 * 
 * IMPORTANTE: Eliminar este archivo después de usarlo por seguridad
 */

require_once __DIR__ . '/config.php';

// Solo permitir desde localhost
if ($_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['HTTP_HOST'] !== '127.0.0.1') {
    die('Este script solo puede ejecutarse desde localhost');
}

$password = 'Prueba123';
$email = 'admin@loom.com';

try {
    $db = Database::getInstance()->getConnection();
    
    // Generar nuevo hash
    $nuevo_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Actualizar en la base de datos
    $sql = "UPDATE usuarios SET contraseña = :hash WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':hash' => $nuevo_hash,
        ':email' => $email
    ]);
    
    // Verificar que se actualizó
    $sql_verificar = "SELECT nombre_usuario, email, rol FROM usuarios WHERE email = :email";
    $stmt_verificar = $db->prepare($sql_verificar);
    $stmt_verificar->execute([':email' => $email]);
    $usuario = $stmt_verificar->fetch();
    
    // Verificar que el hash funciona
    $sql_hash = "SELECT contraseña FROM usuarios WHERE email = :email";
    $stmt_hash = $db->prepare($sql_hash);
    $stmt_hash->execute([':email' => $email]);
    $hash_almacenado = $stmt_hash->fetchColumn();
    $hash_valido = password_verify($password, $hash_almacenado);
    
    echo "<h1>Actualización de Hash de Contraseña</h1>";
    echo "<h2>Resultado:</h2>";
    
    if ($usuario && $hash_valido) {
        echo "<p style='color: green;'>✓ Hash actualizado correctamente</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($usuario['email']) . "</p>";
        echo "<p><strong>Nombre:</strong> " . htmlspecialchars($usuario['nombre_usuario']) . "</p>";
        echo "<p><strong>Rol:</strong> " . htmlspecialchars($usuario['rol']) . "</p>";
        echo "<p><strong>Contraseña:</strong> Prueba123</p>";
        echo "<p><strong>Hash verificado:</strong> " . ($hash_valido ? "✓ Válido" : "✗ Inválido") . "</p>";
        echo "<hr>";
        echo "<p><strong>Ahora puedes iniciar sesión con:</strong></p>";
        echo "<ul>";
        echo "<li>Email: <code>admin@loom.com</code></li>";
        echo "<li>Contraseña: <code>Prueba123</code></li>";
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>✗ Error al actualizar el hash</p>";
    }
    
    // Actualizar también otros usuarios por si acaso
    $usuarios = ['david@ejemplo.com', 'maria@ejemplo.com'];
    foreach ($usuarios as $user_email) {
        $sql_update = "UPDATE usuarios SET contraseña = :hash WHERE email = :email";
        $stmt_update = $db->prepare($sql_update);
        $stmt_update->execute([
            ':hash' => $nuevo_hash,
            ':email' => $user_email
        ]);
    }
    
    echo "<hr>";
    echo "<p><em>Nota: Todos los usuarios de prueba ahora tienen el hash actualizado.</em></p>";
    echo "<p style='color: red;'><strong>IMPORTANTE: Elimina este archivo (actualizar_hash_admin.php) después de usarlo por seguridad.</strong></p>";
    
} catch (Exception $e) {
    echo "<h1>Error</h1>";
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

