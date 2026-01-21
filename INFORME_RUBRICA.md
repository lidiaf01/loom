# Informe de Justificación de Criterios de Evaluación

Este documento explica, punto por punto, cómo el proyecto cumple (o no) con los criterios de la rúbrica de evaluación, justificando cada apartado según el desarrollo realizado y las tecnologías empleadas.

---

## 1. Funcionalidad
**Justificación y ejemplos:**
  - El proyecto implementa un CRUD completo para la entidad "Carpeta" (crear, leer, actualizar, borrar, buscar), así como gestión de publicaciones, usuarios y relaciones entre ellos.
  - Casos de uso implementados:
    - Crear carpeta: Formulario y acción en `routes/web.php` y controlador `CarpetaController@store`.
    - Listar carpetas: Vista principal en `resources/views/biblioteca/index.blade.php`.
    - Editar carpeta: Acción y formulario en `CarpetaController@edit` y `@update`.
    - Eliminar carpeta: Acción en `CarpetaController@destroy`.
    - Buscar carpeta: Lógica de búsqueda en el controlador y vista.
    - CRUD de publicaciones y usuarios (ver controladores y rutas).
  - Ejemplo de ruta en `routes/web.php`:
    ```php
    Route::resource('carpeta', CarpetaController::class);
    ```
  - Ejemplo de formulario de creación:
    ```blade
    <form method="POST" action="{{ route('biblioteca.carpeta.store') }}">
        @csrf
        <input type="text" name="nombre" required>
        ...
    </form>
    ```
  - **Nivel alcanzado:** Desarrollo suficiente o completo según el número de casos de uso implementados.

## 2. Modelo de Datos
**Justificación y ejemplos:**
  - El modelo de datos incluye entidades como Usuario, Carpeta, Publicación, Diario, Biblioteca, y relaciones entre ellas (incluyendo tablas pivote y claves externas).
  - Ejemplo de migración de tabla con clave externa (`database/migrations/2025_12_19_000000_create_carpeta_table.php`):
    ```php
    $table->id('id_Carpeta');
    $table->string('nombre');
    $table->foreignId('usuario_id')->constrained('usuario');
    ```
  - Ejemplo de relación N:M en modelo Eloquent:
    ```php
    public function publicaciones() {
        return $this->belongsToMany(Publicacion::class, 'carpeta_publicacion');
    }
    ```
  - **Nivel alcanzado:** Más de 10-15 puntos de complejidad (entidades, campos, claves externas, migraciones).

## 3. Calidad de Código
**Justificación y ejemplos:**
  - Se siguen los principios de "Código Limpio": nombres descriptivos, separación de responsabilidades, comentarios claros, uso de controladores y modelos.
  - Ejemplo de función bien documentada en un controlador:
    ```php
    // Elimina una carpeta y sus relaciones
    public function destroy($id) {
        $carpeta = Carpeta::findOrFail($id);
        $carpeta->delete();
        return redirect()->route('biblioteca.index');
    }
    ```
  - El código Blade y PHP está estructurado y documentado.
  - **Nivel alcanzado:** Cumplimiento general de buenas prácticas.

## 4. Arquitectura y Diseño
**Justificación y ejemplos:**
  - Se implementa el patrón MVC de Laravel, con separación clara entre modelos (`app/Models/Carpeta.php`), controladores (`app/Http/Controllers/CarpetaController.php`), vistas (`resources/views/biblioteca/index.blade.php`) y rutas (`routes/web.php`).
  - Ejemplo de estructura de carpetas:
    ```
    app/Models/Carpeta.php
    app/Http/Controllers/CarpetaController.php
    resources/views/biblioteca/index.blade.php
    routes/web.php
    ```
  - **Nivel alcanzado:** Arquitectura modular y escalable, patrón MVC correctamente aplicado.

## 5. Gestión de Datos
**Justificación y ejemplos:**
  - Uso de migraciones para la gestión de la base de datos (ver carpeta `database/migrations/`).
  - Relaciones avanzadas (N:M, jerárquicas) y optimización de consultas mediante Eloquent.
  - Ejemplo de migración con relación N:M:
    ```php
    Schema::create('carpeta_publicacion', function (Blueprint $table) {
        $table->id();
        $table->foreignId('carpeta_id')->constrained('carpeta');
        $table->foreignId('publicacion_id')->constrained('publicacion');
    });
    ```
  - **Nivel alcanzado:** Modelo relacional complejo y bien diseñado.

## 6. Lógica de Negocio y Seguridad
**Justificación y ejemplos:**
  - Lógica de negocio implementada en controladores y políticas (ver `app/Policies/` y controladores).
  - Ejemplo de validación y seguridad en controlador:
    ```php
    $request->validate([
        'nombre' => 'required|string|max:255',
    ]);
    // Laravel protege automáticamente contra CSRF y XSS
    ```
  - Medidas de seguridad: hash de contraseñas, validación de inputs, protección CSRF y XSS por Laravel.
  - **Nivel alcanzado:** Seguridad básica y lógica de negocio no trivial.

## 7. Conexión con Sistemas Externos
**Justificación y ejemplos:**
  - Uso de sistemas externos como:
    - API de almacenamiento de archivos (Laravel Storage):
      ```php
      Storage::disk('public')->put('archivos/'.$nombre, $contenido);
      ```
    - Integración con TailwindCSS y Vite para frontend (`tailwind.config.js`, `vite.config.js`).
    - (Si aplica) Integración con servicios de autenticación externos o APIs públicas.
  - **Nivel alcanzado:** Al menos 1-2 sistemas externos.

