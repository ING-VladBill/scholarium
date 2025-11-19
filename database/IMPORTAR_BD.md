# 📥 Guía de Importación de Base de Datos

## Opción 1: Importar desde archivo SQL (Recomendado)

### Paso 1: Crear la base de datos

Ejecutar en MySQL:

```sql
CREATE DATABASE scholarium CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Paso 2: Importar el archivo SQL

**Desde línea de comandos:**

```bash
mysql -u tu_usuario -p scholarium < database/scholarium_backup.sql
```

**Desde phpMyAdmin:**

1. Seleccionar la base de datos `scholarium`
2. Ir a la pestaña "Importar"
3. Seleccionar el archivo `database/scholarium_backup.sql`
4. Hacer clic en "Continuar"

---

## Opción 2: Usar migraciones y seeders de Laravel

### Paso 1: Configurar .env

Editar el archivo `.env` y configurar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=scholarium
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### Paso 2: Ejecutar migraciones y seeders

```bash
php artisan migrate
php artisan db:seed
```

Esto creará las tablas y poblará la base de datos con los mismos datos de prueba.

---

## Datos de Prueba Incluidos

### Usuarios

| Email | Contraseña | Rol |
|-------|------------|-----|
| admin@scholarium.cl | admin123 | admin |
| profesor@scholarium.cl | profesor123 | docente |

### Estudiantes

1. **Juan Pérez González**
   - RUT: 12345678-9
   - Email: juan.perez@email.cl
   - Estado: Activo

2. **María González López**
   - RUT: 98765432-1
   - Email: maria.gonzalez@email.cl
   - Estado: Activo

3. **Pedro Rodríguez Silva**
   - RUT: 11223344-5
   - Email: pedro.rodriguez@email.cl
   - Estado: Activo

### Cursos

1. **1° Básico A**
   - Nivel: Básica
   - Capacidad: 35
   - Sala: 101
   - Estado: Activo

2. **2° Básico A**
   - Nivel: Básica
   - Capacidad: 35
   - Sala: 102
   - Estado: Activo

3. **3° Medio B**
   - Nivel: Media
   - Capacidad: 40
   - Sala: 201
   - Estado: Activo

4. **4° Medio A**
   - Nivel: Media
   - Capacidad: 40
   - Sala: 202
   - Estado: Activo

### Matrículas

- Juan Pérez → 1° Básico A
- María González → 2° Básico A

---

## Verificación de la Importación

### Verificar que las tablas existan:

```sql
SHOW TABLES;
```

Deberías ver:
- cursos
- estudiantes
- failed_jobs
- matriculas
- migrations
- password_reset_tokens
- personal_access_tokens
- users

### Verificar datos:

```sql
SELECT COUNT(*) FROM users;        -- Debe retornar: 2
SELECT COUNT(*) FROM estudiantes;  -- Debe retornar: 3
SELECT COUNT(*) FROM cursos;       -- Debe retornar: 4
SELECT COUNT(*) FROM matriculas;   -- Debe retornar: 2
```

---

## Solución de Problemas

### Error: "Access denied"

Verificar credenciales en `.env` y que el usuario tenga permisos:

```sql
GRANT ALL PRIVILEGES ON scholarium.* TO 'tu_usuario'@'localhost';
FLUSH PRIVILEGES;
```

### Error: "Database doesn't exist"

Crear la base de datos primero:

```sql
CREATE DATABASE scholarium CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Error: "Table already exists"

Eliminar las tablas existentes:

```sql
DROP DATABASE scholarium;
CREATE DATABASE scholarium CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Luego importar nuevamente.

---

## Estructura de la Base de Datos

### Tabla: users
- id (PK)
- name
- email (unique)
- password
- role (admin, docente, estudiante)
- timestamps

### Tabla: estudiantes
- id (PK)
- rut (unique)
- nombres
- apellidos
- fecha_nacimiento
- email (unique, nullable)
- telefono (nullable)
- direccion (nullable)
- genero
- estado
- fecha_ingreso
- timestamps

### Tabla: cursos
- id (PK)
- nombre
- nivel (Básica, Media)
- grado
- seccion
- anio_academico
- capacidad_maxima
- sala (nullable)
- estado
- timestamps

### Tabla: matriculas
- id (PK)
- estudiante_id (FK → estudiantes.id) ON DELETE CASCADE
- curso_id (FK → cursos.id) ON DELETE CASCADE
- fecha_matricula
- estado
- timestamps

---

¡Listo! Tu base de datos está configurada y lista para usar. 🎉
