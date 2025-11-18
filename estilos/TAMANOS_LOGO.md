# Tamaños de Logo - Proyecto Loom

## 📐 Tamaños Ideales por Zona

### 1. Logo en Página Principal de Autenticación
**Clase:** `.logo-grande img`
- **Altura:** 120px
- **Ancho máximo:** 350px
- **Ubicación:** Página de login/registro principal
- **Uso:** Primera impresión, debe ser visible pero no dominante

### 2. Logo en Header (Navegación)
**Clase:** `.logo-img` o `.logo img`
- **Altura:** 50px
- **Ancho máximo:** 200px
- **Ubicación:** Header de todas las páginas
- **Uso:** Navegación, debe ser compacto

### 3. Logo en Favicon
**Archivo:** `loom-icon.png`
- **Tamaño recomendado:** 32x32px o 64x64px
- **Ubicación:** Pestaña del navegador

## 🎨 Modificar Tamaños

### Para cambiar el tamaño del logo en la página principal:
```css
.logo-grande img {
    height: 150px;  /* Aumentar o disminuir según necesites */
    max-width: 400px;
}
```

### Para cambiar el tamaño del logo en el header:
```css
.logo-img {
    height: 60px;  /* Aumentar o disminuir según necesites */
    max-width: 250px;
}
```

## 📝 Notas

- Los logos mantienen su proporción (aspect ratio) automáticamente
- `object-fit: contain` asegura que el logo no se deforme
- `max-width` evita que el logo sea demasiado ancho en pantallas grandes
- `height` controla el tamaño principal

---

**Última actualización:** Noviembre 2025

