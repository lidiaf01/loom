# 🏁 Sprint 1 — Proyecto Loom

**Autor:** Lidia Artero Fernández  
**Curso:** 2025/26 – DAW  
**Sprint:** Nº 1  
**Duración:** Del 5 al 19 de noviembre de 2025  
**Versión:** 1.0  

---

## 🎯 Objetivo del Sprint

El objetivo principal de este primer sprint es **construir la estructura base de la aplicación Loom** y desarrollar las **pantallas principales** del sistema (registro, login, perfil, publicación y navegación por categorías), utilizando **HTML, CSS y JavaScript básico** sin necesidad de frameworks ni base de datos real.

> ✅ Al finalizar el sprint, se deberá tener un **prototipo navegable funcional**, con formularios y enlaces entre páginas operativos.

---

## 📋 Historias seleccionadas del Product Backlog

| ID | Historia de Usuario | Prioridad | Estado inicial |
|----|----------------------|------------|----------------|
| HU-1 | Registro y autenticación | Alta | Pendiente |
| HU-2 | Personalización de perfil | Media | Pendiente |
| HU-3 | Publicación de artículos o vídeos | Alta | Pendiente |
| HU-6 | Búsqueda y filtrado por categorías | Media | Pendiente |
| (Opcional) HU-5 | Guardar contenido en biblioteca | Media | Pendiente |

---

## 🧱 Sprint Backlog (Tareas del Sprint)

> Cada historia del Product Backlog se divide en **tareas pequeñas y concretas**, con su estado de avance y responsable.

| ID Historia | Tarea | Responsable | Tipo | Estado |
|--------------|--------|-------------|------|--------|
| HU-1 | Crear formulario HTML de registro | Lidia | Desarrollo | ⏳ Pendiente |
| HU-1 | Validar campos del formulario con JS (email, contraseña, edad) | Lidia | Desarrollo | ⏳ Pendiente |
| HU-1 | Crear formulario de inicio de sesión (login.html) | Lidia | Desarrollo | ⏳ Pendiente |
| HU-2 | Diseñar plantilla de perfil (foto, nombre, biografía) | Lidia | Diseño | ⏳ Pendiente |
| HU-2 | Implementar edición de perfil (botón “Guardar cambios”) | Lidia | Desarrollo | ⏳ Pendiente |
| HU-3 | Crear formulario de publicación (título, texto, imagen) | Lidia | Desarrollo | ⏳ Pendiente |
| HU-3 | Añadir vista previa antes de publicar | Lidia | Desarrollo | ⏳ Pendiente |
| HU-6 | Diseñar menú principal y página de categorías | Lidia | Diseño | ⏳ Pendiente |
| HU-6 | Simular filtrado de publicaciones por categoría (JS) | Lidia | Desarrollo | ⏳ Pendiente |
| (Opcional) HU-5 | Crear estructura de biblioteca con carpetas simuladas | Lidia | Desarrollo | ⏳ Pendiente |

📘 **Leyenda de estados:**  
`⏳ Pendiente` — aún no iniciado  
`🔄 En progreso` — se está trabajando  
`✅ Hecho` — completado

---

## 🖼 Bocetos y recursos visuales del Sprint

Guarda aquí las pantallas o bocetos usados para guiar el desarrollo.  
Se ubicarán en la carpeta `/bocetos/` del repositorio.

**Bocetos previstos:**
- `registro_login.png`  
- `perfil_usuario.png`  
- `publicar_articulo.png`  
- `categorias.png`

---

## 💻 Entregables técnicos esperados

Estructura base del proyecto (carpeta `/src`):
src/
├── index.html ← Página principal con menú y categorías
├── registro.html ← Formulario de registro
├── login.html ← Formulario de inicio de sesión
├── perfil.html ← Perfil editable
├── publicar.html ← Página para crear artículo
├── /assets/css/style.css
├── /assets/js/main.js
└── /assets/img/

**Criterios de finalización:**
- [ ] Todas las páginas HTML creadas y enlazadas correctamente.  
- [ ] Formularios funcionales con validaciones básicas (sin base de datos).  
- [ ] Menú de navegación entre páginas activo.  
- [ ] Código organizado y subido al repositorio.  
- [ ] Bocetos añadidos en `/bocetos/`.  

---

## 📈 Seguimiento y control

Durante el sprint se registrarán los avances mediante **commits** en Git.

**Ejemplos de commits recomendados:**
```
git commit -m "Añadido formulario de registro con validaciones básicas"
git commit -m "Creada página de perfil editable"
git commit -m "Estructurada navegación principal por categorías"
```


**Ramas sugeridas:**
- `main` → rama principal (versión estable)
- `sprint1-dev` → rama de trabajo del sprint

---

## 🔍 Revisión del Sprint (Sprint Review)

**Historias completadas:**
- [ ] HU-1 Registro y autenticación  
- [ ] HU-2 Personalización de perfil  
- [ ] HU-3 Publicación de artículos  
- [ ] HU-6 Búsqueda por categorías  
- [ ] HU-5 Biblioteca (si aplica)  

**Demo prevista:**  
Presentación del prototipo navegable y explicación de las pantallas creadas.

---

**Versión del documento:** 1.0  
**Fecha de creación:** 5 de noviembre de 2025  
**Responsable:** Lidia Artero Fernández  
