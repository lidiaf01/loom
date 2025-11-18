# 📝 Instrucciones para Renombrar Carpetas a Español

## ⚠️ IMPORTANTE

Algunas carpetas necesitan renombrarse manualmente. Sigue estos pasos:

## Carpetas a Renombrar

### 1. Carpetas Principales (en `src/www/`)

**Renombrar:**
- `assets/` → `recursos/`
- `css/` → `estilos/`
- `js/` → `scripts/`

**Cómo hacerlo:**
1. Abre el explorador de archivos
2. Navega a: `C:\Users\lidia\Documents\loom\src\www\`
3. Renombra cada carpeta:
   - Clic derecho en `assets` → Renombrar → `recursos`
   - Clic derecho en `css` → Renombrar → `estilos`
   - Clic derecho en `js` → Renombrar → `scripts`

### 2. Subcarpetas de Recursos (en `src/www/recursos/`)

**Renombrar:**
- `img/` → `imagenes/`
- `fonts/` → `fuentes/`

**Cómo hacerlo:**
1. Navega a: `C:\Users\lidia\Documents\loom\src\www\recursos\`
2. Renombra:
   - `img` → `imagenes`
   - `fonts` → `fuentes`

### 3. Carpetas de Vistas (en `src/www/vistas/`)

**Ya renombradas:**
- ✅ `auth/` → `autenticacion/` (ya hecho)

**Pendientes:**
- `home/` → `inicio/`
- `layout/` → `plantilla/`

**Cómo hacerlo:**
1. Navega a: `C:\Users\lidia\Documents\loom\src\www\vistas\`
2. Renombra:
   - `home` → `inicio`
   - `layout` → `plantilla`

## Estructura Final Esperada

```
src/www/
├── recursos/          (antes assets)
│   ├── imagenes/     (antes img)
│   ├── fuentes/      (antes fonts)
│   ├── logo/
│   └── iconos/
│       ├── decorativos/
│       └── botones/
├── estilos/          (antes css)
├── scripts/          (antes js)
└── vistas/
    ├── autenticacion/ (antes auth) ✅
    ├── inicio/        (antes home) ⏳
    └── plantilla/     (antes layout) ⏳
```

## Después de Renombrar

Una vez renombradas todas las carpetas, avísame y:
1. ✅ Actualizaré todas las referencias en el código
2. ✅ Verificaré que todo funcione correctamente

---

**Nota:** Si alguna carpeta no se puede renombrar porque está en uso, cierra todos los archivos abiertos y vuelve a intentar.

