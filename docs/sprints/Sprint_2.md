# Sprint 2 - Planificación y Historias de Usuario


## Contexto del Sprint Anterior

**Sprint 1 completado:**
- HU-01: Registro y Autenticación 
- HU-02: Inicio de Sesión (3 SP) 
- HU-03: Pantalla Principal (5 SP) 

---

## Objetivo del Sprint

Completar las funcionalidades de personalización de perfil y diario personal, permitiendo a los usuarios personalizar su información y gestionar sus entradas de diario privadas.

---

## Historias de Usuario del Sprint

### HU-2: Personalización de Perfil (Prioridad: Media)
- **Como:** usuario autenticado
- **Quiero:** personalizar mi perfil con foto, biografía y datos personales
- **Para:** que otros usuarios puedan conocerme mejor y expresar mi identidad en la plataforma

**Criterios de aceptación:**
- [ ] Página de perfil accesible desde el dashboard
- [ ] Formulario de edición de perfil con los siguientes campos:
  - Nombre de usuario (editable, con validación de unicidad)
  - Email (editable, con validación de formato y unicidad)
  - Biografía (textarea, máximo 500 caracteres)
  - Foto de perfil (subida de imagen, máximo 5MB, formatos: JPG, PNG, WebP)
  - Fecha de nacimiento (editable, con validación de edad mínima)
- [ ] Vista previa de la foto antes de guardar
- [ ] Validación en frontend y backend
- [ ] Mensajes de éxito/error claros
- [ ] Redimensionamiento automático de imágenes (máx. 500x500px)
- [ ] Actualización de datos en base de datos
- [ ] Actualización de sesión con nuevos datos
- [ ] Protección CSRF en formularios

**Story Points:** 8  
**Tareas técnicas:**
- Extender modelo `Usuario.php` con métodos de actualización
- Crear controlador `PerfilController.php`
- Crear vista `perfil.php` (ver perfil propio)
- Crear vista `editar_perfil.php` (formulario de edición)
- Implementar subida de archivos con validación
- Crear carpeta `src/www/uploads/perfiles/` con permisos adecuados
- Añadir rutas en `index.php` (perfil, editar_perfil)
- Crear estilos CSS para perfil
- JavaScript para validación y preview de imagen
- Sistema de redimensionamiento de imágenes (máx. 500x500px)
- Actualizar base de datos si es necesario (verificar campos existentes)

**Estimación:** 3 días

---

### HU-4: Diario Personal (Prioridad: Media)
- **Como:** usuario autenticado
- **Quiero:** escribir y gestionar entradas en mi diario personal
- **Para:** registrar mis pensamientos, ideas y reflexiones de forma privada

**Criterios de aceptación:**
- [ ] Página de diario accesible desde el dashboard
- [ ] Lista de entradas del diario ordenadas por fecha (más recientes primero)
- [ ] Formulario para crear nueva entrada con:
  - Título (opcional, máximo 100 caracteres)
  - Contenido (requerido, textarea)
  - Fecha (automática, pero editable)
  - Estado de ánimo (opcional, selector: feliz, triste, neutral, ansioso, etc.)
- [ ] Visualización de entrada individual con fecha y hora
- [ ] Edición de entradas existentes
- [ ] Eliminación de entradas (con confirmación)
- [ ] Búsqueda/filtrado por fecha o palabra clave
- [ ] Paginación si hay muchas entradas (10 por página)
- [ ] Validación de datos en frontend y backend
- [ ] Las entradas son privadas (solo visibles para el usuario propietario)
- [ ] Diseño responsive y accesible

**Story Points:** 8  
**Tareas técnicas:**
- Crear tabla `diario` en base de datos
- Crear modelo `Diario.php`
- Crear controlador `DiarioController.php`
- Crear vistas: `diario.php` (lista), `diario_entrada.php` (ver/editar)
- Crear estilos CSS para diario
- JavaScript para validación, búsqueda y paginación
- Añadir rutas en `index.php`
- Implementar paginación en PHP
- Sistema de búsqueda básico


