-- ============================================
-- PROYECTO LOOM - Base de Datos MVC
-- Archivo: 01_crear_bd.sql
-- Propósito: Crear estructura básica para sistema MVC
-- Autor: Lidia Artero Fernández
-- Fecha: Noviembre 2025
-- ============================================

-- Crear base de datos si no existe
DROP DATABASE IF EXISTS loom_db;
CREATE DATABASE loom_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE loom_db;

-- Configuración inicial
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================
-- TABLA: Usuario
-- Almacena información de usuarios del sistema
-- ============================================
<<<<<<< HEAD
CREATE TABLE Usuario(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre_usuario VARCHAR(64) NOT NULL,
	correo VARCHAR(128) NOT NULL UNIQUE,
	fecha_nacimiento DATE NOT NULL,
	clave VARCHAR(128) NOT NULL,
	CHECK (LENGTH(nombre_usuario) >= 4 AND LENGTH(clave) >= 4)
=======
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL COMMENT 'Hash de la clave del usuario',
    fecha_nacimiento DATE NOT NULL,
    biografia TEXT DEFAULT NULL,
    foto_perfil VARCHAR(255) DEFAULT 'default_avatar.png',
    rol ENUM('usuario', 'creador', 'moderador', 'admin') DEFAULT 'usuario',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultimo_acceso DATETIME DEFAULT NULL,
    activo BOOLEAN DEFAULT TRUE,
    
    -- Índices para mejorar búsquedas
    INDEX idx_email (email),
    INDEX idx_nombre_usuario (nombre_usuario),
    INDEX idx_rol (rol),
    INDEX idx_fecha_registro (fecha_registro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- TABLA: sesiones
-- Almacena sesiones activas de usuarios
-- ============================================
CREATE TABLE IF NOT EXISTS sesiones (
    id_sesion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    token_sesion VARCHAR(255) NOT NULL UNIQUE,
    ip_address VARCHAR(45) DEFAULT NULL,
    user_agent TEXT DEFAULT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_expiracion DATETIME NOT NULL,
    activa BOOLEAN DEFAULT TRUE,
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    
    INDEX idx_usuario (id_usuario),
    INDEX idx_token (token_sesion),
    INDEX idx_fecha_expiracion (fecha_expiracion)
>>>>>>> 53c5bf011309e270d2c5e4fa9544df665db30bd6
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- FIN DEL SCRIPT
-- ============================================

SELECT 'Base de datos creada exitosamente' as Mensaje;
