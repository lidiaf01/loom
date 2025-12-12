# Guía de Inicialización - Proyecto Loom
## Pasos para iniciar el proyecto desde cero

**Autor:** Lidia Artero Fernández  
**Proyecto:** Loom - Sprint 2  
**Fecha:** Diciembre 2025

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
     - `estilos/` (CSS)
     - `js/`
     - `modelos/`
     - `controladores/`
     - `vistas/`
     - `recursos/` (fuentes, iconos, imágenes, logo)
     - `uploads/` (Sprint 2 - para fotos de perfil)
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
    ├── estilos/           ← CSS (Sprint 1 y 2)
    ├── js/
    ├── modelos/
    ├── controladores/
    ├── vistas/
    ├── recursos/           ← Fuentes, iconos, imágenes, logo
    └── uploads/            ← Sprint 2 - Fotos de perfil
        └── perfiles/
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

# Dar permisos de escritura al directorio de uploads (Sprint 2)
sudo chmod -R 775 /opt/lampp/htdocs/loom/src/www/uploads
```

### Paso 4: Crear Directorio de Uploads (Sprint 2)

**IMPORTANTE:** El directorio de uploads es necesario para la funcionalidad de subida de fotos de perfil.

**Windows:**
1. Navegar a: `htdocs/loom/src/www/`
2. Crear carpeta: `uploads`
3. Dentro de `uploads`, crear carpeta: `perfiles`
4. Estructura final: `htdocs/loom/src/www/uploads/perfiles/`

**Linux:**
```bash
# Crear directorios
mkdir -p /opt/lampp/htdocs/loom/src/www/uploads/perfiles

# Dar permisos de escritura
sudo chmod -R 775 /opt/lampp/htdocs/loom/src/www/uploads
```

**Verificar:**
- El directorio debe existir en: `src/www/uploads/perfiles/`
- Debe tener permisos de escritura para que PHP pueda guardar archivos

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

**IMPORTANTE:** Los scripts SQL deben importarse en el siguiente orden:

#### 1. Importar Estructura Base (01_crear_bd.sql)

1. **Seleccionar base de datos**
   - Clic en `loom_db` en el menú lateral

2. **Ir a pestaña "Importar"**
   - Clic en la pestaña "Importar" en la parte superior

3. **Seleccionar archivo**
   - Clic en "Elegir archivo"
   - Navegar a: `proyecto-loom/src/sql/01_crear_bd.sql`
   - Seleccionar el archivo

4. **Importar**
   - Clic en "Continuar" o "Ejecutar"
   - Esperar a que termine la importación
   - Verificar mensaje de éxito

#### 2. Importar Datos Iniciales (02_datos_iniciales.sql) - Opcional

1. **Mantener seleccionada la BD `loom_db`**

2. **Ir a pestaña "Importar" nuevamente**

3. **Seleccionar segundo archivo**
   - Clic en "Elegir archivo"
   - Navegar a: `proyecto-loom/src/sql/02_datos_iniciales.sql`
   - Seleccionar el archivo

4. **Importar**
   - Clic en "Continuar" o "Ejecutar"
   - Esperar a que termine la importación
   - Verificar mensaje de éxito

#### 3. Importar Tabla Diario (03_diario.sql) - Sprint 2

1. **Mantener seleccionada la BD `loom_db`**

2. **Ir a pestaña "Importar" nuevamente**

3. **Seleccionar tercer archivo**
   - Clic en "Elegir archivo"
   - Navegar a: `proyecto-loom/src/sql/03_diario.sql`
   - Seleccionar el archivo

4. **Importar**
   - Clic en "Continuar" o "Ejecutar"
   - Esperar a que termine la importación
   - Verificar mensaje de éxito

### Paso 4: Verificar Importación

1. **Verificar tablas creadas**
   - En phpMyAdmin, con loom_db seleccionada
   - Debe aparecer en la lista:
     * `usuarios` (Sprint 1)
     * `diario` (Sprint 2 - nueva)

2. **Verificar datos insertados** (si importaste 02_datos_iniciales.sql)
   - Clic en la tabla "usuarios"
   - Clic en pestaña "Examinar"
   - Debe mostrar usuarios de prueba (si se importaron datos iniciales)

3. **Verificar estructura de tabla diario**
   - Clic en la tabla "diario"
   - Clic en pestaña "Estructura"
   - Debe tener las columnas: id_entrada, id_usuario, titulo, contenido, fecha_entrada, estado_animo, fecha_creacion, fecha_actualizacion

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

**Pantalla Principal (Dashboard):**
- Banner de bienvenida visible con saludo personalizado
- Tarjetas de herramientas: Diario, Stats, Crear, Últimas lecturas
- Barra de navegación inferior con: Principal, Buscar, Biblioteca, Perfil
- Botón de perfil circular en la esquina superior derecha

**Navegación:**
- Logo "Loom" redirige a pantalla principal
- Cerrar sesión funciona correctamente
- Redirección si intentas acceder sin estar autenticado

**Nuevas Funcionalidades (Sprint 2):**

**Perfil de Usuario:**
- Acceder desde el botón de perfil en el dashboard o desde la navegación inferior
- Ver información del perfil: nombre, email, biografía, foto
- Editar perfil: modificar nombre, email, biografía, fecha de nacimiento
- Subir/cambiar foto de perfil (formatos: JPG, PNG, WebP, máximo 5MB)

**Diario Personal:**
- Acceder desde la tarjeta "Diario" en el dashboard
- Crear nueva entrada de diario con título, contenido, fecha y estado de ánimo
- Ver lista de entradas con paginación
- Editar entradas existentes
- Eliminar entradas (con confirmación)
- Buscar entradas por término en título o contenido

---

## 6. Solución de Problemas

### Problema: Aparece listado de directorios en lugar de la aplicación

**Síntoma:** Al acceder a `http://localhost/loom/` aparece un listado de archivos en lugar de la aplicación.

