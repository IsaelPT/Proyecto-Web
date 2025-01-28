-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2025 a las 13:28:26
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
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `ID_Pac` int(11) DEFAULT NULL,
  `ID_Doc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `Codigo` int(11) NOT NULL,
  `ID_Pac` int(11) NOT NULL,
  `Detalles` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`Codigo`, `ID_Pac`, `Detalles`) VALUES
(1, 1, 'Diagnóstico de hipertensión'),
(2, 2, 'Diagnóstico de diabetes tipo 2'),
(3, 3, 'Diagnóstico de asma'),
(4, 4, 'Diagnóstico de alergias estacionales'),
(5, 5, 'Diagnóstico de depresión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `ID_Doctor` int(11) NOT NULL,
  `Nombre_Doctor` varchar(50) NOT NULL,
  `Apellido_Doctor` varchar(50) NOT NULL,
  `SegApellido_Doctor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`ID_Doctor`, `Nombre_Doctor`, `Apellido_Doctor`, `SegApellido_Doctor`) VALUES
(1, 'Carlos', 'García', 'Fernández'),
(2, 'Ana', 'Pérez', 'López'),
(3, 'Juan', 'Martínez', 'Castillo'),
(4, 'Laura', 'Sánchez', 'Hernández'),
(5, 'David', 'López', 'Torres'),
(6, 'Roberto', 'Lopez', 'Aguilar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especializacion`
--

CREATE TABLE `especializacion` (
  `ID_Especializacion` int(10) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `ID_Doc` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especializacion`
--

INSERT INTO `especializacion` (`ID_Especializacion`, `Descripcion`, `ID_Doc`) VALUES
(5, 'Cirugía', 1),
(6, 'Pediatría', 2),
(7, 'Cardiología', 3),
(8, 'Dermatología', 4),
(9, 'Neurología', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `ID_Paciente` int(11) NOT NULL,
  `Nombre_Paciente` varchar(50) NOT NULL,
  `Apellido_Paciente` varchar(50) NOT NULL,
  `Seguro` int(11) NOT NULL,
  `SegApellido_Paciente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`ID_Paciente`, `Nombre_Paciente`, `Apellido_Paciente`, `Seguro`, `SegApellido_Paciente`) VALUES
(1, 'Juan', 'Pérez', 123, 'Gómez'),
(2, 'María', 'López', 456, 'Hernández'),
(3, 'Carlos', 'Martínez', 789, 'Rodríguez'),
(4, 'Luisa', 'Sánchez', 101, 'Fernández'),
(5, 'Pedro', 'Alvarez', 202, 'Morales');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD KEY `fk_pacconsult` (`ID_Pac`),
  ADD KEY `fk_docconsult` (`ID_Doc`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`Codigo`),
  ADD KEY `fk_idpaciente` (`ID_Pac`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ID_Doctor`);

--
-- Indices de la tabla `especializacion`
--
ALTER TABLE `especializacion`
  ADD PRIMARY KEY (`ID_Especializacion`) USING BTREE,
  ADD KEY `fk_iddoctor` (`ID_Doc`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ID_Paciente`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `ID_Doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `especializacion`
--
ALTER TABLE `especializacion`
  MODIFY `ID_Especializacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `ID_Paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `fk_docconsult` FOREIGN KEY (`ID_Doc`) REFERENCES `doctor` (`ID_Doctor`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_pacconsult` FOREIGN KEY (`ID_Pac`) REFERENCES `paciente` (`ID_Paciente`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD CONSTRAINT `fk_idpaciente` FOREIGN KEY (`ID_Pac`) REFERENCES `paciente` (`ID_Paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `especializacion`
--
ALTER TABLE `especializacion`
  ADD CONSTRAINT `fk_iddoctor` FOREIGN KEY (`ID_Doc`) REFERENCES `doctor` (`ID_Doctor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
