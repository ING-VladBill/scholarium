<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Docente;
use App\Models\Asignatura;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Usuarios
        User::create(['name' => 'Administrador', 'email' => 'admin@scholarium.pe', 'password' => bcrypt('admin123'), 'role' => 'admin']);
        User::create(['name' => 'Carlos Mendoza', 'email' => 'profesor@scholarium.pe', 'password' => bcrypt('profesor123'), 'role' => 'docente']);
        User::create(['name' => 'María García', 'email' => 'estudiante@scholarium.pe', 'password' => bcrypt('estudiante123'), 'role' => 'estudiante']);

        // Estudiantes
        Estudiante::create(['dni' => '72345678', 'nombres' => 'Juan Carlos', 'apellidos' => 'Pérez López', 'fecha_nacimiento' => '2010-05-15', 'email' => 'juan.perez@estudiante.pe', 'telefono' => '+51 987654321', 'direccion' => 'Av. Arequipa 1234, Lima', 'genero' => 'Masculino', 'estado' => 'Activo', 'fecha_ingreso' => '2024-03-01']);
        Estudiante::create(['dni' => '73456789', 'nombres' => 'María Elena', 'apellidos' => 'García Torres', 'fecha_nacimiento' => '2011-08-22', 'email' => 'maria.garcia@estudiante.pe', 'telefono' => '+51 998765432', 'direccion' => 'Jr. Lampa 567, Lima', 'genero' => 'Femenino', 'estado' => 'Activo', 'fecha_ingreso' => '2024-03-01']);
        Estudiante::create(['dni' => '74567890', 'nombres' => 'Pedro Luis', 'apellidos' => 'Rodríguez Sánchez', 'fecha_nacimiento' => '2009-11-10', 'email' => 'pedro.rodriguez@estudiante.pe', 'telefono' => '+51 987123456', 'direccion' => 'Av. Javier Prado 890, San Isidro', 'genero' => 'Masculino', 'estado' => 'Activo', 'fecha_ingreso' => '2023-03-01']);

        // Cursos
        Curso::create(['nombre' => '1° Básica A', 'nivel' => 'Básica', 'grado' => 1, 'seccion' => 'A', 'anio_academico' => 2025, 'capacidad_maxima' => 30, 'sala' => 'Aula 101', 'estado' => 'Activo']);
        Curso::create(['nombre' => '2° Básica B', 'nivel' => 'Básica', 'grado' => 2, 'seccion' => 'B', 'anio_academico' => 2025, 'capacidad_maxima' => 28, 'sala' => 'Aula 102', 'estado' => 'Activo']);
        Curso::create(['nombre' => '1° Media A', 'nivel' => 'Media', 'grado' => 1, 'seccion' => 'A', 'anio_academico' => 2025, 'capacidad_maxima' => 35, 'sala' => 'Aula 201', 'estado' => 'Activo']);
        Curso::create(['nombre' => '2° Media B', 'nivel' => 'Media', 'grado' => 2, 'seccion' => 'B', 'anio_academico' => 2025, 'capacidad_maxima' => 32, 'sala' => 'Aula 202', 'estado' => 'Activo']);

        // Matrículas
        Matricula::create(['estudiante_id' => 1, 'curso_id' => 1, 'fecha_matricula' => '2025-03-01', 'estado' => 'Matriculado']);
        Matricula::create(['estudiante_id' => 2, 'curso_id' => 2, 'fecha_matricula' => '2025-03-01', 'estado' => 'Matriculado']);

        // Docentes
        Docente::create(['dni' => '40123456', 'nombres' => 'Carlos Alberto', 'apellidos' => 'Mendoza Ríos', 'email' => 'cmendoza@scholarium.pe', 'telefono' => '+51 991234567', 'especialidad' => 'Matemáticas', 'fecha_contratacion' => '2020-01-15', 'estado' => 'Activo']);
        Docente::create(['dni' => '41234567', 'nombres' => 'Ana María', 'apellidos' => 'Flores Vega', 'email' => 'aflores@scholarium.pe', 'telefono' => '+51 992345678', 'especialidad' => 'Lenguaje', 'fecha_contratacion' => '2019-03-10', 'estado' => 'Activo']);
        Docente::create(['dni' => '42345678', 'nombres' => 'Roberto José', 'apellidos' => 'Silva Paredes', 'email' => 'rsilva@scholarium.pe', 'telefono' => '+51 993456789', 'especialidad' => 'Ciencias', 'fecha_contratacion' => '2021-02-20', 'estado' => 'Activo']);

        // Asignaturas
        Asignatura::create(['codigo' => 'MAT101', 'nombre' => 'Matemáticas I', 'descripcion' => 'Fundamentos de matemáticas', 'nivel' => 'Básica', 'horas_semanales' => 4, 'creditos' => 4, 'estado' => 'Activo']);
        Asignatura::create(['codigo' => 'LEN101', 'nombre' => 'Lenguaje I', 'descripcion' => 'Comunicación y comprensión lectora', 'nivel' => 'Básica', 'horas_semanales' => 3, 'creditos' => 3, 'estado' => 'Activo']);
        Asignatura::create(['codigo' => 'CIE101', 'nombre' => 'Ciencias Naturales I', 'descripcion' => 'Introducción a las ciencias', 'nivel' => 'Básica', 'horas_semanales' => 3, 'creditos' => 3, 'estado' => 'Activo']);
        Asignatura::create(['codigo' => 'MAT201', 'nombre' => 'Matemáticas Avanzadas', 'descripcion' => 'Álgebra y geometría', 'nivel' => 'Media', 'horas_semanales' => 5, 'creditos' => 5, 'estado' => 'Activo']);
    }
}