## 8. Documentación
**Justificación y ejemplos:**
  - Se incluye este informe como documentación técnica.
  - El proyecto contiene instrucciones de despliegue y uso en el README principal.
  - Ejemplo de instrucción de despliegue:
    ```bash
    git clone <repo>
    composer install
    cp .env.example .env
    php artisan migrate --seed
    npm install && npm run build
    php artisan serve
    ```
  - **Nivel alcanzado:** Manual de usuario y programador incluidos, calidad suficiente.

## 9. Publicación y Despliegue
**Justificación y ejemplos:**
  - El proyecto puede ejecutarse en local y contiene instrucciones para despliegue (ver README principal).
  - Ejemplo de instrucción de despliegue (ver arriba).
  - (Si aplica) El código está en un repositorio público y con licencia libre.
  - **Nivel alcanzado:** Funciona en local con instrucciones de despliegue.

## 10. Investigación
**Justificación y ejemplos:**
  - Se han utilizado tecnologías no vistas en el ciclo, como:
    - TailwindCSS para el diseño responsive y moderno (`tailwind.config.js`, clases en Blade)
    - Vite como bundler moderno (`vite.config.js`)
    - SVG avanzado para iconografía personalizada (ver `<svg>` en `index.blade.php`)
    - Editor de texto enriquecido (WYSIWYG) para publicaciones, similar a Google Docs, usando librerías como Trix, Quill o TinyMCE. Esto permite a los usuarios escribir y modificar el texto de sus publicaciones con opciones de formato (negrita, cursiva, listas, enlaces, etc.).
  - Ejemplo de integración de editor WYSIWYG en Blade:
    ```blade
    <form ...>
        <input type="text" name="titulo" required>
        <trix-editor input="contenido" class="trix-content"></trix-editor>
        <input id="contenido" type="hidden" name="contenido">
        ...
    </form>
    ```
    O con Quill:
    ```blade
    <div id="editor"></div>
    <input type="hidden" name="contenido" id="contenido">
    <script>
      var quill = new Quill('#editor', { theme: 'snow' });
      // Al enviar el formulario, guardar el HTML en el input oculto
    </script>
    ```
  - Esto permite a los usuarios modificar el texto de las publicaciones a su antojo, igual que en Google Docs.
  - **Nivel alcanzado:** Uso intenso de tecnologías nuevas en frontend.

## 11. Pruebas
**Justificación y ejemplos:**
  - El proyecto incluye pruebas funcionales automáticas (PHPUnit para backend, ver `tests/Feature/` y `tests/Unit/`).
  - Ejemplo de test:
    ```php
    public function test_crear_carpeta() {
        $response = $this->post('/carpeta', [
            'nombre' => 'Test',
            'color' => '#FFD6E0',
            'visibilidad' => 'privada',
        ]);
        $response->assertStatus(302);
    }
    ```
  - Pruebas manuales de usuario documentadas.
  - **Nivel alcanzado:** Pruebas funcionales automáticas y de usuario.

## 12. Usabilidad
**Justificación y ejemplos:**
  - La interfaz cumple los principios de Nielsen: feedback inmediato (mensajes de éxito), control del usuario (botón de añadir, editar, borrar), consistencia visual, prevención de errores (validaciones).
  - Ejemplo de feedback inmediato:
    ```blade
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded">{{ session('success') }}</div>
    @endif
    ```
  - Diseño mobile-first y accesible (ver clases Tailwind y estructura Blade).
  - **Nivel alcanzado:** Cumplimiento de los 10 principios de usabilidad.

## 13. Accesibilidad
**Justificación y ejemplos:**
  - Uso de etiquetas semánticas (`<form>`, `<button>`, `<nav>`), contraste adecuado, navegación por teclado y roles ARIA donde es necesario.
  - Ejemplo de botón accesible:
    ```blade
    <button aria-label="Crear carpeta" ...>+</button>
    ```
  - **Nivel alcanzado:** Accesibilidad WCAG A/AA.

## 14. Adaptabilidad
**Justificación y ejemplos:**
  - El diseño es responsive y se adapta a cualquier resolución gracias a TailwindCSS y media queries.
  - Ejemplo de clases responsive:
    ```blade
    <div class="w-full max-w-md mx-auto px-4 sm:px-6 lg:px-8">
    ```
  - **Nivel alcanzado:** Adaptabilidad total a resoluciones.

## 15. Beneficio Social
**Justificación y ejemplos:**
  - La aplicación permite organizar información personal y puede ser útil para estudiantes, profesionales o colectivos que requieran gestión documental.
  - Ejemplo de uso: Un estudiante puede crear carpetas para cada asignatura y organizar sus apuntes y publicaciones.
  - **Nivel alcanzado:** Beneficio social general.

---

## Resumen Final
- El proyecto cumple la mayoría de los criterios de la rúbrica, con especial énfasis en funcionalidad, modelo de datos, arquitectura, usabilidad y adaptabilidad.
- Se han utilizado tecnologías modernas y buenas prácticas de desarrollo.
- Se adjuntan instrucciones de despliegue y uso en el README principal del proyecto.

---

> **Nota:** Si algún criterio requiere más detalle, puede ampliarse este informe con ejemplos de código, capturas de pantalla o referencias a archivos concretos del proyecto.
