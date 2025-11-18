# 🌟 Proyecto Loom

> Plataforma social educativa enfocada en el bienestar y desarrollo de jóvenes

![Estado del Proyecto](https://img.shields.io/badge/estado-en%20desarrollo-yellow)
![Sprint Actual](https://img.shields.io/badge/sprint-1-blue)
![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-purple)
![MySQL Version](https://img.shields.io/badge/MySQL-8.0%2B-orange)

---

## 📖 Descripción

Loom es una red social diseñada para jóvenes que busca promover contenido educativo de calidad, hábitos saludables y desarrollo personal, alejándose del contenido nocivo presente en redes sociales tradicionales.

### Características Principales (Sprint 1)
- ✅ Sistema de autenticación seguro (registro y login)
- ✅ Validaciones robustas en cliente y servidor
- ✅ Pantalla principal con navegación
- ✅ Diseño responsive (Mobile First)
- ✅ Sesiones PHP seguras
- ✅ Base de datos MySQL estructurada

### Características Planificadas (Futuros Sprints)
- 📝 Publicación de contenido filtrado (artículos, videos, imágenes)
- 📚 Biblioteca personal para organizar contenido
- 💬 Sistema de mensajería entre usuarios
- 📖 Diario personal privado
- 🎯 Contenido categorizado por temáticas
- 🔍 Búsqueda y filtrado avanzado

---

## 🚀 Inicio Rápido para el Profesor

### Requisitos Previos
- **XAMPP, WAMP o MAMP** (Apache + MySQL + PHP 8.0+)
- **Navegador web moderno** (Chrome, Firefox, Edge)
- **100 MB de espacio libre** en disco

### Instalación en 5 Pasos

#### 1️⃣ Descargar e Instalar XAMPP
```
Descargar desde: https://www.apachefriends.org/
Instalar siguiendo el asistente
Ubicación sugerida: C:\xampp (Windows) o /opt/lampp (Linux)
```

#### 2️⃣ Copiar Proyecto
```
Ubicar la carpeta src/www/ en:
- Windows: C:\xampp\htdocs\loom\
- Linux: /opt/lampp/htdocs/loom/
- Mac: /Applications/MAMP/htdocs/loom/
```

**Importante:** Copiar TODO el contenido de `src/www/` dentro de `htdocs/loom/`

#### 3️⃣ Iniciar Servicios
```
Abrir XAMPP Control Panel
▶️ Start Apache
▶️ Start MySQL
```

#### 4️⃣ Crear Base de Datos
```
1. Abrir navegador: http://localhost/phpmyadmin
2. Clic en "Nueva" base de datos
3. Nombre: loom_db
4. Cotejamiento: utf8mb4_unicode_ci
5. Clic en "Crear"
6. Seleccionar loom_db
7. Ir a pestaña "Importar"
8. Seleccionar archivo: src/sql/01_crear_bd.sql
9. Clic en "Continuar"
10. Repetir con: src/sql/02_datos_iniciales.sql
```

#### 5️⃣ Configurar Credenciales (si es necesario)
```
Editar archivo: src/www/config.php

Verificar/ajustar estas líneas si tu configuración es diferente:
define('DB_HOST', 'localhost');
define('DB_NAME', 'loom_db');
define('DB_USER', 'root');        // Cambiar si es necesario
define('DB_PASS', '');            // Añadir contraseña si existe
```

#### 6️⃣ Acceder a la Aplicación
```
Abrir navegador
Ir a: http://localhost/loom/
¡Listo! Ya puedes usar Loom
```

---

## 👤 Usuarios de Prueba

Después de importar `02_datos_iniciales.sql`, puedes usar estas credenciales:

| Email | Contraseña | Rol |
|-------|------------|-----|
| david@ejemplo.com | Prueba123 | Usuario/Creador |
| admin@loom.com | Prueba123 | Administrador |
| maria@ejemplo.com | Prueba123 | Creador |

**Nota:** Todos los usuarios de prueba tienen la misma contraseña: `Prueba123`

---

## 📁 Estructura del Proyecto

```
proyecto-loom/
│
├── 📄 README.md                 # Este archivo
├── 📄 .gitignore               # Archivos ignorados por Git
│
├── 📂 doc/                      # Documentación del proyecto
│   ├── Sprint_1.md              # Documentación del Sprint 1
│   ├── product_backlog.md      # Backlog del producto
│   └── sprint1_backlog.md       # Backlog del Sprint 1
│
├── 📂 diseño/                   # Diseño visual
│   ├── bocetos/                 # Bocetos de pantallas
│   └── guia_estilos.pdf        # Guía de estilos
│
├── 📂 herramientas/            # Guías y comandos útiles
│   └── comandos_utiles.md      # Comandos Git, MySQL, etc.
│
└── 📂 src/                     # Código fuente
    ├── 📂 sql/                 # Scripts de base de datos
    │   ├── 01_crear_bd.sql    # Crea tablas
    │   └── 02_datos_iniciales.sql  # Datos de prueba
    │
    └── 📂 www/                 # Aplicación web
        ├── index.php           # Punto de entrada
        ├── config.php          # Configuración
        │
        ├── 📂 assets/          # Recursos estáticos
        │   └── img/            # Imágenes
        │
        ├── 📂 css/             # Hojas de estilo
        │   ├── style.css       # Estilos principales
        │   └── auth.css        # Estilos de autenticación
        │
        ├── 📂 js/              # JavaScript
        │   ├── main.js         # Funciones principales
        │   ├── validaciones.js # Validaciones de formularios
        │   └── auth.js         # Lógica de autenticación
        │
        ├── 📂 modelos/         # Lógica de datos
        │   ├── Database.php   # Conexión a BD (Singleton)
        │   └── Usuario.php     # Modelo de usuario
        │
        ├── 📂 controladores/   # Lógica de negocio
        │   ├── AuthController.php  # Controlador de autenticación
        │   └── auth_router.php     # Router de autenticación
        │
        └── 📂 vistas/          # Interfaz de usuario
            ├── layout/          # Plantillas comunes
            │   ├── header.php
            │   └── footer.php
            ├── auth/           # Vistas de autenticación
            │   ├── menu_login_registro.php
            │   ├── registro.php
            │   └── login.php
            └── home/           # Vistas principales
                └── pantalla_principal.php
```

---

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8.0+** - Lenguaje del lado del servidor
- **MySQL 8.0** - Base de datos relacional
- **Arquitectura MVC** - Patrón de diseño
- **PDO** - Interfaz de acceso a base de datos

### Frontend
- **HTML5** - Estructura
- **CSS3** - Estilos (Mobile First, Flexbox/Grid)
- **JavaScript ES6+** - Interactividad y validaciones
- **Fetch API** - Comunicación asíncrona

### Herramientas
- **XAMPP** - Entorno de desarrollo local
- **Git** - Control de versiones
- **phpMyAdmin** - Gestión de base de datos

---

## ⚙️ Configuración Avanzada

### Cambiar Puerto de Apache (si 80 está ocupado)

1. Abrir XAMPP Control Panel
2. Clic en "Config" (Apache)
3. Seleccionar "httpd.conf"
4. Buscar: `Listen 80`
5. Cambiar a: `Listen 8080` (o cualquier puerto libre)
6. Guardar y reiniciar Apache
7. Acceder a: `http://localhost:8080/loom/`

### Configurar Base de Datos Personalizada

Editar `src/www/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'loom_db');
define('DB_USER', 'root');           // Cambiar si es necesario
define('DB_PASS', '');               // Añadir contraseña si existe
define('DB_PORT', '3306');           // Cambiar si es necesario
```

---

## 🐛 Solución de Problemas

### ❌ Error: "No se puede conectar a la base de datos"
**Solución:**
1. Verificar que MySQL esté corriendo en XAMPP
2. Comprobar credenciales en `config.php`
3. Verificar que la BD `loom_db` exista en phpMyAdmin
4. Comprobar que los scripts SQL se importaron correctamente

### ❌ Error 404 - Página no encontrada
**Solución:**
1. Verificar que Apache esté corriendo
2. Comprobar la ruta: debe ser `http://localhost/loom/`
3. Verificar que los archivos estén en `htdocs/loom/`
4. Comprobar que `index.php` existe en la raíz de `loom/`

### ❌ Página en blanco
**Solución:**
1. Activar errores PHP en `config.php`: `ini_set('display_errors', 1);`
2. Revisar logs: `xampp/apache/logs/error.log`
3. Verificar permisos de carpetas (Linux/Mac)
4. Comprobar que todas las rutas en `config.php` sean correctas

### ❌ No se muestran estilos CSS
**Solución:**
1. Limpiar caché del navegador: `Ctrl + Shift + R`
2. Verificar rutas en HTML (deben usar la función `url()`)
3. Revisar consola del navegador (F12) para errores
4. Comprobar que los archivos CSS existan en `css/`

### ❌ Puerto 80 o 3306 en uso
**Solución:**
1. Cambiar puertos en configuración de XAMPP
2. O detener otros servicios (Skype, IIS, etc.)
3. Usar `netstat -ano | findstr :80` (Windows) para ver qué usa el puerto

### ❌ Error al registrar usuario: "Email ya existe"
**Solución:**
- Es normal si ya existe el usuario de prueba
- Usa otro email o elimina el usuario desde phpMyAdmin

---

## 📝 Estado del Desarrollo

### Sprint 1 (Actual) ✅
- [x] Configuración de entorno
- [x] Estructura de proyecto
- [x] Base de datos inicial
- [x] Sistema de registro
- [x] Sistema de login
- [x] Pantalla principal
- [x] Validaciones cliente/servidor
- [x] Diseño responsive

### Próximos Sprints 🔜
- Sprint 2: Perfil de usuario y publicaciones
- Sprint 3: Categorías y búsqueda
- Sprint 4: Sistema de mensajería
- Sprint 5: Diario personal y biblioteca

---

## 🧪 Pruebas Recomendadas

### Pruebas de Registro
1. Registrar usuario nuevo con datos válidos
2. Intentar registrar con email duplicado
3. Intentar registrar con contraseña débil
4. Intentar registrar siendo menor de 13 años

### Pruebas de Login
1. Iniciar sesión con credenciales correctas
2. Intentar login con email incorrecto
3. Intentar login con contraseña incorrecta
4. Probar opción "Recordar sesión"

### Pruebas de Navegación
1. Acceder a pantalla principal sin estar autenticado (debe redirigir)
2. Cerrar sesión y verificar redirección
3. Navegar entre diferentes secciones

---

## 👥 Equipo

**Desarrollador:** Lidia Artero Fernández  
**Curso:** 2025/26 - DAW (Desarrollo de Aplicaciones Web)  
**Metodología:** Scrum  
**Institución:** [Nombre de la institución]

---

## 📞 Soporte

Si tienes problemas para ejecutar el proyecto:

1. **Revisa esta documentación** - La mayoría de problemas están resueltos aquí
2. **Consulta:** `herramientas/comandos_utiles.md`
3. **Revisa logs:** `xampp/apache/logs/error.log`
4. **Verifica la documentación del Sprint:** `doc/Sprint_1.md`

---

## 📜 Licencia

Este proyecto es desarrollado con fines educativos para el curso DAW 2025/26.

---

## 🙏 Agradecimientos

- Documentación oficial de PHP
- Comunidad de Stack Overflow
- Profesores y compañeros del curso DAW
- Documentación de MySQL y PDO

---

## 📚 Documentación Adicional

- **🚀 Inicialización:** `doc/INICIALIZACION.md` - **Guía paso a paso para iniciar el proyecto desde cero**
- **🔧 Solución Rápida:** `doc/SOLUCION_RUTA.md` - **Solución para problemas de rutas y estructura de archivos**
- **⚡ Script Automático:** `mover_archivos.ps1` - Script PowerShell para corregir la estructura automáticamente
- **Sprint 1:** `doc/Sprint_1.md` - Documentación completa del sprint
- **Comandos útiles:** `herramientas/comandos_utiles.md` - Guía de comandos Git, MySQL, etc.
- **Product Backlog:** `doc/product_backlog.md` - Historias de usuario del proyecto

---

**Última actualización:** Noviembre 2025  
**Versión:** 1.0.0 (Sprint 1)  
**Estado:** ✅ Funcional y listo para despliegue
