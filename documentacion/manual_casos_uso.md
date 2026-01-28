# Manual de Casos de Uso

## 1. Introducción
Este documento describe los principales casos de uso implementados en el sistema, orientando a desarrolladores, testers y usuarios sobre el comportamiento esperado, con ejemplos y escenarios.

## 2. Casos de Uso Principales

### 2.1. Gestión de Usuarios
- **Registro**: Un usuario puede registrarse proporcionando nombre, email y contraseña. Ejemplo:
	- El usuario accede a /register, completa el formulario y recibe confirmación.
- **Login**: Un usuario registrado puede iniciar sesión con email y contraseña en /login.
- **Edición de Perfil**: El usuario puede modificar sus datos personales desde la sección de perfil.
- **Eliminación de Cuenta**: El usuario puede eliminar su cuenta desde la configuración.

### 2.2. Gestión de Publicaciones
- **Crear Publicación**: Un usuario autenticado puede crear una publicación desde el panel principal, añadiendo título, contenido y categoría.
- **Editar Publicación**: El autor puede modificar su publicación desde la vista de detalle.
- **Eliminar Publicación**: El autor puede eliminar su publicación desde la lista de publicaciones.
- **Ver Publicaciones**: Cualquier usuario puede ver publicaciones públicas navegando por la sección de publicaciones.

#### Ejemplo de flujo:
1. El usuario inicia sesión.
2. Hace clic en "Nueva Publicación", completa el formulario y guarda.
3. La publicación aparece en la lista y puede ser editada o eliminada.

### 2.3. Gestión de Carpetas y Bibliotecas
- **Crear Carpeta/Biblioteca**: Un usuario puede organizar publicaciones en carpetas o bibliotecas desde el menú correspondiente.
- **Editar/Eliminar Carpeta**: El usuario puede modificar o eliminar sus carpetas desde la vista de carpetas.

### 2.4. Diario Personal
- **Crear Entrada**: El usuario puede crear entradas en su diario personal desde la sección "Diario".
- **Editar/Eliminar Entrada**: El usuario puede modificar o eliminar sus entradas desde la lista de entradas.

#### Escenario de uso:
1. El usuario accede a "Diario".
2. Hace clic en "Nueva Entrada", escribe el contenido y guarda.
3. Puede editar o eliminar entradas existentes.

## 3. Consideraciones
- Todos los casos de uso requieren validación y autorización según las políticas definidas en `app/Policies`.
- Los errores y respuestas están estandarizados en formato JSON para la API.
- El sistema notifica al usuario en caso de éxito o error en cada acción.

## 4. Pruebas
- Cada caso de uso cuenta con pruebas en la carpeta `tests/Feature`.
- Ejemplo de prueba para registro:
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
