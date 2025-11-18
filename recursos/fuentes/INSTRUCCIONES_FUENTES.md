# Instrucciones para Fuentes - Proyecto Loom

## Fuentes Necesarias

### 1. Bukhari Script (Para Títulos)

**Archivo requerido:**
- `BukhariScript-Regular.woff2` (o .woff, .ttf)

**Ubicación:** `src/www/assets/fonts/`

**Uso:** Se aplicará a todos los títulos (h1, h2, h3, h4, h5, h6)

---

### 2. Heading Now (Para Textos)

**Archivos requeridos:**
Los números 64-68 corresponden a diferentes grosores:

- `HeadingNow-64.woff2` → Peso 400 (Regular)
- `HeadingNow-65.woff2` → Peso 500 (Medium)
- `HeadingNow-66.woff2` → Peso 600 (SemiBold)
- `HeadingNow-67.woff2` → Peso 700 (Bold)
- `HeadingNow-68.woff2` → Peso 800 (ExtraBold)

**Ubicación:** `src/www/assets/fonts/`

**Uso:** Se aplicará a todo el texto del cuerpo (párrafos, botones, formularios, etc.)

---

## Formato de Archivos

**Preferible:** `.woff2` (mejor compresión y rendimiento)
**Alternativa:** `.woff` o `.ttf`

Si solo tienes archivos `.ttf`, puedo ayudarte a convertirlos a `.woff2`.

---

## Estructura Final Esperada

```
fonts/
├── BukhariScript-Regular.woff2
├── HeadingNow-64.woff2
├── HeadingNow-65.woff2
├── HeadingNow-66.woff2
├── HeadingNow-67.woff2
└── HeadingNow-68.woff2
```

---

## Notas

- Los archivos ya están configurados en `style.css` con `@font-face`
- Solo necesitas colocar los archivos en la carpeta `fonts/`
- Si los nombres de archivo son diferentes, avísame y los ajusto