**Causa:** Los archivos no están en la ubicación correcta o falta el archivo `index.php`.

**Solución:**
1. Verificar que `index.php` esté directamente en `htdocs/loom/`
2. Verificar que la estructura de carpetas sea correcta (ver Paso 2 de Configuración del Proyecto)
3. Si los archivos están en `htdocs/loom/src/www/`, moverlos a `htdocs/loom/`

### Problema: Error al subir foto de perfil (Sprint 2)

**Síntoma:** Al intentar subir una foto de perfil aparece un error.

**Causas posibles:**
1. El directorio `uploads/perfiles/` no existe
2. El directorio no tiene permisos de escritura
3. El archivo es demasiado grande (máximo 5MB)
4. El formato no es válido (solo JPG, PNG, WebP)

**Solución:**
1. Verificar que existe `src/www/uploads/perfiles/`
2. En Linux, dar permisos: `sudo chmod -R 775 src/www/uploads`
3. Verificar tamaño del archivo (máximo 5MB)
4. Verificar formato del archivo
5. Revisar configuración de PHP (`upload_max_filesize` y `post_max_size` en `php.ini`)

### Problema: Error "Tabla 'diario' no existe" (Sprint 2)

**Síntoma:** Al acceder al diario aparece un error de base de datos.

**Causa:** No se importó el script `03_diario.sql`.

**Solución:**
1. Acceder a phpMyAdmin
2. Seleccionar la base de datos `loom_db`
3. Ir a pestaña "Importar"
4. Importar el archivo `src/sql/03_diario.sql`
5. Verificar que la tabla `diario` aparece en la lista

### Problema: Las fuentes no se cargan correctamente

**Síntoma:** El texto se ve con fuente genérica en lugar de las fuentes personalizadas.

**Causa:** Las rutas de las fuentes no son correctas o los archivos no están en su lugar.

**Solución:**
1. Verificar que las fuentes estén en `src/www/recursos/fuentes/`
2. Verificar que los archivos `.ttf` estén presentes
3. Revisar las rutas en `src/www/estilos/style.css` (deben usar `ASSETS_URL`)
4. Limpiar caché del navegador (Ctrl+F5)

### Problema: Error de permisos en Linux

**Síntoma:** No se pueden crear o modificar archivos.

**Solución:**
```bash
# Dar permisos completos al proyecto
sudo chmod -R 755 /opt/lampp/htdocs/loom

# Dar permisos de escritura a uploads
sudo chmod -R 775 /opt/lampp/htdocs/loom/src/www/uploads

# Cambiar propietario si es necesario
sudo chown -R www-data:www-data /opt/lampp/htdocs/loom
```

### Problema: Error de conexión a la base de datos

**Síntoma:** Aparece error "Error de conexión a la base de datos".

**Causas posibles:**
1. MySQL no está iniciado
2. Credenciales incorrectas en `config.php`
3. La base de datos no existe

**Solución:**
1. Verificar que MySQL esté corriendo en XAMPP Control Panel
2. Verificar credenciales en `config.php`
3. Verificar que la base de datos `loom_db` existe en phpMyAdmin
4. Si MySQL tiene clave, actualizar `DB_PASS` en `config.php`

---

