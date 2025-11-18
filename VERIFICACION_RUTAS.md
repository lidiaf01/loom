# Verificación de Rutas - Proyecto Loom

## Problema Detectado

Los estilos y el logo no se están cargando porque las rutas pueden no ser correctas.

## Rutas Corregidas

### CSS
- ✅ `/loom/estilos/style.css`
- ✅ `/loom/estilos/auth.css`
- ✅ `/loom/estilos/iconos.css`

### Logo
- ✅ `/loom/recursos/logo/loom-logo.png`
- ✅ `/loom/recursos/logo/loom-icon.png`

### Fuentes
- ✅ `/loom/recursos/fuentes/Bukhari Script.ttf`
- ✅ `/loom/recursos/fuentes/HeadingNowTrial-*.ttf`

## Verificación

1. **Verifica que los archivos estén en htdocs:**
   ```
   C:\xampp\htdocs\loom\
   ├── estilos/
   │   ├── style.css
   │   ├── auth.css
   │   └── iconos.css
   ├── recursos/
   │   ├── logo/
   │   │   ├── loom-logo.png
   │   │   └── loom-icon.png
   │   └── fuentes/
   │       └── ...
   ```

2. **Prueba las rutas en el navegador:**
   - `http://localhost/loom/estilos/style.css`
   - `http://localhost/loom/recursos/logo/loom-logo.png`

3. **Si no funcionan:**
   - Verifica que los archivos estén copiados en `C:\xampp\htdocs\loom\`
   - Limpia la caché del navegador (Ctrl+F5)
   - Revisa la consola del navegador (F12) para ver errores 404

## Nota

Si el proyecto está en `src/www/` y no en `htdocs/loom/` directamente, necesitas copiar los archivos o ajustar las rutas según tu configuración.

