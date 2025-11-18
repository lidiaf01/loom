# 🚀 Guía de Inicialización - Proyecto Loom
## Pasos para iniciar el proyecto desde cero

**Autor:** Lidia Artero Fernández  
**Proyecto:** Loom - Sprint 1  
**Fecha:** Noviembre 2025

---

## 📋 Índice

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

- ✅ **XAMPP, WAMP o MAMP** (recomendado: XAMPP)
  - Descarga: https://www.apachefriends.org/
  - Versión: PHP 8.0 o superior
  - Incluye: Apache, MySQL, PHP, phpMyAdmin

- ✅ **Navegador web moderno**
  - Chrome, Firefox, Edge o Safari
  - Versión actualizada

- ✅ **Editor de código** (opcional pero recomendado)
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
   ```
   - Ejecutar el instalador descargado
   - Seguir el asistente de instalación
   - Ubicación recomendada: C:\xampp
   - Marcar Apache, MySQL y phpMyAdmin durante la instalación
   ```

3. **Iniciar XAMPP Control Panel**
   - Buscar "XAMPP Control Panel" en el menú de inicio
   - Ejecutar como administrador (recomendado)

4. **Iniciar Servicios**
   ```
   En XAMPP Control Panel:
   1. Clic en "Start" junto a Apache
   2. Clic en "Start" junto a MySQL
   3. Verificar que ambos muestren "Running" en verde
   ```

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

### Mac

1. **Descargar MAMP**
   - Ir a: https://www.mamp.info/
   - Descargar e instalar MAMP

2. **Iniciar Servicios**
   - Abrir MAMP
   - Clic en "Start Servers"

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

**Mac (MAMP):**
```
/Applications/MAMP/htdocs/
```

### Paso 2: Copiar Archivos del Proyecto

⚠️ **IMPORTANTE:** Debes copiar SOLO el contenido de `src/www/`, NO toda la carpeta del proyecto.

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

### Paso 3: Verificar Permisos (Linux/Mac)

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
   - Contraseña por defecto: (vacía en XAMPP)

### Paso 2: Crear Base de Datos

1. **Crear nueva base de datos**
   ```
   - Clic en "Nueva" en el menú lateral izquierdo
   - Nombre de la base de datos: loom_db
   - Cotejamiento: utf8mb4_unicode_ci
   - Clic en "Crear"
   ```

2. **Verificar creación**
   - Debe aparecer `loom_db` en la lista de bases de datos

### Paso 3: Importar Scripts SQL

#### Importar Estructura (01_crear_bd.sql)

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

#### Importar Datos (02_datos_iniciales.sql)

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

### Paso 4: Verificar Importación

1. **Verificar tablas creadas**
   ```
   - En phpMyAdmin, con loom_db seleccionada
   - Debe aparecer en la lista:
     * usuarios
     * sesiones
   ```

2. **Verificar datos insertados**
   ```
   - Clic en la tabla "usuarios"
   - Clic en pestaña "Examinar"
   - Debe mostrar al menos 3 usuarios de prueba
   ```

### Paso 5: Configurar Credenciales (si es necesario)

1. **Abrir archivo de configuración**
   ```
   Ruta: htdocs/loom/config.php
   ```

2. **Verificar/Modificar credenciales**
   ```php
   // Si tu MySQL tiene contraseña, modifica estas líneas:
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'loom_db');
   define('DB_USER', 'root');        // Cambiar si es necesario
   define('DB_PASS', '');            // Añadir contraseña si existe
   ```

   **Nota:** Por defecto en XAMPP, el usuario es `root` y no hay contraseña.

---

## 5. Verificación y Pruebas

### Paso 1: Acceder a la Aplicación

1. **Abrir navegador**

2. **Ir a la URL correcta:**
   
   **Ruta CORRECTA (si los archivos están bien ubicados):**
   ```
   http://localhost/loom/
   ```
   - Esta es la ruta que debes usar si seguiste correctamente el Paso 2
   - Debe mostrar la pantalla de bienvenida de Loom

   **Ruta TEMPORAL (si los archivos están en src/www/):**
   ```
   http://localhost/loom/src/www/
   ```
   - Solo usar esta ruta si los archivos están en `htdocs/loom/src/www/`
   - ⚠️ **No es la estructura recomendada**, deberías mover los archivos a la raíz
   - Ver sección de solución de problemas para mover los archivos correctamente

3. **Verificar que carga correctamente:**
   - ✅ **CORRECTO:** Debe aparecer la pantalla de bienvenida de Loom con opciones "Iniciar Sesión" y "Registrarse"
   - ❌ **INCORRECTO:** Si aparece un listado de directorios (Index of /loom), los archivos no están en la ubicación correcta

4. **Si aparece listado de directorios:**
   - Ver sección de solución de problemas más abajo: "Aparece listado de directorios en lugar de la aplicación"

### Paso 2: Probar Registro

