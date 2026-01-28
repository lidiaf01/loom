# Guía de Estilo del Proyecto

Esta guía describe el estilo visual y las directrices de diseño utilizadas en el proyecto Laravel "Loom" para asegurar una experiencia de usuario coherente, moderna y accesible.

---

## 1. Paleta de Colores

- **Principal:**
  - Azul Tailwind (`#3B82F6`)
  - Blanco (`#FFFFFF`)
  - Gris claro para fondos y bordes (`#F3F4F6`, `#E5E7EB`)
- **Secundarios:**
  - Verde éxito (`#10B981`)
  - Rojo error/alerta (`#EF4444`)
  - Amarillo advertencia (`#F59E42`)
- **Texto:**
  - Negro (`#111827`)
  - Gris oscuro (`#6B7280`)

## 2. Tipografía

- **Fuente principal:** Inter, sans-serif (por defecto en Tailwind CSS)
- **Tamaños:**
  - Títulos: `text-2xl` a `text-4xl`
  - Subtítulos: `text-xl`
  - Texto normal: `text-base`
  - Notas/ayudas: `text-sm` o `text-xs`
- **Peso:**
  - Títulos: `font-bold`
  - Texto normal: `font-normal`

## 3. Espaciado y Layout

- **Sistema de rejilla:** Utiliza utilidades de Tailwind para `grid` y `flex`.
- **Espaciado:**
  - Margen y padding con múltiplos de 2 (`p-2`, `m-4`, etc.)
  - Separación clara entre tarjetas, secciones y botones
- **Contenedores:**
  - Máximo ancho: `max-w-4xl` o `max-w-6xl` para vistas principales
  - Centrado horizontal con `mx-auto`

## 4. Componentes UI

- **Botones:**
  - Fondo azul principal, texto blanco, bordes redondeados (`rounded-lg`)
  - Hover: tono más oscuro (`hover:bg-blue-700`)
  - Deshabilitado: gris claro
- **Tarjetas/Publicaciones:**
  - Fondo blanco, sombra suave (`shadow-md`), bordes redondeados
  - Espaciado interno generoso (`p-4`)
- **Toasts/Alertas:**
  - Esquinas redondeadas, colores según tipo (verde, rojo, amarillo)
  - Animación de entrada/salida suave
- **Inputs y Formularios:**
  - Bordes redondeados, fondo gris claro
  - Enfoque: borde azul

## 5. Imágenes y Avatares

- **Foto de perfil:**
  - Por defecto: imagen genérica circular
  - Tamaño estándar: `w-12 h-12` o `w-16 h-16`
  - Bordes: `rounded-full`, borde azul si está activa
- **Publicaciones:**
  - Imágenes con `object-cover`, esquinas redondeadas

## 6. Accesibilidad

- Contraste suficiente entre texto y fondo
- Botones e inputs con estados de foco visibles
- Uso de `aria-label` y roles en elementos interactivos clave

## 7. Responsividad

- Diseño mobile-first
- Breakpoints de Tailwind (`sm`, `md`, `lg`, `xl`)
- Menús y tarjetas adaptables a pantallas pequeñas

## 8. Animaciones y Transiciones

- Transiciones suaves en hover y focus (`transition`, `duration-150`)
- Animaciones para toasts y modales (`ease-in-out`)

## 9. Iconografía

- Uso de iconos SVG inline o librerías compatibles con Tailwind
- Iconos claros y minimalistas, alineados verticalmente con el texto

## 10. Ejemplo de Componente (Botón)

```html
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
  Guardar
</button>
```

---

## 11. Referencias

- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Heroicons](https://heroicons.com/)

---

**Nota:** Sigue estas directrices para mantener la coherencia visual y la usabilidad en todo el proyecto. Ante dudas, consulta este documento antes de diseñar nuevos componentes o vistas.
