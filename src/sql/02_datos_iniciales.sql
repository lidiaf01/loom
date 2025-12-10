-- ============================================
-- PROYECTO LOOM - Datos Iniciales
-- ============================================

USE loom_db;

SET NAMES utf8mb4;

-- Usuario de prueba
-- Contraseña: Prueba123
-- Hash generado con password_hash('Prueba123', PASSWORD_DEFAULT)
INSERT INTO usuarios (nombre_usuario, email, clave, fecha_nacimiento, biografia, rol) VALUES
('david_usuario', 'david@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2005-06-15', 'Usuario de prueba', 'usuario'),
('admin_loom', 'admin@loom.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1990-01-15', 'Administrador', 'admin');

-- Verificación
SELECT 'Datos insertados correctamente' as Estado;
SELECT COUNT(*) as Total FROM usuarios;
