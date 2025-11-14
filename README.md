#guía rápida de iniciación 

#1. instalar las dependencias
abre una terminal en la carpeta del proyecto
luego ejecuta:
     composer install 
esto creará la carpeta vendor

#2.  Crea la base de datos
    en PhpMyadmin: 
    CREATE DATABASE scholarium CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    luego ubicate en ma bade de datos creada: scholarium e importa el archivo scholarium.sql

#3. Levanta la pagina con el siguiente código 

    php artisan serve