1. **Clic en "Registrarse"**
2. **Completar formulario:**
   ```
   Nombre de usuario: test_user
   Email: test@ejemplo.com
   Fecha de nacimiento: 2005-01-01 (o cualquier fecha que dé 13+ años)
   Contraseña: Test1234 (debe tener mayúscula, minúscula y número)
   Confirmar contraseña: Test1234
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
   Email: david@ejemplo.com
   Contraseña: Prueba123
   ```
4. **Clic en "Iniciar sesión"**
5. **Verificar:**
   - Debe iniciar sesión correctamente
   - Debe redirigir a la pantalla principal
   - Debe mostrar el menú de navegación

### Paso 4: Verificar Funcionalidades

✅ **Pantalla Principal:**
- Banner de bienvenida visible
- Menú de navegación con 6 opciones
- Información del perfil del usuario
- Botón "Cerrar sesión" funcional

✅ **Navegación:**
- Logo "Loom" redirige a pantalla principal
- Cerrar sesión funciona correctamente
- Redirección si intentas acceder sin estar autenticado

---

## 6. Solución de Problemas

### ❌ Error: "No se puede conectar a la base de datos"

**Causas posibles:**
1. MySQL no está corriendo
2. Credenciales incorrectas en `config.php`
3. Base de datos no existe

**Soluciones:**
```
1. Verificar que MySQL esté "Running" en XAMPP Control Panel
2. Verificar credenciales en config.php:
   - DB_USER debe ser 'root'
   - DB_PASS debe estar vacío '' (o tu contraseña si la configuraste)
3. Verificar que la BD 'loom_db' exista en phpMyAdmin
4. Si no existe, crear la BD manualmente e importar scripts
```

### ❌ Error 404 - Página no encontrada

**Causas posibles:**
1. Archivos en ubicación incorrecta
2. Apache no está corriendo
3. Ruta incorrecta en el navegador

**Soluciones:**
```
1. Verificar que Apache esté "Running" en XAMPP
2. Verificar que los archivos estén en: htdocs/loom/
3. Verificar la URL: http://localhost/loom/ (con barra final)
4. Verificar que index.php exista en htdocs/loom/
```

### ❌ Página en blanco

**Causas posibles:**
1. Error de PHP no visible
2. Error de sintaxis en código
3. Permisos incorrectos

**Soluciones:**
```
1. Activar mostrar errores en config.php:
   ini_set('display_errors', 1);
   error_reporting(E_ALL);

2. Revisar logs de Apache:
   Windows: C:\xampp\apache\logs\error.log
   Linux: /opt/lampp/logs/error_log

3. Verificar permisos de archivos (Linux/Mac):
   chmod 644 *.php
   chmod 755 carpetas/
```

### ❌ No se muestran estilos CSS

**Causas posibles:**
1. Rutas incorrectas en HTML
2. Caché del navegador
3. Archivos CSS no encontrados

**Soluciones:**
```
1. Limpiar caché del navegador: Ctrl + Shift + R (Windows) o Cmd + Shift + R (Mac)
2. Verificar que los archivos CSS existan en: htdocs/loom/css/
3. Abrir consola del navegador (F12) y revisar errores 404
4. Verificar que las rutas usen la función url() de PHP
```

### ❌ Puerto 80 ocupado

**Causas posibles:**
- Skype u otro programa usando el puerto 80
- IIS u otro servidor web corriendo

**Soluciones:**
```
Opción 1: Cambiar puerto de Apache
1. Abrir XAMPP Control Panel
2. Clic en "Config" junto a Apache
3. Seleccionar "httpd.conf"
4. Buscar: Listen 80
5. Cambiar a: Listen 8080
6. Guardar y reiniciar Apache
7. Acceder a: http://localhost:8080/loom/

Opción 2: Detener otros servicios
- Cerrar Skype
- Detener IIS (si está instalado)
```

### ❌ Error al importar SQL

**Causas posibles:**
1. Archivo SQL corrupto
2. Tamaño de archivo muy grande
3. Límite de tiempo excedido

**Soluciones:**
```
1. Verificar que los archivos SQL no estén corruptos
2. Aumentar límites en php.ini:
   upload_max_filesize = 50M
   post_max_size = 50M
   max_execution_time = 300

3. Importar desde línea de comandos (alternativa):
   mysql -u root -p loom_db < 01_crear_bd.sql
   mysql -u root -p loom_db < 02_datos_iniciales.sql
```

### ❌ Error: "Call to undefined function"

**Causas posibles:**
- Función no definida o archivo no incluido

**Soluciones:**
```
1. Verificar que config.php se incluya en todos los archivos
2. Verificar que todas las funciones estén en config.php
3. Verificar que el autoloader funcione correctamente
```

### ❌ Aparece listado de directorios en lugar de la aplicación

**Síntoma:**
- Al acceder a `http://localhost/loom/` aparece una página que dice "Index of /loom"
- Se muestran carpetas como `doc/`, `docs/`, `src/` en lugar de la aplicación

**Causa:**
Los archivos no están en la ubicación correcta. Probablemente se copió toda la carpeta del proyecto en lugar de solo el contenido de `src/www/`.

