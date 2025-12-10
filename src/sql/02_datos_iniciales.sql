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
-- INSERTAR USUARIO DE PRUEBA
-- Clave: "1234" (hash MD5: 81dc9bdb52d04dc20036dbd8313ed055)
-- ============================================

-- Usuario inicial de la aplicación
INSERT INTO Usuario (nombre_usuario, correo, fecha_nacimiento, clave) VALUES 
('abcd', 'usuario@loom.com', '2000-01-01', MD5('1234'));

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
IMPORTANTE - Usuario de prueba:
Nombre de usuario: abcd
Contraseña: 1234
Correo: usuario@loom.com

Nota: La contraseña está almacenada como hash MD5.
' as 'Información de Acceso';
