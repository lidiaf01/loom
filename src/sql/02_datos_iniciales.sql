-- ============================================
-- PROYECTO LOOM - Datos Iniciales MVC
-- Archivo: 02_datos_iniciales.sql
-- Propósito: Insertar datos de prueba para sistema MVC
-- Autor: Lidia Artero Fernández
-- Fecha: Noviembre 2025
-- ============================================

USE loom_db;

-- Configuración
SET NAMES utf8mb4;

-- ============================================
<<<<<<< HEAD
-- INSERTAR USUARIO DE PRUEBA
-- Clave: "1234" (hash MD5: 81dc9bdb52d04dc20036dbd8313ed055)
-- ============================================

-- Usuario inicial de la aplicación
INSERT INTO Usuario (nombre_usuario, correo, fecha_nacimiento, clave) VALUES 
('abcd', 'usuario@loom.com', '2000-01-01', MD5('1234'));
=======
-- INSERTAR USUARIOS DE PRUEBA
-- Clave para todos: "Prueba123"
-- Hash generado con: password_hash('Prueba123', PASSWORD_DEFAULT)
-- ============================================

-- Nota: Estos hashes son de ejemplo. En producción, PHP generará los hashes
-- usando password_hash() al registrar usuarios.

INSERT INTO usuarios (nombre_usuario, email, clave, fecha_nacimiento, biografia, foto_perfil, rol) VALUES
-- Usuario de prueba principal
('david_usuario', 'david@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2005-06-15', 'Usuario de prueba de Loom', 'default_avatar.png', 'usuario'),

-- Usuario administrador
('admin_loom', 'admin@loom.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-01-15', 'Administrador oficial de Loom', 'default_avatar.png', 'admin'),

-- Usuario creador
('maria_garcia', 'maria@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2004-03-20', 'Apasionada por el fitness y vida saludable', 'default_avatar.png', 'creador');
>>>>>>> 53c5bf011309e270d2c5e4fa9544df665db30bd6

-- ============================================
-- VERIFICACIÓN DE DATOS INSERTADOS
-- ============================================
SELECT 'Datos insertados correctamente' as Estado;

SELECT 
    'Usuarios creados' as Mensaje,
    COUNT(*) as Total 
FROM Usuario;

SELECT 
    id,
    nombre_usuario,
    correo,
    fecha_nacimiento
FROM Usuario
ORDER BY id DESC;

-- ============================================
-- INFORMACIÓN DE ACCESO
-- ============================================
SELECT '
<<<<<<< HEAD
IMPORTANTE - Usuario de prueba:
Nombre de usuario: abcd
Contraseña: 1234
Correo: usuario@loom.com

Nota: La contraseña está almacenada como hash MD5.
=======
IMPORTANTE - Usuarios de prueba para Sprint 1:
Todos los usuarios tienen la clave: Prueba123

Usuarios disponibles:
- david@ejemplo.com (Usuario regular)
- admin@loom.com (Administrador)
- maria@ejemplo.com (Creador)

Nota: En el código PHP, las claves se verifican con:
password_verify("Prueba123", $hash_almacenado)
>>>>>>> 53c5bf011309e270d2c5e4fa9544df665db30bd6
' as 'Información de Acceso';
