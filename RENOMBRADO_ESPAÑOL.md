# Plan de Renombrado a Español

## Carpetas que se renombrarán:

### Carpetas principales (ya en español):
- ✅ `modelos/` → Ya está en español
- ✅ `controladores/` → Ya está en español  
- ✅ `vistas/` → Ya está en español

### Carpetas a renombrar:
- `assets/` → `recursos/`
- `css/` → `estilos/`
- `js/` → `scripts/`

### Subcarpetas dentro de recursos:
- `assets/img/` → `recursos/imagenes/`
- `assets/logo/` → `recursos/logo/` (mantener)
- `assets/fonts/` → `recursos/fuentes/`
- `assets/iconos/` → `recursos/iconos/`

## Archivos que se renombrarán:

### Dentro de recursos/iconos:
- `decorativos/` → Ya está en español
- `botones/` → Ya está en español

### Dentro de vistas:
- `auth/` → `autenticacion/`
- `home/` → `inicio/`
- `layout/` → `plantilla/`

## Referencias a actualizar:

1. `config.php` - Rutas de constantes
2. `header.php` - Enlaces a CSS y JS
3. Todos los archivos PHP que usen `url()` con rutas
4. Todos los archivos que incluyan otros archivos PHP

