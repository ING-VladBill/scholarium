# Scholarium

Guía rápida para que cualquier colaborador levante el proyecto en su máquina local. Incluye pasos específicos para Windows 10/11 con VS Code y Git.

### Windows 10/11 (sin WSL)
1. **Instala Git** desde [git-scm.com](https://git-scm.com/download/win). Activa la opción para usar Git Bash y que añada Git al PATH.
2. **Instala PHP 8.1+** (con extensiones `openssl`, `mbstring`, `pdo_mysql`) y **Composer**. Opciones recomendadas:
   - [Laravel Herd para Windows](https://herd.laravel.com/windows) instala PHP y Composer listos para usar.
   - O bien usa [Chocolatey](https://chocolatey.org/install) en PowerShell y luego `choco install php composer`.
3. **Clona el repositorio** con Git Bash o PowerShell en una carpeta sin espacios:
   ```bash
   git clone <URL_DEL_REPO>
   cd scholarium
   ```
4. **Abre el proyecto en VS Code** (`code .` desde Git Bash/PowerShell) y abre una terminal integrada (Git Bash o PowerShell) para ejecutar los comandos de esta guía.
5. Si PHP no se reconoce en la terminal, reinicia VS Code o verifica que la ruta de PHP/Composer esté en la variable de entorno `PATH`.

## Requisitos previos
- PHP 8.1 o superior
- Composer
- Una instancia de base de datos compatible con Laravel (MySQL, MariaDB, etc.)

## Instalación y preparación
1. Instala dependencias de PHP (Laravel viene dentro de estas dependencias; no necesitas crear un proyecto nuevo):
   ```bash
   composer install
   ```
2. Copia la configuración de entorno y genera la clave de aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Configura la conexión a base de datos en `.env` (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
   - Ejemplo local: `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=scholarium`, `DB_USERNAME=homestead`, `DB_PASSWORD=secret`.
   - Si deseas usar la base de datos de ejemplo incluida, crea la base indicada en `.env` y luego importa `scholarium.sql`.
4. Ejecuta las migraciones (o sincroniza con el SQL de ejemplo) y, si aplica, pobla datos de ejemplo:
   ```bash
   php artisan migrate
   php artisan db:seed # opcional, si existen seeders
   ```

## Ejecución en desarrollo
1. Sirve el backend de Laravel:
   ```bash
   php artisan serve
   ```
La aplicación estará disponible en `http://localhost:8000`.

## Pruebas
- Para ejecutar la suite de pruebas de Laravel:
  ```bash
  php artisan test
  ```

## Solución de problemas frecuente
- Revisa permisos de la carpeta `storage/` si Laravel no puede escribir logs o cachés.
- Tras clonar el proyecto por primera vez, recuerda crear el enlace simbólico de almacenamiento si lo necesitas:
  ```bash
  php artisan storage:link
  ```
- Si cambias dependencias de PHP, limpia cachés de Laravel:
  ```bash
  php artisan optimize:clear
  ```
## Comandos útiles adicionales
- Actualizar dependencias de Composer respetando el `composer.lock`:
  ```bash
  composer install --no-dev --prefer-dist
  ```
- Ejecutar migraciones en modo forzado (útil en entornos no interactivos):
  ```bash
  php artisan migrate --force
  ```
