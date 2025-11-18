# Guía de Inicialización - Proyecto Loom
## Pasos para iniciar el proyecto desde cero

**Autor:** Lidia Artero Fernández  
**Proyecto:** Loom - Sprint 1  
**Fecha:** Noviembre 2025

---

## Índice

1. [Requisitos Previos](#requisitos-previos)
2. [Instalación de XAMPP](#instalación-de-xampp)
3. [Configuración del Proyecto](#configuración-del-proyecto)
4. [Configuración de la Base de Datos](#configuración-de-la-base-de-datos)
5. [Verificación y Pruebas](#verificación-y-pruebas)
6. [Solución de Problemas](#solución-de-problemas)

---

## 1. Requisitos Previos

### Software Necesario

Antes de comenzar, asegúrate de tener instalado:

- **XAMPP** (recomendado)
  - Descarga: https://www.apachefriends.org/
  - Versión: PHP 8.0 o superior
  - Incluye: Apache, MySQL, PHP, phpMyAdmin

- **Navegador web moderno**
  - Chrome, Firefox, Edge o Safari
  - Versión actualizada

- **Editor de código** (opcional pero recomendado)
  - Visual Studio Code
  - PHPStorm
  - Sublime Text

### Espacio en Disco

- Mínimo: **100 MB** de espacio libre

---

## 2. Instalación de XAMPP

### Windows

1. **Descargar XAMPP**
   - Ir a: https://www.apachefriends.org/
   - Descargar la versión para Windows
   - Seleccionar PHP 8.0 o superior

2. **Instalar XAMPP**
   - Ejecutar el instalador descargado
   - Seguir el asistente de instalación
   - Ubicación recomendada: C:\xampp
   - Marcar Apache, MySQL y phpMyAdmin durante la instalación

3. **Iniciar XAMPP Control Panel**
   - Buscar "XAMPP Control Panel" en el menú de inicio
   - Ejecutar como administrador (recomendado)

4. **Iniciar Servicios**
   - En XAMPP Control Panel:
     1. Clic en "Start" junto a Apache
     2. Clic en "Start" junto a MySQL
     3. Verificar que ambos muestren "Running" en verde

### Linux

1. **Descargar XAMPP**
   ```bash
   wget https://www.apachefriends.org/xampp-files/[versión]/xampp-linux-x64-[versión].run
   ```

2. **Instalar**
   ```bash
   chmod +x xampp-linux-x64-*.run
   sudo ./xampp-linux-x64-*.run
   ```

3. **Iniciar Servicios**
   ```bash
   sudo /opt/lampp/lampp start
   ```

---

## 3. Configuración del Proyecto

### Paso 1: Ubicar la Carpeta del Proyecto

**Windows:**
```
C:\xampp\htdocs\
```

**Linux:**
```
/opt/lampp/htdocs/
```

### Paso 2: Copiar Archivos del Proyecto

**IMPORTANTE:** Debes copiar SOLO el contenido de `src/www/`, NO toda la carpeta del proyecto.

1. **Abrir la carpeta del proyecto Loom**
   - Navegar hasta: `proyecto-loom/src/www/`
   - **NO copiar** la carpeta `src/` completa
   - **NO copiar** las carpetas `doc/`, `docs/`, `herramientas/` o `sql/`

2. **Copiar todo el contenido de src/www/**
   - Seleccionar TODOS los archivos y carpetas dentro de `src/www/`:
     - `index.php`
     - `config.php`
     - `assets/`
     - `css/`
     - `js/`
     - `modelos/`
     - `controladores/`
     - `vistas/`
   - Copiar (Ctrl+C / Cmd+C)

3. **Pegar en htdocs**
   - Navegar a la carpeta `htdocs/` de XAMPP
   - Crear carpeta: `loom` (si no existe)
   - Pegar el contenido dentro de `htdocs/loom/`
   - **Asegúrate de que `index.php` esté directamente en `htdocs/loom/`**

**Estructura final esperada (CORRECTA):**
```
htdocs/
└── loom/
    ├── index.php          ← Debe estar aquí directamente
    ├── config.php
    ├── assets/
    ├── css/
    ├── js/
    ├── modelos/
    ├── controladores/
    └── vistas/
```

**Estructura INCORRECTA (evitar):**
```
htdocs/
└── loom/
    ├── doc/              ← NO debe estar aquí
    ├── docs/             ← NO debe estar aquí
    ├── src/               ← NO debe estar aquí
    │   └── www/          ← Los archivos NO deben estar aquí dentro
    └── ...
```

4. **Verificar estructura correcta**
   - Abrir `htdocs/loom/` en el explorador de archivos
   - Debe aparecer `index.php` directamente en esa carpeta
   - Si ves carpetas `doc/`, `docs/` o `src/` en `htdocs/loom/`, la estructura está incorrecta

### Paso 3: Verificar Permisos (Linux)

```bash
# Dar permisos de lectura/escritura
sudo chmod -R 755 /opt/lampp/htdocs/loom
```

---

## 4. Configuración de la Base de Datos

### Paso 1: Acceder a phpMyAdmin

1. **Abrir navegador**
2. **Ir a:** `http://localhost/phpmyadmin`
3. **Verificar acceso**
   - Usuario por defecto: `root`
   - Clave por defecto: (vacía en XAMPP)

### Paso 2: Crear Base de Datos

1. **Crear nueva base de datos**
   - Clic en "Nueva" en el menú lateral izquierdo
   - Nombre de la base de datos: loom_db
   - Cotejamiento: utf8mb4_unicode_ci
   - Clic en "Crear"

2. **Verificar creación**
   - Debe aparecer `loom_db` en la lista de bases de datos

### Paso 3: Importar Scripts SQL

#### Importar Estructura (bbdd.sql)

1. **Seleccionar base de datos**
   - Clic en `loom_db` en el menú lateral

2. **Ir a pestaña "Importar"**
   - Clic en la pestaña "Importar" en la parte superior

3. **Seleccionar archivo**
   - Clic en "Elegir archivo"
   - Navegar a: `proyecto-loom/src/sql/bbdd.sql`
   - Seleccionar el archivo

4. **Importar**
   - Clic en "Continuar" o "Ejecutar"
   - Esperar a que termine la importación
   - Verificar mensaje de éxito

#### Importar Datos (datos_iniciales.sql)

1. **Mantener seleccionada la BD `loom_db`**

2. **Ir a pestaña "Importar" nuevamente**

3. **Seleccionar segundo archivo**
   - Clic en "Elegir archivo"
   - Navegar a: `proyecto-loom/src/sql/datos_iniciales.sql`
   - Seleccionar el archivo

4. **Importar**
   - Clic en "Continuar" o "Ejecutar"
   - Esperar a que termine la importación
   - Verificar mensaje de éxito

### Paso 4: Verificar Importación

1. **Verificar tablas creadas**
   - En phpMyAdmin, con loom_db seleccionada
   - Debe aparecer en la lista:
     * usuarios
     * sesiones

2. **Verificar datos insertados**
   - Clic en la tabla "usuarios"
   - Clic en pestaña "Examinar"
   - Debe mostrar al menos 3 usuarios de prueba

### Paso 5: Configurar Credenciales (si es necesario)

1. **Abrir archivo de configuración**
   ```
   Ruta: htdocs/loom/config.php
   ```

2. **Verificar/Modificar credenciales**
   ```php
   // Si tu MySQL tiene clave, modifica estas líneas:
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'loom_db');
   define('DB_USER', 'root');        // Cambiar si es necesario
   define('DB_PASS', '');            // Añadir clave si existe
   ```

   **Nota:** Por defecto en XAMPP, el usuario es `root` y no hay clave.

---

## 5. Verificación y Pruebas

### Paso 1: Acceder a la Aplicación

1. **Abrir navegador**

2. **Ir a la URL correcta:**
   ```
   http://localhost/loom/
   ```
   - Esta es la ruta que debes usar si seguiste correctamente el Paso 2
   - Debe mostrar la pantalla de bienvenida de Loom

3. **Verificar que carga correctamente:**
   - **CORRECTO:** Debe aparecer la pantalla de bienvenida de Loom con opciones "Iniciar Sesión" y "Registrarse"
   - **INCORRECTO:** Si aparece un listado de directorios (Index of /loom), los archivos no están en la ubicación correcta

4. **Si aparece listado de directorios:**
   - Ver sección de solución de problemas más abajo: "Aparece listado de directorios en lugar de la aplicación"

### Paso 2: Probar Registro

1. **Clic en "Registrarse"**
2. **Completar formulario:**
   ```
   Nombre de usuario: test_user
   Email: test@ejemplo.com
   Fecha de nacimiento: 2005-01-01 (o cualquier fecha que dé 13+ años)
   Clave: Test1234 (debe tener mayúscula, minúscula y número)
   Confirmar clave: Test1234
   ```
3. **Clic en "Registrarse"**
4. **Verificar:**
   - Debe mostrar mensaje de éxito
   - Debe redirigir a la pantalla principal
   - Debe mostrar el nombre de usuario en el header

### Paso 3: Probar Login con Usuario de Prueba

1. **Cerrar sesión** (si estás logueado)
2. **Clic en "Iniciar Sesión"**
3. **Usar credenciales de prueba:**
   ```
   Email: admin@loom.es
   Clave: Prueba123
   ```
4. **Clic en "Iniciar sesión"**
5. **Verificar:**
   - Debe iniciar sesión correctamente
   - Debe redirigir a la pantalla principal
   - Debe mostrar el menú de navegación

### Paso 4: Verificar Funcionalidades

**Pantalla Principal:**
- Banner de bienvenida visible
- Menú de navegación con 6 opciones
- Información del perfil del usuario
- Botón "Cerrar sesión" funcional

**Navegación:**
- Logo "Loom" redirige a pantalla principal
- Cerrar sesión funciona correctamente
- Redirección si intentas acceder sin estar autenticado

---

