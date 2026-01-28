
# Manual del Programador

## 1. Introducción
Este manual está dirigido a desarrolladores que deseen contribuir, mantener o extender el proyecto Loom (Laravel). Aquí se describen la estructura, convenciones, buenas prácticas, ejemplos y procesos de desarrollo.

## 2. Estructura del Proyecto
- **app/**: Lógica principal (modelos, controladores, middleware, políticas, servicios).
- **routes/**: Definición de rutas (`web.php`, `api.php`, etc.).
- **database/**: Migraciones, seeders y factories.
- **resources/**: Vistas Blade, assets (CSS, JS).
- **public/**: Archivos públicos y punto de entrada (`index.php`).
- **config/**: Archivos de configuración.
- **tests/**: Pruebas unitarias y funcionales.

## 3. Convenciones de Código
- Seguir PSR-12 y las guías de estilo de Laravel.
- Usar nombres descriptivos y en inglés para variables, métodos y clases.
- Documentar funciones y clases con PHPDoc.
- Mantener la lógica de negocio en modelos y servicios, no en controladores.
- Ejemplo de función documentada:

```php
/**
 * Obtiene todas las publicaciones activas.
 * @return \Illuminate\Database\Eloquent\Collection
 */
public function getActivePosts() {
    return Post::where('active', true)->get();
}
```

## 4. Control de Versiones (Git)
- Cada funcionalidad o bugfix en una rama propia (`feature/nombre`, `fix/nombre`).
- Hacer *pull request* para integrar cambios a la rama principal (`main` o `master`).
- Mensajes de commit claros y descriptivos:

```bash
git commit -m "fix: corrige validación de email en registro"
```

## 5. Migraciones y Seeders
- Toda modificación de la base de datos debe realizarse mediante migraciones:

```bash
php artisan make:migration create_tabla_ejemplo
php artisan migrate
```
- Usar seeders para poblar datos de prueba:

```bash
php artisan db:seed --class=UserSeeder
```

## 6. Pruebas
- Escribir pruebas para nuevas funcionalidades en `tests/Feature` o `tests/Unit`.
- Ejecutar pruebas antes de hacer *merge*:

```bash
php artisan test
```
- Ejemplo de prueba:

```php
public function test_usuario_puede_registrarse() {
    $response = $this->post('/register', [
        'name' => 'Test',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);
    $response->assertStatus(302);
}
```

## 7. Buenas Prácticas
- Validar siempre los datos recibidos en los controladores:

```php
$request->validate([
    'email' => 'required|email',
    'password' => 'required|min:8',
]);
```
- Usar políticas para autorización (`app/Policies`).
- Mantener el código DRY (Don't Repeat Yourself).
- Documentar endpoints y lógica compleja.
- Usar servicios para lógica reutilizable.

## 8. Despliegue
- Ver el manual de despliegue en `docs/manual_despliegue.md`.

