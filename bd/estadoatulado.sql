-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-06-2023 a las 08:35:43
-- Versión del servidor: 5.7.42-cll-lve
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `estadoatulado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles_gates`
--

CREATE TABLE `profiles_gates` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `main_gate` varchar(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profiles_gates`
--

INSERT INTO `profiles_gates` (`id`, `profile_id`, `main_gate`, `created`, `modified`) VALUES
(1, 4, NULL, '2020-05-15 23:09:09', '2020-05-15 23:09:09'),
(2, 5, 'A', '2020-05-15 23:11:08', '2020-05-15 23:11:08'),
(3, 5, 'B', '2020-05-15 23:11:33', '2020-05-15 23:11:33'),
(4, 6, 'A', '2020-05-15 23:12:01', '2020-05-15 23:12:01'),
(5, 6, 'B', '2020-05-15 23:12:40', '2020-05-15 23:12:40'),
(6, 7, 'A', '2020-05-15 23:13:18', '2020-05-15 23:13:18'),
(7, 7, 'B', '2020-05-15 23:13:43', '2020-05-15 23:13:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sourcing_events`
--

CREATE TABLE `sourcing_events` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sourcing_events_profiles`
--

CREATE TABLE `sourcing_events_profiles` (
  `id` int(11) NOT NULL,
  `sourcing_event_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `main_gate` varchar(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `profiles_gates`
--
ALTER TABLE `profiles_gates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sourcing_events`
--
ALTER TABLE `sourcing_events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sourcing_events_profiles`
--
ALTER TABLE `sourcing_events_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `profiles_gates`
--
ALTER TABLE `profiles_gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `sourcing_events`
--
ALTER TABLE `sourcing_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sourcing_events_profiles`
--
ALTER TABLE `sourcing_events_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
