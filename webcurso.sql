-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2024 a las 16:17:20
-- Versión del servidor: 11.6.2-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webcurso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `cupo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `cupo`) VALUES
(1, 'Gestión de Proyectos Educativos', 'Aprende a planificar y gestionar proyectos educativos con enfoque innovador.', '2024-01-15', '2024-06-15', 30),
(2, 'Investigación Académica y Científica', 'Domina las técnicas y herramientas para realizar investigaciones rigurosas.', '2024-02-01', '2024-07-01', 25),
(3, 'Emprendimiento y Liderazgo', 'Desarrolla habilidades de liderazgo y emprendimiento en contextos educativos y empresariales.', '2024-03-10', '2024-08-10', 20),
(4, 'Tecnologías Educativas en la Era Digital', 'Integra herramientas tecnológicas en procesos de enseñanza-aprendizaje.', '2024-04-05', '2024-09-05', 40),
(5, 'Diseño Curricular Avanzado', 'Crea currículos educativos efectivos y adaptados a las necesidades del siglo XXI.', '2024-05-20', '2024-10-20', 35),
(6, 'Formación en Educación Inclusiva', 'Aprende estrategias para promover la inclusión en entornos educativos.', '2024-06-01', '2024-11-01', 25),
(7, 'Gestión Ambiental y Sostenibilidad', 'Estudia los fundamentos de la sostenibilidad y la gestión ambiental.', '2024-07-01', '2024-12-01', 30),
(8, 'Innovación en Metodologías de Enseñanza', 'Explora metodologías activas para transformar la experiencia de aprendizaje.', '2024-08-15', '2024-12-15', 28),
(9, 'Marketing Digital para Educadores', 'Domina estrategias de marketing para promover proyectos educativos.', '2024-09-01', '2024-12-01', 30),
(10, 'Desarrollo de Competencias Docentes', 'Fortalece tus habilidades pedagógicas para impactar en el aula.', '2024-10-01', '2025-03-01', 40),
(11, 'Gestión de la Información en Bibliotecas Académicas', 'Aprende a gestionar recursos en bibliotecas y entornos académicos.', '2024-11-01', '2025-04-01', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `usuario_id`, `curso_id`) VALUES
(18, 2, 1),
(19, 2, 3),
(20, 2, 1),
(21, 2, 1),
(22, 2, 1),
(23, 2, 1),
(24, 2, 1),
(25, 2, 1),
(26, 2, 1),
(27, 2, 1),
(28, 2, 1),
(29, 2, 2),
(30, 2, 3),
(31, 2, 3),
(32, 2, 1),
(33, 2, 2),
(34, 2, 2),
(35, 2, 2),
(36, 2, 1),
(37, 2, 1),
(38, 2, 6),
(39, 2, 6),
(40, 2, 5),
(41, 2, 5),
(42, 2, 1),
(43, 2, 5),
(44, 2, 2),
(45, 2, 2),
(46, 2, 1),
(47, 20, 1),
(48, 20, 2),
(49, 20, 3),
(50, 20, 4),
(51, 20, 5),
(52, 20, 6),
(53, 24, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `fecha_registro`) VALUES
(1, 'juan', 'juanuno@email.com', '$2y$10$a6Ek3UQ9jk0X2X25u8tD6O.E5BLtVQUmncnMSEhT5gnA9QayXIyt2', '2024-11-28 20:38:15'),
(2, 'juan', 'juan1@email.com', '$2y$10$E1GJo0/XjYNvpk.bkRBqdO6d34ZkiQ156EiBPWWdh.L0umknoj8JO', '2024-11-28 20:46:36'),
(3, 'Nahomi', 'naho1@email.com', '$2y$10$EaQh6zB8qjR4kqv2AMc7COWhZNMzXiHTeU44JVMtRX4f6H0fzJsBO', '2024-11-28 22:20:08'),
(6, 'Juanito', 'juanito1@email.com', '$2y$10$pA2kU0LQ2goTNgPbG/1elui87z8GBEMfsVbA91IGaZj6MxcMtd9ea', '2024-11-28 22:23:47'),
(10, 'hola', 'hola1@email.com', '$2y$10$mmRezs/XqlbmlCdWtOH0oONzMiXZC5MxqtyvGyTWhUfkq7SxpIVWy', '2024-11-28 22:25:48'),
(19, 'Sapo', 'sapo@email.com', '$2y$10$CTn0V8E/VBJupQEKp3tpHuKjWHKAvGdDTjoruBooAZTTD0syD7oCm', '2024-11-28 22:50:34'),
(20, 'papa2', 'papa2@email.com', '$2y$10$xBOWaJ8qAV5QTyNYQnNFe.vl/tSSbcCY2x92fuOsyUY8nZVGWoB0e', '2024-11-28 22:51:16'),
(21, 'sapote', '1020sapote6@email.com', '$2y$10$1hPc0WDEqSl6xXZEja1WPe.z7ocu/Xg.ZLfiEYBZqVmaR1ZMwNfCK', '2024-11-28 22:59:55'),
(22, 'papita', 'papita1@email.com', '$2y$10$Qh43A3xlqybMeuzVFGeX/enDf2F3BzCWrifoilMXhDZq/WDQ2/ToO', '2024-11-28 23:02:15'),
(23, 'papaya', 'papaya1@email.com', '$2y$10$eJNdHNqgbQsoM8Nvf.rcEe6F7Fd4MhhhZcquj5u6lPYf2RbFeXyy2', '2024-11-28 23:29:04'),
(24, 'pollo', 'pollo1@email.com', '$2y$10$aEZScomy4vXvunT/jGlqqukD85mPGsHSkgBF2cGvyEmRXOqYv3DYa', '2024-11-29 00:35:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `inscripciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscripciones_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
