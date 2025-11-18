# Sprint 1 - Proyecto Loom
## Metodología Scrum - Curso 2025/26 DAW

---

## 1. Información General del Sprint

**Proyecto:** Loom - Plataforma social educativa para jóvenes  
**Duración del Sprint:** 2 semanas (10 días laborables)  
**Fecha inicio:** Noviembre 2025  
**Fecha fin:** Noviembre 2025  
**Scrum Master/Desarrollador:** Lidia Artero Fernández

---

## 2. Objetivo del Sprint

Establecer la infraestructura base del proyecto Loom, implementando el sistema de autenticación de usuarios y la estructura principal de navegación. Al finalizar este sprint, se podrá registrar usuarios, iniciar sesión y acceder a la pantalla principal de la aplicación.

---

## 3. Historias de Usuario Completadas

### ✅ HU-01: Registro de Usuario (Prioridad: Alta)
**Como:** usuario nuevo  
**Quiero:** registrarme en Loom  
**Para:** acceder a los contenidos y funcionalidades de la plataforma

**Criterios de aceptación cumplidos:**
- ✅ Formulario con nombre de usuario, email, fecha de nacimiento y contraseña
- ✅ Validación de email único en el sistema
- ✅ Validación de contraseña segura (mínimo 8 caracteres, mayúscula, minúscula y número)
- ✅ Validación de edad mínima (13 años)
- ✅ Almacenamiento seguro de contraseña (hash con password_hash)
- ✅ Mensaje de confirmación tras registro exitoso
- ✅ Redirección automática a pantalla principal

**Story Points:** 5  
**Estado:** ✅ Completado

---

### ✅ HU-02: Inicio de Sesión (Prioridad: Alta)
**Como:** usuario registrado  
**Quiero:** iniciar sesión con mis credenciales  
**Para:** acceder a mi cuenta y contenido personalizado

**Criterios de aceptación cumplidos:**
- ✅ Formulario con email y contraseña
- ✅ Validación de credenciales correctas
- ✅ Mensaje de error claro en caso de credenciales incorrectas
- ✅ Creación de sesión PHP segura
- ✅ Redirección a pantalla principal tras login exitoso
- ✅ Opción "Recordar sesión" (cookie)

**Story Points:** 3  
**Estado:** ✅ Completado

---

### ✅ HU-03: Pantalla Principal (Prioridad: Media)
**Como:** usuario autenticado  
**Quiero:** acceder a la pantalla principal con navegación  
**Para:** poder usar las funcionalidades básicas de Loom

**Criterios de aceptación cumplidos:**
- ✅ Diseño responsive de pantalla principal
- ✅ Menú de navegación con opciones: Crear, Búsqueda, Perfil, Diario, Biblioteca, Ajustes
- ✅ Logo de Loom visible
- ✅ Banner decorativo animado (CSS)
- ✅ Protección de ruta (solo usuarios autenticados)
- ✅ Botón de cerrar sesión funcional

**Story Points:** 5  
**Estado:** ✅ Completado

---

## 4. Tecnologías Utilizadas

### Backend
- **PHP 8.x** - Lógica de negocio y controladores
- **MySQL 8.x** - Sistema de gestión de base de datos relacional
- **Arquitectura MVC** - Patrón de diseño
- **PDO** - Interfaz de acceso a base de datos

### Frontend
- **HTML5** - Estructura de las vistas
- **CSS3** - Estilos y diseño responsive (Mobile First)
- **JavaScript ES6+** - Validaciones del lado del cliente e interactividad
- **Fetch API** - Comunicación asíncrona con el servidor

### Herramientas de Desarrollo
- **XAMPP/WAMP/MAMP** - Servidor local de desarrollo
- **Git** - Control de versiones
- **phpMyAdmin** - Gestión visual de MySQL

---

## 5. Estructura del Proyecto Implementada

```
proyecto-loom/
│
├── doc/
│   └── Sprint_1.md (este archivo)
│
├── herramientas/
│   └── comandos_utiles.md
│
└── src/
    ├── sql/
    │   ├── 01_crear_bd.sql
    │   └── 02_datos_iniciales.sql
    │
    └── www/
        ├── index.php
        ├── config.php
        │
        ├── assets/
        │   └── img/
        │       └── default_avatar.png
        │
        ├── css/
        │   ├── style.css
        │   └── auth.css
        │
        ├── js/
        │   ├── main.js
        │   ├── validaciones.js
        │   └── auth.js
        │
        ├── modelos/
        │   ├── Database.php
        │   └── Usuario.php
        │
        ├── controladores/
        │   ├── AuthController.php
        │   └── auth_router.php
        │
        └── vistas/
            ├── layout/
            │   ├── header.php
            │   └── footer.php
            ├── auth/
            │   ├── menu_login_registro.php
            │   ├── registro.php
            │   └── login.php
            └── home/
                └── pantalla_principal.php
```

---

## 6. Funcionalidades Implementadas

### Sistema de Autenticación
- ✅ Registro de usuarios con validaciones completas
- ✅ Login con verificación de credenciales
- ✅ Logout con destrucción de sesión
- ✅ Protección de rutas (middleware de autenticación)
- ✅ Sesiones PHP seguras
- ✅ Cookies para "Recordar sesión"

