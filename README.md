# Scholarium

Guía rápida para que cualquier colaborador levante el proyecto en su máquina local. Todos los pasos asumen un entorno Linux/Mac; en Windows se recomienda WSL2.

## Requisitos previos
- PHP 8.1 o superior
- Composer
- Node.js 18+ y npm (requerido por Vite 5)
- Una instancia de base de datos compatible con Laravel (MySQL, MariaDB, etc.)

## Instalación y preparación
1. Instala dependencias de PHP:
   ```bash
   composer install
   ```
2. Instala dependencias de frontend:
   ```bash
   npm install
   ```
3. Copia la configuración de entorno y genera la clave de aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configura la conexión a base de datos en `.env` (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
   - Ejemplo local: `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=scholarium`, `DB_USERNAME=homestead`, `DB_PASSWORD=secret`.
   - Si deseas usar la base de datos de ejemplo incluida, crea la base indicada en `.env` y luego importa `scholarium.sql`.
5. Ejecuta las migraciones (o sincroniza con el SQL de ejemplo) y, si aplica, pobla datos de ejemplo:
   ```bash
   php artisan migrate
   php artisan db:seed # opcional, si existen seeders
   ```

## Ejecución en desarrollo
1. Sirve el backend de Laravel:
   ```bash
   php artisan serve
   ```
2. En otra terminal, levanta el entorno de frontend con Vite:
   ```bash
   npm run dev
   ```

La aplicación estará disponible en `http://localhost:8000` y los assets se servirán desde el servidor de Vite.

> Consejo: si Vite te solicita seleccionar la URL del backend, asegúrate de que `APP_URL` en `.env` coincida con la dirección que muestra `php artisan serve`.

## Pruebas
- Para ejecutar la suite de pruebas de Laravel:
  ```bash
  php artisan test
  ```

- Para linting/formatting de frontend (si está configurado en package.json):
  ```bash
  npm run lint
  npm run format
  ```

## Solución de problemas frecuente
- Si los assets no cargan, asegúrate de que `npm run dev` esté en ejecución.
- Revisa permisos de la carpeta `storage/` si Laravel no puede escribir logs o cachés.
- Tras clonar el proyecto por primera vez, recuerda crear el enlace simbólico de almacenamiento si lo necesitas:
  ```bash
  php artisan storage:link
  ```
- Si cambias dependencias de PHP, limpia cachés de Laravel:
  ```bash
  php artisan optimize:clear
  ```
- Para compilar assets para producción y verificar que el build funciona:
  ```bash
  npm run build
  ```

## Comandos útiles adicionales
- Limpiar y volver a instalar dependencias frontend:
  ```bash
  rm -rf node_modules && npm install
  ```
- Actualizar dependencias de Composer respetando el `composer.lock`:
  ```bash
  composer install --no-dev --prefer-dist
  ```
- Ejecutar migraciones en modo forzado (útil en entornos no interactivos):
  ```bash
  php artisan migrate --force
  ```
