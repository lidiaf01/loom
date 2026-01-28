
# Manual de Usuario

## 1. Introducción
Este manual está dirigido a los usuarios finales del sistema Loom. Aquí aprenderás a registrarte, iniciar sesión, gestionar publicaciones, carpetas, diario personal y tu perfil.

## 2. Registro e Inicio de Sesión
- Accede a la página principal y haz clic en "Registrarse".
- Completa el formulario y confirma tu correo si es necesario.
- Para iniciar sesión, usa tu correo y contraseña en la página de login.

## 3. Gestión de Publicaciones
- Desde el panel principal, haz clic en "Nueva Publicación".
- Completa los campos requeridos y guarda.
- Puedes editar o eliminar tus publicaciones desde la lista de publicaciones.

## 4. Carpetas y Bibliotecas
- Organiza tus publicaciones creando carpetas o bibliotecas.
- Usa el menú de "Carpetas" para crear, editar o eliminar.
- Puedes acceder a la biblioteca de otros usuarios desde su perfil.

## 5. Diario Personal
- Accede a la sección "Diario" para crear entradas personales.
- Edita o elimina entradas según lo necesites.
- Si el diario es privado, solo tú podrás verlo.

## 6. Perfil de Usuario
- Haz clic en tu nombre o avatar para acceder a tu perfil.
- Modifica tus datos personales y guarda los cambios.
- Puedes eliminar tu cuenta desde la configuración de perfil.

## 7. Accesibilidad y Ayuda
- El sistema está diseñado para ser accesible y usable en dispositivos móviles y escritorio.
- Si tienes dudas, consulta la sección de ayuda o contacta al soporte.

## 8. Consejos de Seguridad
- No compartas tu contraseña.
- Cierra sesión en dispositivos públicos.

---

# Manual de Instalación

## 1. Requisitos
- Servidor con PHP >= 8.0, Composer, Nginx o Apache, y base de datos MySQL o PostgreSQL.
- Acceso SSH y permisos de administrador.

## 2. Pasos de Instalación

### a) Clonar el repositorio
```bash
git clone <REPO_URL> /var/www/loom
cd /var/www/loom
```

### b) Instalar dependencias
```bash
composer install --no-interaction --prefer-dist --optimize-autoloader
```

### c) Configurar entorno
```bash
cp .env.example .env
nano .env  # Edita los datos de la base de datos y otros parámetros
php artisan key:generate
```

### d) Permisos
```bash
chown -R www-data:www-data /var/www/loom
chmod -R 775 storage bootstrap/cache
```

### e) Migrar y poblar la base de datos
```bash
php artisan migrate --seed
```

### f) Configurar servidor web
- Ver el manual de despliegue para detalles de Nginx/Apache.

### g) Acceso
- Accede desde el navegador a la URL configurada.

---

Para dudas, consulta los manuales en la carpeta docs o contacta al soporte del proyecto.
