# guía rápida de iniciación 

# 1. instalar las dependencias
    abre una terminal en la carpeta del proyecto
    luego ejecuta:
               composer install 
    esto creará la carpeta vendor

# 2.  Crea la base de datos
    en PhpMyadmin: 
    CREATE DATABASE scholarium CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    luego ubicate en ma bade de datos creada: scholarium e importa el archivo scholarium.sql

# 3. Configurar .env
    cambia el nombre del archivo "env.example" a ".env".
    dentro de .env edita las siguientes lineas: 
        DB_DATABASE=scholarium DB_USERNAME= "aqui pone tu usuario" DB_PASSWORD= "tu contraseña" si no la tienes, dejala en blanco
# 4. Levanta la pagina con el siguiente código 

    php artisan serve
