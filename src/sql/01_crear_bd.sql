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
CREATE TABLE Usuario(
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre_usuario VARCHAR(64) NOT NULL,
	correo VARCHAR(128) NOT NULL UNIQUE,
	fecha_nacimiento DATE NOT NULL,
	clave VARCHAR(128) NOT NULL,
	CHECK (LENGTH(nombre_usuario) >= 4 AND LENGTH(clave) >= 4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- FIN DEL SCRIPT
-- ============================================

SELECT 'Base de datos creada exitosamente' as Mensaje;
