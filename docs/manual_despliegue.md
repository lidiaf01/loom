
# Manual de Despliegue: Laravel en AWS con DNS Dinámica

Este manual te guía paso a paso para desplegar este proyecto Laravel en una instancia EC2 de AWS, usando Nginx y una DNS dinámica (FreeDNS o DuckDNS). Todos los comandos están listos para copiar y pegar. Incluye advertencias, recomendaciones y ejemplos de errores comunes.

---

## 1. Requisitos Previos

- Cuenta en AWS (EC2)
- Acceso SSH a la instancia
- Ubuntu 22.04 LTS recomendado
- Cuenta en FreeDNS (https://freedns.afraid.org/) o DuckDNS (https://www.duckdns.org/)
- Base de datos MySQL o PostgreSQL (puede estar en la misma instancia o externa)

---

## 2. Crear y Configurar la Instancia EC2

1. Lanza una instancia EC2 con Ubuntu 22.04 LTS.
2. En el grupo de seguridad, abre los puertos 22 (SSH), 80 (HTTP) y 443 (HTTPS).
3. Conéctate por SSH:
   ```bash
   ssh -i "tu_clave.pem" ubuntu@<IP_PUBLICA>
   ```

---

## 3. Instalar Dependencias

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y git unzip curl nginx php php-cli php-fpm php-mbstring php-xml php-zip php-curl php-gd php-bcmath composer
```

> Si usas MySQL:
```bash
sudo apt install -y mysql-server php-mysql
```
> Si usas PostgreSQL:
```bash
sudo apt install -y postgresql php-pgsql
```

---

## 4. Clonar el Proyecto y Configurar Laravel

```bash
sudo mkdir -p /var/www
cd /var/www
sudo git clone <REPO_URL> loom
cd loom
sudo composer install --no-interaction --prefer-dist --optimize-autoloader
sudo cp .env.example .env
sudo php artisan key:generate
```

Configura la base de datos y otros parámetros en `.env` según tu entorno:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=loom
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

---

## 5. Permisos de Archivos

```bash
sudo chown -R www-data:www-data /var/www/loom
sudo chmod -R 775 /var/www/loom/storage /var/www/loom/bootstrap/cache
```

---

## 6. Configuración de Nginx

Edita o crea el archivo `/etc/nginx/sites-available/loom`:

```nginx
server {
  listen 80;
  server_name TU_DOMINIO_DINAMICO;
  root /var/www/loom/public;
  index index.php index.html;

  location / {
    try_files $uri $uri/ /index.php?$query_string;
  }

  location ~ \.php$ {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/var/run/php/php-fpm.sock;
  }

  location ~ /\.ht {
    deny all;
  }
}
```

Habilita el sitio y recarga Nginx:

```bash
sudo ln -s /etc/nginx/sites-available/loom /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```
---

## 7. Configuración de DNS Dinámica

### FreeDNS
1. Regístrate y crea un subdominio.
2. Obtén tu URL de actualización (formato: `https://freedns.afraid.org/dynamic/update.php?TU_TOKEN`).
3. Añade al crontab del usuario `ubuntu`:
   ```bash
   crontab -e
   # Añade la siguiente línea para actualizar cada 5 minutos:
   */5 * * * * curl -s "https://freedns.afraid.org/dynamic/update.php?TU_TOKEN"
   ```

### DuckDNS
1. Regístrate y crea un subdominio.
2. Añade al crontab del usuario `ubuntu`:
   ```bash
   crontab -e
   # Añade la siguiente línea (reemplaza TU_DOMINIO y TU_TOKEN):
   */5 * * * * curl -s "https://www.duckdns.org/update?domains=TU_DOMINIO&token=TU_TOKEN&ip="
   ```

---

## 8. Configuración de la Base de Datos

Edita `.env` y configura los datos de conexión a la base de datos.

Ejecuta migraciones y seeders:

```bash
cd /var/www/loom
php artisan migrate --seed
```
---

## 9. Comprobar el Despliegue

Accede a `http://TU_DOMINIO_DINAMICO` desde tu navegador. Si hay errores, revisa los logs:

```bash
tail -f /var/www/loom/storage/logs/laravel.log
```

---

## 10. SSL (HTTPS) con Certbot (Opcional pero recomendado)

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d TU_DOMINIO_DINAMICO
```

Sigue las instrucciones para obtener y renovar el certificado automáticamente.

---

## 11. Comandos Útiles

- Reiniciar servicios:
  ```bash
  sudo systemctl restart nginx
  sudo systemctl restart php*-fpm
  ```
- Ver estado de servicios:
  ```bash
  sudo systemctl status nginx
  sudo systemctl status php*-fpm
  ```

---

## 12. Consejos Finales

- Haz copias de seguridad periódicas de la base de datos y archivos importantes.
- Mantén el sistema actualizado (`sudo apt update && sudo apt upgrade`).
- Usa HTTPS siempre que sea posible.
- Consulta los manuales de usuario y programador para dudas específicas.

---


---

## 13. Instrucciones para Revisar el Proyecto Localmente

Esta sección está pensada para que se pueda clonar y ejecutar el proyecto en su propio ordenador, sin necesidad de infraestructura en la nube ni DNS dinámica.

### Requisitos previos

- PHP >= 8.1
- Composer
- Node.js >= 16 y npm
- MySQL o MariaDB (o SQLite)

### 1. Clonar el repositorio

```bash
git clone <URL_DEL_REPOSITORIO>
cd loom
```

### 2. Instalar dependencias PHP y JS

```bash
composer install
npm install
```

### 3. Configurar el entorno

Haz una copia del archivo de ejemplo:

```bash
cp .env.example .env
```

Edita `.env` para configurar la base de datos local (por ejemplo, usuario y contraseña de MySQL). Si prefieres, puedes usar SQLite:

```bash
touch database/database.sqlite
```
Y en `.env`:
```
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/completa/al/proyecto/database/database.sqlite
```

Genera la clave de la aplicación:

```bash
php artisan key:generate
```

### 4. Migrar y poblar la base de datos

```bash
php artisan migrate --seed
```

### 5. Compilar los assets

```bash
npm run build
```

### 6. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

Por defecto, la aplicación estará disponible en [http://localhost:8000](http://localhost:8000)

### 7. Acceso y pruebas

- Puedes iniciar sesión con cualquier usuario generado por los seeders (ver `database/seeders/data/usuarios.json`).
- Prueba las funcionalidades principales: publicaciones, biblioteca, diarios, sistema de seguidores, etc.
- Consulta la [Guía de Estilo](guia_estilo.md) para verificar la coherencia visual.

---

**

## 7. Configuración de DNS Dinámica

### FreeDNS
1. Regístrate y crea un subdominio.
2. Obtén tu URL de actualización (formato: `https://freedns.afraid.org/dynamic/update.php?TU_TOKEN`).
3. Añade al crontab del usuario `ubuntu`:
   ```bash
   crontab -e
   # Añade la siguiente línea para actualizar cada 5 minutos:
   */5 * * * * curl -s "https://freedns.afraid.org/dynamic/update.php?TU_TOKEN"
   ```

### DuckDNS
1. Regístrate y crea un subdominio.
2. Añade al crontab del usuario `ubuntu`:
   ```bash
   crontab -e
   # Añade la siguiente línea (reemplaza TU_DOMINIO y TU_TOKEN):
   */5 * * * * curl -s "https://www.duckdns.org/update?domains=TU_DOMINIO&token=TU_TOKEN&ip="
   ```

---

## 8. Configuración de la Base de Datos

Edita `.env` y configura los datos de conexión a la base de datos.

Ejecuta migraciones y seeders:

```bash
cd /var/www/loom
php artisan migrate --seed
```

---

## 9. Comprobar el Despliegue

Accede a `http://TU_DOMINIO_DINAMICO` desde tu navegador. Si hay errores, revisa los logs:

```bash
tail -f /var/www/loom/storage/logs/laravel.log
```

---

## 10. SSL (HTTPS) con Certbot (Opcional pero recomendado)

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d TU_DOMINIO_DINAMICO
```

Sigue las instrucciones para obtener y renovar el certificado automáticamente.

---

## 11. Comandos Útiles

- Reiniciar servicios:
  ```bash
  sudo systemctl restart nginx
  sudo systemctl restart php*-fpm
  ```
- Ver estado de servicios:
  ```bash
  sudo systemctl status nginx
  sudo systemctl status php*-fpm
  ```

---