### Validaciones
- ✅ Validación en cliente (JavaScript)
- ✅ Validación en servidor (PHP)
- ✅ Mensajes de error claros y específicos
- ✅ Validación de contraseña segura
- ✅ Validación de edad mínima
- ✅ Validación de email único

### Interfaz de Usuario
- ✅ Diseño responsive (Mobile First)
- ✅ Formularios accesibles y usables
- ✅ Mensajes de éxito/error visuales
- ✅ Navegación intuitiva
- ✅ Banner de bienvenida animado

---

## 7. Base de Datos

### Tablas Creadas

#### `usuarios`
- `id_usuario` (PK, AUTO_INCREMENT)
- `nombre_usuario` (UNIQUE, VARCHAR(50))
- `email` (UNIQUE, VARCHAR(100))
- `contraseña` (VARCHAR(255) - hash)
- `fecha_nacimiento` (DATE)
- `biografia` (TEXT, nullable)
- `foto_perfil` (VARCHAR(255), default: 'default_avatar.png')
- `rol` (ENUM: usuario, creador, moderador, admin)
- `fecha_registro` (DATETIME)
- `ultimo_acceso` (DATETIME, nullable)
- `activo` (BOOLEAN, default: TRUE)

#### `sesiones`
- `id_sesion` (PK, AUTO_INCREMENT)
- `id_usuario` (FK)
- `token_sesion` (VARCHAR(255), UNIQUE)
- `ip_address` (VARCHAR(45))
- `user_agent` (TEXT)
- `fecha_creacion` (DATETIME)
- `fecha_expiracion` (DATETIME)
- `activa` (BOOLEAN)

### Usuarios de Prueba

| Email | Contraseña | Rol |
|-------|------------|-----|
| david@ejemplo.com | Prueba123 | Usuario |
| admin@loom.com | Prueba123 | Admin |
| maria@ejemplo.com | Prueba123 | Creador |

---

## 8. Instrucciones de Despliegue

Ver el archivo `README.md` en la raíz del proyecto para instrucciones detalladas de instalación y despliegue.

### Resumen Rápido:
1. Instalar XAMPP/WAMP/MAMP
2. Copiar `src/www/` a `htdocs/loom/`
3. Crear BD `loom_db` en phpMyAdmin
4. Importar `01_crear_bd.sql` y `02_datos_iniciales.sql`
5. Acceder a `http://localhost/loom/`

---

## 9. Criterios de Aceptación del Sprint

### Definition of Done (DoD)

✅ El código está escrito y funciona correctamente  
✅ Se han realizado pruebas manuales exitosas  
✅ El código está documentado (comentarios en funciones clave)  
✅ Se integra correctamente con el resto del sistema  
✅ Cumple con los criterios de aceptación definidos  
✅ Las vistas son responsive (móvil, tablet, desktop)  
✅ Se siguen las convenciones de código del proyecto  

---

## 10. Pruebas Realizadas

### Pruebas de Registro
- ✅ Registro con datos válidos
- ✅ Validación de email duplicado
- ✅ Validación de nombre de usuario duplicado
- ✅ Validación de contraseña débil
- ✅ Validación de edad insuficiente
- ✅ Campos requeridos

### Pruebas de Login
- ✅ Login con credenciales correctas
- ✅ Login con email incorrecto
- ✅ Login con contraseña incorrecta
- ✅ Opción "Recordar sesión"
- ✅ Redirección tras login exitoso

### Pruebas de Sesión
- ✅ Protección de rutas autenticadas
- ✅ Redirección si no está autenticado
- ✅ Logout funcional
- ✅ Destrucción de sesión y cookies

---

## 11. Problemas Encontrados y Soluciones

### Problema 1: Autoloader de clases
**Solución:** Implementado autoloader simple en `config.php` usando `spl_autoload_register()`

### Problema 2: Rutas relativas en producción
**Solución:** Función `url()` en `config.php` para generar URLs consistentes

### Problema 3: Validación de contraseña en cliente y servidor
**Solución:** Funciones de validación compartidas en JavaScript y PHP

---

## 12. Próximos Pasos (Sprint 2)

### Funcionalidades Planificadas:
- Perfil de usuario editable
- Sistema de publicaciones
- Categorías de contenido
- Búsqueda básica
- Sistema de likes/comentarios

---

## 13. Métricas del Sprint

- **Velocidad planificada:** 13 Story Points
- **Velocidad real:** 13 Story Points
- **Historias completadas:** 3 / 3
- **Horas estimadas:** 36h
- **Horas reales:** ~40h (incluyendo documentación)

---

## 14. Retrospectiva

### ¿Qué salió bien?
- Arquitectura MVC bien estructurada
- Validaciones robustas en cliente y servidor
- Diseño responsive funcional
- Código bien documentado

### ¿Qué se puede mejorar?
- Implementar tests automatizados
- Mejorar manejo de errores en producción
- Optimizar consultas SQL
- Añadir más validaciones de seguridad

### Acciones para el próximo sprint:
- Implementar sistema de publicaciones
- Añadir más interacciones sociales
- Mejorar la experiencia de usuario

---

**Última actualización:** Noviembre 2025  
**Versión:** 1.0  
**Responsable:** Lidia Artero Fernández

