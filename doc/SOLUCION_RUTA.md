# 🔧 Solución Rápida: Corregir Ruta de Acceso

## Problema Actual

- Al acceder a `http://localhost/loom/` aparece listado de directorios
- Los archivos están en `htdocs/loom/src/www/` en lugar de `htdocs/loom/`

## Solución: Mover Archivos a la Ubicación Correcta

### Opción 1: Mover Archivos Manualmente (Recomendado)

1. **Abrir el explorador de archivos de Windows**
   - Presionar `Win + E`

2. **Navegar a:**
   ```
   C:\xampp\htdocs\loom\src\www\
   ```

3. **Seleccionar TODOS los archivos y carpetas:**
   - `index.php`
   - `config.php`
   - `assets/`
   - `css/`
   - `js/`
   - `modelos/`
   - `controladores/`
   - `vistas/`

4. **Cortar los archivos:**
   - Presionar `Ctrl + X` (o clic derecho > Cortar)

5. **Navegar a:**
   ```
   C:\xampp\htdocs\loom\
   ```

6. **Pegar los archivos:**
   - Presionar `Ctrl + V` (o clic derecho > Pegar)

7. **Eliminar carpetas vacías (opcional):**
   - Eliminar `src/` (si está vacía)
   - Eliminar `doc/` y `docs/` (si no las necesitas en htdocs)

8. **Verificar estructura final:**
   ```
   C:\xampp\htdocs\loom\
   ├── index.php          ← Debe estar aquí
   ├── config.php
   ├── assets/
   ├── css/
   ├── js/
   ├── modelos/
   ├── controladores/
   └── vistas/
   ```

9. **Acceder a la aplicación:**
   ```
   http://localhost/loom/
   ```

### Opción 2: Usar Script Automático (Más Fácil)

1. **Abrir PowerShell:**
   - Presionar `Win + X`
   - Seleccionar "Windows PowerShell" o "Terminal"
   - O buscar "PowerShell" en el menú de inicio

2. **Navegar a la carpeta del proyecto:**
   ```powershell
   cd C:\Users\lidia\Documents\loom
   ```

3. **Ejecutar el script:**
   ```powershell
   .\mover_archivos.ps1
   ```

4. **Seguir las instrucciones en pantalla:**
   - El script te mostrará qué archivos se moverán
   - Confirmar con "S" para proceder
   - El script moverá automáticamente todos los archivos

**Ventajas del script:**
- ✅ Verifica que todo esté en orden antes de mover
- ✅ Muestra qué archivos se moverán
- ✅ Pregunta antes de sobrescribir archivos existentes
- ✅ Verifica que el proceso fue exitoso
- ✅ Opción para eliminar carpetas vacías

### Opción 3: Usar PowerShell Manualmente (Avanzado)

Abre PowerShell como administrador y ejecuta:

```powershell
# Navegar a la carpeta
cd C:\xampp\htdocs\loom

# Mover archivos de src/www/ a la raíz
Move-Item -Path "src\www\*" -Destination "." -Force

# Verificar que index.php esté en la raíz
Test-Path "index.php"
```

### Opción 4: Ruta Temporal (Solo para pruebas)

Si no quieres mover los archivos ahora, puedes acceder temporalmente a:

```
http://localhost/loom/src/www/
```

**⚠️ Nota:** Esta no es la estructura recomendada, pero funcionará para pruebas rápidas.

## Verificación

Después de mover los archivos:

1. ✅ `index.php` debe estar en `C:\xampp\htdocs\loom\index.php`
2. ✅ `http://localhost/loom/` debe mostrar la pantalla de bienvenida
3. ✅ NO debe aparecer el listado de directorios

## Si Aún No Funciona

1. **Limpiar caché del navegador:**
   - Presionar `Ctrl + Shift + R`

2. **Reiniciar Apache:**
   - Abrir XAMPP Control Panel
   - Detener Apache
   - Iniciar Apache nuevamente

3. **Verificar permisos:**
   - Los archivos deben tener permisos de lectura

---

**Última actualización:** Noviembre 2025

