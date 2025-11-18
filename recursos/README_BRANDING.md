# 📦 Recursos de Branding - Proyecto Loom

## 📍 Ubicación de Archivos

Todos los recursos de branding deben colocarse en esta estructura:

```
src/www/assets/
├── logo/
│   ├── loom-logo.png          ← Logo principal (horizontal)
│   ├── loom-logo-vertical.png  ← Logo vertical (opcional)
│   └── loom-icon.png           ← Icono/favicon (opcional)
│
└── fonts/
    ├── [nombre-fuente]-Regular.woff2
    ├── [nombre-fuente]-Bold.woff2
    └── [nombre-fuente]-Italic.woff2 (si aplica)
```

---

## 🎨 Archivos Necesarios

### 1. Logo de Loom

**Archivo requerido:**
- `logo/loom-logo.png`
  - Formato: PNG con transparencia (preferible)
  - Tamaño recomendado: Mínimo 400px de ancho
  - Versión: Logo horizontal (para header)
  - Fondo: Transparente o según diseño

**Archivos opcionales:**
- `logo/loom-logo-vertical.png` - Logo vertical (si existe)
- `logo/loom-icon.png` - Icono pequeño para favicon (32x32 o 64x64px)

**Dónde se usará:**
- Header de la aplicación (reemplazará el texto "Loom")
- Pantalla de login/registro
- Favicon del navegador

---

### 2. Tipografías (Fuentes)

**Archivos necesarios:**

Basándome en la guía de branding, necesito los siguientes archivos de fuente:

**Formato requerido:**
- `.woff2` (preferible - mejor compresión)
- `.woff` (alternativa)
- `.ttf` (si no hay woff2/woff)

**Estructura de nombres sugerida:**
```
fonts/
├── [NombreFuente]-Regular.woff2
├── [NombreFuente]-Medium.woff2
├── [NombreFuente]-SemiBold.woff2
└── [NombreFuente]-Bold.woff2
```

**Ejemplo si la fuente es "Inter":**
```
fonts/
├── Inter-Regular.woff2
├── Inter-Medium.woff2
├── Inter-SemiBold.woff2
└── Inter-Bold.woff2
```

**Información que necesito:**
1. Nombre de la fuente (ej: "Inter", "Poppins", "Montserrat", etc.)
2. Pesos disponibles (Regular 400, Medium 500, SemiBold 600, Bold 700)
3. Si tiene variantes (Italic, etc.)

---

### 3. Colores de la Paleta

**Información necesaria de la guía de branding:**

Necesito los códigos hexadecimales exactos de:

1. **Color Primario:** `#??????`
2. **Color Secundario:** `#??????`
3. **Color Acento:** `#??????`
4. **Color de Texto Principal:** `#??????`
5. **Color de Texto Secundario:** `#??????`
6. **Color de Fondo:** `#??????`
7. **Color de Fondo Claro:** `#??????`
8. **Colores de Estado:**
   - Éxito: `#??????`
   - Error: `#??????`
   - Advertencia: `#??????`
   - Info: `#??????`

**Formato:** Puedes proporcionarlos como:
- Códigos hexadecimales: `#FF5733`
- O una captura de la paleta de colores de la guía

---

## 📋 Checklist de Archivos

Marca cuando hayas colocado cada archivo:

### Logo
- [ ] `assets/logo/loom-logo.png` - Logo principal
- [ ] `assets/logo/loom-icon.png` - Icono/favicon (opcional)

### Fuentes
- [ ] `assets/fonts/[NombreFuente]-Regular.woff2`
- [ ] `assets/fonts/[NombreFuente]-Medium.woff2` (si existe)
- [ ] `assets/fonts/[NombreFuente]-SemiBold.woff2` (si existe)
- [ ] `assets/fonts/[NombreFuente]-Bold.woff2`

### Información
- [ ] Nombre exacto de la fuente proporcionado
- [ ] Códigos de colores proporcionados

---

## 🚀 Después de Colocar los Archivos

Una vez que hayas colocado todos los archivos, avísame y:

1. ✅ Actualizaré los CSS con los colores exactos
2. ✅ Configuraré las fuentes con @font-face
3. ✅ Integraré el logo en todas las vistas
4. ✅ Ajustaré los estilos según la guía de branding

---

## 📝 Notas

- **Logo:** Si el logo tiene diferentes versiones (claro/oscuro), puedes nombrarlas como `loom-logo-light.png` y `loom-logo-dark.png`
- **Fuentes:** Si solo tienes archivos .ttf, los convertiré a .woff2 automáticamente
- **Colores:** Si prefieres, puedes hacer una captura de la paleta de colores de la guía y la analizo

---

**Última actualización:** Noviembre 2025

