-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2025 a las 18:40:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scholarium`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `asignatura_id` bigint(20) UNSIGNED NOT NULL,
  `docente_id` bigint(20) UNSIGNED NOT NULL,
  `dia_semana` varchar(20) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `curso_id`, `asignatura_id`, `docente_id`, `dia_semana`, `hora_inicio`, `hora_fin`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Martes', '10:30:00', '12:10:00', 'Activo', '2025-11-14 22:17:39', '2025-11-14 22:17:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `nivel` enum('Básica','Media') NOT NULL,
  `horas_semanales` int(11) NOT NULL DEFAULT 2,
  `creditos` int(11) NOT NULL DEFAULT 3,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id`, `codigo`, `nombre`, `descripcion`, `nivel`, `horas_semanales`, `creditos`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'MAT101', 'Matemáticas I', 'Fundamentos de matemáticas', 'Básica', 4, 4, 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(2, 'LEN101', 'Lenguaje I', 'Comunicación y comprensión lectora', 'Básica', 3, 3, 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(3, 'CIE101', 'Ciencias Naturales I', 'Introducción a las ciencias', 'Básica', 3, 3, 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(4, 'MAT201', 'Matemáticas Avanzadas', 'Álgebra y geometría', 'Media', 5, 5, 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `email`, `asunto`, `mensaje`, `leido`, `created_at`, `updated_at`) VALUES
(1, 'William Julon', 'william.julon@scholarium.pe', 'Informacion de Matricula', 'Este mensaje es de prueba', 1, '2025-11-14 20:28:12', '2025-11-14 20:28:30'),
(2, 'Eduardo Santivañez', 'eduardo@scholarium.pe', 'PRUEBITA', 'Este mensaje es la prueba 2.', 1, '2025-11-14 20:37:22', '2025-11-14 20:40:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nivel` enum('Básica','Media') NOT NULL,
  `grado` int(11) NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `anio_academico` year(4) NOT NULL,
  `capacidad_maxima` int(11) NOT NULL DEFAULT 40,
  `sala` varchar(50) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `nivel`, `grado`, `seccion`, `anio_academico`, `capacidad_maxima`, `sala`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1° Básica A', 'Básica', 1, 'A', '2025', 30, 'Aula 101', 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(2, '2° Básica B', 'Básica', 2, 'B', '2025', 28, 'Aula 102', 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(3, '1° Media A', 'Media', 1, 'A', '2025', 35, 'Aula 201', 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(4, '2° Media B', 'Media', 2, 'B', '2025', 32, 'Aula 202', 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `especialidad` varchar(100) NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `dni`, `nombres`, `apellidos`, `email`, `telefono`, `especialidad`, `fecha_contratacion`, `estado`, `created_at`, `updated_at`) VALUES
(1, '40123456', 'Carlos Alberto', 'Mendoza Ríos', 'cmendoza@scholarium.pe', '+51 991234567', 'Matemáticas', '2020-01-15', 'Activo', '2025-11-14 13:44:02', '2025-11-14 22:12:46'),
(2, '41234567', 'Ana María', 'Flores Vega', 'aflores@scholarium.pe', '+51 992345678', 'Lenguaje', '2019-03-10', 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(3, '42345678', 'Roberto José', 'Silva Paredes', 'rsilva@scholarium.pe', '+51 993456789', 'Ciencias', '2021-02-20', 'Activo', '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(4, '73456789', 'socrates', 'hijo de Sofronisco', 'socrates@scholarium.pe', '+51 920021783', 'Filosofía', '2025-11-06', 'Activo', '2025-11-14 22:12:30', '2025-11-14 22:12:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(12) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL DEFAULT 'Otro',
  `foto` varchar(255) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `fecha_ingreso` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `dni`, `nombres`, `apellidos`, `fecha_nacimiento`, `direccion`, `telefono`, `email`, `genero`, `foto`, `estado`, `fecha_ingreso`, `created_at`, `updated_at`) VALUES
(1, '72345678', 'Leonnardo', 'Rodriguez Lermo', '2010-05-15', 'Av. Arequipa 1234, Lima', '+51 987654321', 'leonnardo@estudiante.pe', 'Masculino', NULL, 'Activo', '2024-03-01', '2025-11-14 13:44:02', '2025-11-14 22:03:38'),
(2, '73456789', 'Eduardo', 'Santivañez García', '2012-08-22', 'Jr. Lampa 567, Lima', '+51 998765432', 'eduardo@estudiante.pe', 'Masculino', NULL, 'Activo', '2024-03-01', '2025-11-14 13:44:02', '2025-11-14 22:03:09'),
(3, '74567890', 'Gilmar', 'Solano', '2009-11-10', 'Av. Javier Prado 890, San Isidro', '+51 987123456', 'gilmar@estudiante.pe', 'Masculino', NULL, 'Activo', '2023-03-01', '2025-11-14 13:44:02', '2025-11-14 22:04:13'),
(4, '70145293', 'William', 'Julon Mejia', '2016-11-30', 'vivo en tu cerrazón mai lof', '920021783', 'william@estudiante.pe', 'Masculino', NULL, 'Activo', '2025-11-14', '2025-11-14 22:02:25', '2025-11-14 22:02:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_matricula` date NOT NULL,
  `estado` enum('Matriculado','Retirado') NOT NULL DEFAULT 'Matriculado',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id`, `estudiante_id`, `curso_id`, `fecha_matricula`, `estado`, `observaciones`, `created_at`, `updated_at`) VALUES
(5, 4, 1, '2025-11-14', 'Matriculado', NULL, '2025-11-14 22:09:54', '2025-11-14 22:09:54'),
(6, 3, 3, '2025-11-14', 'Matriculado', NULL, '2025-11-14 22:10:07', '2025-11-14 22:10:07'),
(7, 1, 4, '2025-11-14', 'Matriculado', NULL, '2025-11-14 22:10:21', '2025-11-14 22:10:21'),
(8, 2, 4, '2025-11-14', 'Matriculado', NULL, '2025-11-14 22:10:28', '2025-11-14 22:10:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_11_12_230606_create_estudiantes_table', 1),
(6, '2025_11_12_230623_create_cursos_table', 1),
(7, '2025_11_12_230640_create_matriculas_table', 1),
(8, '2025_11_14_133347_rename_rut_to_dni_in_estudiantes_table', 1),
(9, '2025_11_14_133419_create_asignaturas_table', 1),
(10, '2025_11_14_133419_create_docentes_table', 1),
(11, '2025_11_14_133443_create_asignaciones_table', 1),
(12, '2025_11_14_145851_create_contactos_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','docente','estudiante','apoderado') NOT NULL DEFAULT 'estudiante',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@scholarium.pe', NULL, '$2y$12$L/3MsfG8KFiEtdN/ZxnPTO6T.Bq2eUAl6uT5hOLDolZfXWNul9i3a', 'admin', NULL, '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(2, 'Carlos Mendoza', 'profesor@scholarium.pe', NULL, '$2y$12$4XW5p/E35BERDIpCek5sfuWIrAdAw4gauSATeFjJtd.YWgCCjK3o6', 'docente', NULL, '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(3, 'María García', 'estudiante@scholarium.pe', NULL, '$2y$12$jkrWf9/bf/VuWgDqpko2q.WUxKeN4lpiT1aAMmrNc8kgNC1fFL3HO', 'estudiante', NULL, '2025-11-14 13:44:02', '2025-11-14 13:44:02'),
(4, 'William Julon', 'william.julon@scholarium.pe', NULL, '$2y$12$eVMXjjGuMpwP2LAgQF2aVexCnORFYl5WfHNfkhRpgSXAY.iELrVHm', 'estudiante', NULL, '2025-11-14 20:46:01', '2025-11-14 20:46:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asignaciones_curso_id_asignatura_id_unique` (`curso_id`,`asignatura_id`),
  ADD KEY `asignaciones_asignatura_id_foreign` (`asignatura_id`),
  ADD KEY `asignaciones_docente_id_foreign` (`docente_id`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asignaturas_codigo_unique` (`codigo`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `docentes_dni_unique` (`dni`),
  ADD UNIQUE KEY `docentes_email_unique` (`email`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estudiantes_rut_unique` (`dni`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matriculas_estudiante_id_foreign` (`estudiante_id`),
  ADD KEY `matriculas_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_asignatura_id_foreign` FOREIGN KEY (`asignatura_id`) REFERENCES `asignaturas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignaciones_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asignaciones_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matriculas_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