**Solución paso a paso:**

1. **Verificar estructura actual:**
   ```
   Abrir: C:\xampp\htdocs\loom\ (o tu ruta equivalente)
   ```
   - Si ves carpetas `doc/`, `docs/`, `src/` aquí, la estructura está incorrecta

2. **Mover archivos a la ubicación correcta:**
   
   **Opción A: Mover archivos manualmente (Recomendado):**
   ```
   1. Abrir el explorador de archivos
   2. Navegar a: C:\xampp\htdocs\loom\src\www\
   3. Seleccionar TODOS los archivos y carpetas:
      - index.php
      - config.php
      - assets/
      - css/
      - js/
      - modelos/
      - controladores/
      - vistas/
   4. Cortar (Ctrl+X)
   5. Navegar a: C:\xampp\htdocs\loom\
   6. Pegar (Ctrl+V)
   7. Eliminar carpetas vacías: src/, doc/, docs/ (si existen)
   ```
   
   **Opción B: Usar PowerShell (Avanzado):**
   ```powershell
   cd C:\xampp\htdocs\loom
   Move-Item -Path "src\www\*" -Destination "." -Force
   ```
   
   **Opción C: Si prefieres empezar de nuevo:**
   ```
   1. Eliminar todo el contenido de htdocs/loom/
   2. Volver a copiar SOLO el contenido de proyecto-loom/src/www/
   3. Pegar directamente en htdocs/loom/
   ```

3. **Verificar estructura correcta:**
   ```
   htdocs/loom/
   ├── index.php          ← Debe estar aquí directamente
   ├── config.php
   ├── assets/
   ├── css/
   ├── js/
   ├── modelos/
   ├── controladores/
   └── vistas/
   ```

4. **Verificar que los archivos estén en la ubicación correcta:**
   ```
   Abrir: C:\xampp\htdocs\loom\
   Debe contener directamente:
   - index.php
   - config.php
   - assets/
   - css/
   - js/
   - modelos/
   - controladores/
   - vistas/
   ```

5. **Verificar acceso:**
   - Ir a: `http://localhost/loom/`
   - Debe mostrar la pantalla de bienvenida de Loom
   - NO debe mostrar el listado de directorios

6. **Si aún aparece el listado:**
   - Limpiar caché del navegador (Ctrl + Shift + R)
   - Verificar que `index.php` exista en `C:\xampp\htdocs\loom\index.php`
   - Verificar que Apache esté corriendo en XAMPP Control Panel
   - Reiniciar Apache desde XAMPP Control Panel
   - Ver también: `doc/SOLUCION_RUTA.md` para solución rápida

---

## ✅ Checklist de Inicialización

Usa esta lista para verificar que todo esté correcto:

- [ ] XAMPP/WAMP/MAMP instalado y funcionando
- [ ] Apache iniciado y corriendo
- [ ] MySQL iniciado y corriendo
- [ ] Archivos del proyecto copiados correctamente (solo contenido de `src/www/` a `htdocs/loom/`)
- [ ] `index.php` está directamente en `htdocs/loom/` (no dentro de subcarpetas)
- [ ] Base de datos `loom_db` creada
- [ ] Script `01_crear_bd.sql` importado correctamente
- [ ] Script `02_datos_iniciales.sql` importado correctamente
- [ ] Tablas `usuarios` y `sesiones` existen
- [ ] Al menos 3 usuarios de prueba en la tabla usuarios
- [ ] Acceso a `http://localhost/loom/` funciona (NO muestra listado de directorios)
- [ ] Pantalla de bienvenida se muestra correctamente (con botones "Iniciar Sesión" y "Registrarse")
- [ ] Registro de nuevo usuario funciona
- [ ] Login con usuario de prueba funciona
- [ ] Pantalla principal se muestra después del login
- [ ] Cerrar sesión funciona correctamente

---

## 📞 Soporte Adicional

Si después de seguir todos los pasos aún tienes problemas:

1. **Revisar documentación:**
   - `README.MD` - Documentación general
   - `doc/Sprint_1.md` - Documentación del sprint
   - `doc/SOLUCION_RUTA.md` - Solución rápida para problemas de rutas
   - `herramientas/comandos_utiles.md` - Comandos útiles

2. **Revisar logs:**
   - Logs de Apache: `xampp/apache/logs/error.log`
   - Logs de PHP: `xampp/php/logs/php_error_log`
   - Logs de MySQL: `xampp/mysql/data/mysql_error.log`

3. **Verificar versión de PHP:**
   ```bash
   php -v
   ```
   Debe ser PHP 8.0 o superior

---

## 🎉 ¡Listo!

Si has completado todos los pasos y el checklist, tu proyecto Loom está listo para usar.

**Próximos pasos:**
- Explorar el código fuente
- Personalizar estilos si lo deseas
- Comenzar a trabajar en el Sprint 2

---

**Última actualización:** Noviembre 2025  
**Versión:** 1.0  
**Autor:** Lidia Artero Fernández

