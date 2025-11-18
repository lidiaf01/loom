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

###  HU-01: Registro de Usuario (Prioridad: Alta)
**Como:** usuario nuevo  
**Quiero:** registrarme en Loom  
**Para:** acceder a los contenidos y funcionalidades de la plataforma

**Criterios de aceptación cumplidos:**
- (HECHO)Formulario con nombre de usuario, email, fecha de nacimiento y contraseña
- (HECHO)Validación de email único en el sistema
- (HECHO)Validación de contraseña segura (mínimo 8 caracteres, mayúscula, minúscula y número)
- (HECHO)Validación de edad mínima (13 años)
- (HECHO)Almacenamiento seguro de contraseña (hash con password_hash)
- Mensaje de confirmación tras registro exitoso
- Redirección automática a pantalla principal
**Estado:**  Incompleto

---

### HU-02: Inicio de Sesión (Prioridad: Alta)
**Como:** usuario registrado  
**Quiero:** iniciar sesión con mis credenciales  
**Para:** acceder a mi cuenta y contenido personalizado

**Criterios de aceptación cumplidos:**
- (HECHO) Formulario con email y contraseña
- (HECHO)Validación de credenciales correctas
- (HECHO)Mensaje de error claro en caso de credenciales incorrectas
- (HECHO) Creación de sesión PHP segura
- (HECHO) Redirección a pantalla principal tras login exitoso
- (HECHO) Opción "Recordar sesión" (cookie)

**Story Points:** 3  
**Estado:**  Completado

---

### HU-03: Pantalla Principal (Prioridad: Media)
**Como:** usuario autenticado  
**Quiero:** acceder a la pantalla principal con navegación  
**Para:** poder usar las funcionalidades básicas de Loom

**Criterios de aceptación cumplidos:**
- (HECHO) Diseño responsive de pantalla principal
- (HECHO) Menú de navegación con opciones: Crear, Búsqueda, Perfil, Diario, Biblioteca, Ajustes
- (HECHO) Logo de Loom visible
- (HECHO) Protección de ruta (solo usuarios autenticados)
**Story Points:** 5  
**Estado:** Completado

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
- Registro de usuarios con validaciones completas
-  Login con verificación de credenciales
-  Logout con destrucción de sesión
-  Protección de rutas (middleware de autenticación)
-  Sesiones PHP seguras
-  Cookies para "Recordar sesión"
### Validaciones
-  Validación en cliente (JavaScript)
-  Validación en servidor (PHP)
-  Mensajes de error claros y específicos
-  Validación de contraseña segura
-  Validación de edad mínima
-  Validación de email único
### Interfaz de Usuario
-  Diseño responsive (Mobile First)
-  Formularios accesibles y usables
-  Mensajes de éxito/error visuales
-  Navegación intuitiva
-  Banner de bienvenida animado

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

