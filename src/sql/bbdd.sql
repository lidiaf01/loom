-- ============================================
-- PROYECTO LOOM - Base de Datos Sprint 1
-- Archivo: 01_crear_bd.sql
-- Propósito: Crear estructura básica para Sprint 1
-- Autor: Lidia Artero Fernández
-- Fecha: Noviembre 2025
-- ============================================

-- Crear base de datos si no existe
CREATE DATABASE IF NOT EXISTS loom_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE loom_db;

-- Configuración inicial
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================
-- TABLA: usuarios
-- Almacena información de todos los usuarios
-- ============================================
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
-- FIN DEL SCRIPT
-- ============================================

SELECT 'Base de datos creada exitosamente para Sprint 1' as Mensaje;

