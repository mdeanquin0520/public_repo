-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-06-2023 a las 10:11:14
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
-- Estructura de tabla para la tabla `acl_phinxlog`
--

CREATE TABLE `acl_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `acl_phinxlog`
--

INSERT INTO `acl_phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20141229162641, 'CakePhpDbAcl', '2023-03-08 00:07:46', '2023-03-08 00:07:46', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE `acos` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 300),
(2, 1, NULL, NULL, 'Error', 2, 3),
(3, 1, NULL, NULL, 'Events', 4, 15),
(4, 3, NULL, NULL, 'index', 5, 6),
(5, 3, NULL, NULL, 'view', 7, 8),
(6, 3, NULL, NULL, 'add', 9, 10),
(7, 3, NULL, NULL, 'edit', 11, 12),
(8, 3, NULL, NULL, 'delete', 13, 14),
(9, 1, NULL, NULL, 'Groups', 16, 27),
(10, 9, NULL, NULL, 'index', 17, 18),
(11, 9, NULL, NULL, 'view', 19, 20),
(12, 9, NULL, NULL, 'add', 21, 22),
(13, 9, NULL, NULL, 'edit', 23, 24),
(14, 9, NULL, NULL, 'delete', 25, 26),
(15, 1, NULL, NULL, 'Home', 28, 31),
(16, 15, NULL, NULL, 'index', 29, 30),
(17, 1, NULL, NULL, 'Institutions', 32, 47),
(18, 17, NULL, NULL, 'index', 33, 34),
(19, 17, NULL, NULL, 'view', 35, 36),
(20, 17, NULL, NULL, 'add', 37, 38),
(21, 17, NULL, NULL, 'edit', 39, 40),
(22, 17, NULL, NULL, 'delete', 41, 42),
(23, 17, NULL, NULL, 'getInstitutionsMarkers', 43, 44),
(24, 17, NULL, NULL, 'setgeo', 45, 46),
(25, 1, NULL, NULL, 'MyPermissions', 48, 59),
(26, 25, NULL, NULL, 'index', 49, 50),
(27, 25, NULL, NULL, 'view', 51, 52),
(28, 25, NULL, NULL, 'add', 53, 54),
(29, 25, NULL, NULL, 'edit', 55, 56),
(30, 25, NULL, NULL, 'delete', 57, 58),
(31, 1, NULL, NULL, 'Nets', 60, 71),
(32, 31, NULL, NULL, 'index', 61, 62),
(33, 31, NULL, NULL, 'view', 63, 64),
(34, 31, NULL, NULL, 'add', 65, 66),
(35, 31, NULL, NULL, 'edit', 67, 68),
(36, 31, NULL, NULL, 'delete', 69, 70),
(37, 1, NULL, NULL, 'Observations', 72, 83),
(38, 37, NULL, NULL, 'index', 73, 74),
(39, 37, NULL, NULL, 'view', 75, 76),
(40, 37, NULL, NULL, 'add', 77, 78),
(41, 37, NULL, NULL, 'edit', 79, 80),
(42, 37, NULL, NULL, 'delete', 81, 82),
(43, 1, NULL, NULL, 'Orders', 84, 95),
(44, 43, NULL, NULL, 'index', 85, 86),
(45, 43, NULL, NULL, 'view', 87, 88),
(46, 43, NULL, NULL, 'add', 89, 90),
(47, 43, NULL, NULL, 'edit', 91, 92),
(48, 43, NULL, NULL, 'delete', 93, 94),
(49, 1, NULL, NULL, 'Pacients', 96, 113),
(50, 49, NULL, NULL, 'index', 97, 98),
(51, 49, NULL, NULL, 'view', 99, 100),
(52, 49, NULL, NULL, 'add', 101, 102),
(53, 49, NULL, NULL, 'edit', 103, 104),
(54, 49, NULL, NULL, 'delete', 105, 106),
(55, 49, NULL, NULL, 'setgeo', 107, 108),
(56, 49, NULL, NULL, 'map', 109, 110),
(57, 49, NULL, NULL, 'getPacientsMarkers', 111, 112),
(58, 1, NULL, NULL, 'Profiles', 114, 125),
(59, 58, NULL, NULL, 'index', 115, 116),
(60, 58, NULL, NULL, 'view', 117, 118),
(61, 58, NULL, NULL, 'add', 119, 120),
(62, 58, NULL, NULL, 'edit', 121, 122),
(63, 58, NULL, NULL, 'delete', 123, 124),
(64, 1, NULL, NULL, 'ProfilesGates', 126, 137),
(65, 64, NULL, NULL, 'index', 127, 128),
(66, 64, NULL, NULL, 'view', 129, 130),
(67, 64, NULL, NULL, 'add', 131, 132),
(68, 64, NULL, NULL, 'edit', 133, 134),
(69, 64, NULL, NULL, 'delete', 135, 136),
(70, 1, NULL, NULL, 'Schedules', 138, 149),
(71, 70, NULL, NULL, 'index', 139, 140),
(72, 70, NULL, NULL, 'view', 141, 142),
(73, 70, NULL, NULL, 'add', 143, 144),
(74, 70, NULL, NULL, 'edit', 145, 146),
(75, 70, NULL, NULL, 'delete', 147, 148),
(76, 1, NULL, NULL, 'SourcingEvents', 150, 161),
(77, 76, NULL, NULL, 'index', 151, 152),
(78, 76, NULL, NULL, 'view', 153, 154),
(79, 76, NULL, NULL, 'add', 155, 156),
(80, 76, NULL, NULL, 'edit', 157, 158),
(81, 76, NULL, NULL, 'delete', 159, 160),
(82, 1, NULL, NULL, 'StatesxDays', 162, 173),
(83, 82, NULL, NULL, 'index', 163, 164),
(84, 82, NULL, NULL, 'view', 165, 166),
(85, 82, NULL, NULL, 'addUser', 167, 168),
(86, 82, NULL, NULL, 'addPacient', 169, 170),
(87, 82, NULL, NULL, 'delete', 171, 172),
(88, 1, NULL, NULL, 'StatusGroups', 174, 187),
(89, 88, NULL, NULL, 'index', 175, 176),
(90, 88, NULL, NULL, 'view', 177, 178),
(91, 88, NULL, NULL, 'add', 179, 180),
(92, 88, NULL, NULL, 'edit', 181, 182),
(93, 88, NULL, NULL, 'delete', 183, 184),
(94, 88, NULL, NULL, 'graphics', 185, 186),
(95, 1, NULL, NULL, 'Stocks', 188, 195),
(96, 95, NULL, NULL, 'index', 189, 190),
(97, 95, NULL, NULL, 'view', 191, 192),
(98, 95, NULL, NULL, 'delete', 193, 194),
(99, 1, NULL, NULL, 'Supplies', 196, 207),
(100, 99, NULL, NULL, 'index', 197, 198),
(101, 99, NULL, NULL, 'view', 199, 200),
(102, 99, NULL, NULL, 'add', 201, 202),
(103, 99, NULL, NULL, 'edit', 203, 204),
(104, 99, NULL, NULL, 'delete', 205, 206),
(105, 1, NULL, NULL, 'Turns', 208, 219),
(106, 105, NULL, NULL, 'index', 209, 210),
(107, 105, NULL, NULL, 'view', 211, 212),
(108, 105, NULL, NULL, 'add', 213, 214),
(109, 105, NULL, NULL, 'edit', 215, 216),
(110, 105, NULL, NULL, 'delete', 217, 218),
(111, 1, NULL, NULL, 'Users', 220, 251),
(112, 111, NULL, NULL, 'login', 221, 222),
(113, 111, NULL, NULL, 'logout', 223, 224),
(114, 111, NULL, NULL, 'index', 225, 226),
(115, 111, NULL, NULL, 'view', 227, 228),
(116, 111, NULL, NULL, 'listAgent', 229, 230),
(117, 111, NULL, NULL, 'listNet', 231, 232),
(118, 111, NULL, NULL, 'add', 233, 234),
(119, 111, NULL, NULL, 'edit', 235, 236),
(120, 111, NULL, NULL, 'delete', 237, 238),
(121, 111, NULL, NULL, 'forgotpassword', 239, 240),
(122, 111, NULL, NULL, 'resetpassword', 241, 242),
(123, 111, NULL, NULL, 'changepassword', 243, 244),
(124, 111, NULL, NULL, 'getUsersMarkers', 245, 246),
(125, 111, NULL, NULL, 'getUserMarkers', 247, 248),
(126, 111, NULL, NULL, 'setgeo', 249, 250),
(127, 1, NULL, NULL, 'Acl', 252, 253),
(128, 1, NULL, NULL, 'Bake', 254, 255),
(129, 1, NULL, NULL, 'Cake\\TwigView', 256, 257),
(130, 1, NULL, NULL, 'DebugKit', 258, 295),
(131, 130, NULL, NULL, 'Composer', 259, 262),
(132, 131, NULL, NULL, 'checkDependencies', 260, 261),
(133, 130, NULL, NULL, 'Dashboard', 263, 268),
(134, 133, NULL, NULL, 'index', 264, 265),
(135, 133, NULL, NULL, 'reset', 266, 267),
(136, 130, NULL, NULL, 'DebugKit', 269, 270),
(137, 130, NULL, NULL, 'MailPreview', 271, 278),
(138, 137, NULL, NULL, 'index', 272, 273),
(139, 137, NULL, NULL, 'sent', 274, 275),
(140, 137, NULL, NULL, 'email', 276, 277),
(141, 130, NULL, NULL, 'Panels', 279, 286),
(142, 141, NULL, NULL, 'index', 280, 281),
(143, 141, NULL, NULL, 'view', 282, 283),
(144, 141, NULL, NULL, 'latestHistory', 284, 285),
(145, 130, NULL, NULL, 'Requests', 287, 290),
(146, 145, NULL, NULL, 'view', 288, 289),
(147, 130, NULL, NULL, 'Toolbar', 291, 294),
(148, 147, NULL, NULL, 'clearCache', 292, 293),
(149, 1, NULL, NULL, 'Migrations', 296, 297),
(150, 1, NULL, NULL, 'Search', 298, 299);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE `aros` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Profiles', 1, 'Administrador', 1, 2),
(2, NULL, 'Profiles', 2, 'Médico coordinador de médicos', 3, 4),
(3, NULL, 'Profiles', 3, 'Médico coordinador de célula', 5, 6),
(4, NULL, 'Profiles', 4, 'Coordinador de UF', 7, 8),
(5, NULL, 'Profiles', 5, 'Responsable de nodo', 9, 10),
(6, NULL, 'Profiles', 6, 'Operador Táctico', 11, 12),
(7, NULL, 'Profiles', 7, 'Agente sanitario', 13, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE `aros_acos` (
  `id` int(11) NOT NULL,
  `aro_id` int(11) NOT NULL,
  `aco_id` int(11) NOT NULL,
  `_create` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(84, 2, 3, '1', '1', '1', '1'),
(85, 2, 9, '1', '1', '1', '1'),
(86, 2, 15, '1', '1', '1', '1'),
(87, 2, 17, '1', '1', '1', '1'),
(88, 2, 31, '1', '1', '1', '1'),
(89, 2, 37, '1', '1', '1', '1'),
(90, 2, 43, '1', '1', '1', '1'),
(91, 2, 49, '1', '1', '1', '1'),
(92, 2, 70, '1', '1', '1', '1'),
(93, 2, 76, '1', '1', '1', '1'),
(94, 2, 82, '1', '1', '1', '1'),
(95, 2, 88, '1', '1', '1', '1'),
(96, 2, 95, '1', '1', '1', '1'),
(97, 2, 99, '1', '1', '1', '1'),
(98, 2, 105, '1', '1', '1', '1'),
(99, 2, 111, '1', '1', '1', '1'),
(100, 3, 3, '1', '1', '1', '1'),
(101, 3, 9, '1', '1', '1', '1'),
(102, 3, 15, '1', '1', '1', '1'),
(103, 3, 17, '1', '1', '1', '1'),
(104, 3, 31, '1', '1', '1', '1'),
(105, 3, 37, '1', '1', '1', '1'),
(106, 3, 43, '1', '1', '1', '1'),
(107, 3, 49, '1', '1', '1', '1'),
(108, 3, 70, '1', '1', '1', '1'),
(109, 3, 76, '1', '1', '1', '1'),
(110, 3, 82, '1', '1', '1', '1'),
(111, 3, 88, '1', '1', '1', '1'),
(112, 3, 95, '1', '1', '1', '1'),
(113, 3, 99, '1', '1', '1', '1'),
(114, 3, 105, '1', '1', '1', '1'),
(115, 3, 111, '1', '1', '1', '1'),
(116, 4, 3, '1', '1', '1', '1'),
(117, 4, 15, '1', '1', '1', '1'),
(118, 4, 17, '1', '1', '1', '1'),
(119, 4, 31, '1', '1', '1', '1'),
(120, 4, 37, '1', '1', '1', '1'),
(121, 4, 43, '1', '1', '1', '1'),
(122, 4, 49, '1', '1', '1', '1'),
(123, 4, 70, '1', '1', '1', '1'),
(124, 4, 76, '1', '1', '1', '1'),
(125, 4, 82, '1', '1', '1', '1'),
(126, 4, 95, '1', '1', '1', '1'),
(127, 4, 99, '1', '1', '1', '1'),
(128, 4, 105, '1', '1', '1', '1'),
(129, 4, 111, '1', '1', '1', '1'),
(130, 5, 3, '1', '1', '1', '1'),
(131, 5, 15, '1', '1', '1', '1'),
(132, 5, 17, '1', '1', '1', '1'),
(133, 5, 37, '1', '1', '1', '1'),
(134, 5, 43, '1', '1', '1', '1'),
(135, 5, 49, '1', '1', '1', '1'),
(136, 5, 70, '1', '1', '1', '1'),
(137, 5, 76, '1', '1', '1', '1'),
(138, 5, 82, '1', '1', '1', '1'),
(139, 5, 95, '1', '1', '1', '1'),
(140, 5, 99, '1', '1', '1', '1'),
(141, 5, 105, '1', '1', '1', '1'),
(142, 5, 111, '1', '1', '1', '1'),
(143, 6, 3, '1', '1', '1', '1'),
(144, 6, 15, '1', '1', '1', '1'),
(145, 6, 17, '1', '1', '1', '1'),
(146, 6, 37, '1', '1', '1', '1'),
(147, 6, 43, '1', '1', '1', '1'),
(148, 6, 49, '1', '1', '1', '1'),
(149, 6, 70, '1', '1', '1', '1'),
(150, 6, 76, '1', '1', '1', '1'),
(151, 6, 82, '1', '1', '1', '1'),
(152, 6, 95, '1', '1', '1', '1'),
(153, 6, 99, '1', '1', '1', '1'),
(154, 6, 105, '1', '1', '1', '1'),
(155, 6, 111, '1', '1', '1', '1'),
(156, 7, 3, '1', '1', '1', '1'),
(157, 7, 15, '1', '1', '1', '1'),
(158, 7, 17, '1', '1', '1', '1'),
(159, 7, 37, '1', '1', '1', '1'),
(160, 7, 43, '1', '1', '1', '1'),
(161, 7, 49, '1', '1', '1', '1'),
(162, 7, 70, '1', '1', '1', '1'),
(163, 7, 76, '1', '1', '1', '1'),
(164, 7, 82, '1', '1', '1', '1'),
(165, 7, 95, '1', '1', '1', '1'),
(166, 7, 99, '1', '1', '1', '1'),
(167, 7, 105, '1', '1', '1', '1'),
(168, 7, 111, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  `net_id` int(11) NOT NULL,
  `main_gate` varchar(1) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events_users`
--

CREATE TABLE `events_users` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `supply_id` int(11) DEFAULT NULL,
  `deliver_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `created`, `modified`) VALUES
(1, 'Célula 1', '2023-03-23 12:03:57', '2023-04-06 00:39:45'),
(2, 'Célula 2', '2023-03-23 12:04:18', '2023-03-23 12:04:18'),
(3, 'Célula 3', '2023-03-23 12:04:40', '2023-03-23 12:04:40'),
(4, 'Célula 4', '2023-03-23 12:05:01', '2023-03-23 12:05:01'),
(5, 'Célula 5', '2023-03-23 12:05:20', '2023-03-23 12:05:20'),
(6, 'Célula 6', '2023-03-23 12:05:43', '2023-03-23 12:05:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups_users`
--

CREATE TABLE `groups_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `net_id` int(11) DEFAULT NULL,
  `main_gate` varchar(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `groups_users`
--

INSERT INTO `groups_users` (`id`, `user_id`, `group_id`, `net_id`, `main_gate`, `created`, `modified`) VALUES
(1, 3, 1, NULL, NULL, '2023-03-23 13:14:49', '2023-03-23 13:14:49'),
(2, 3, 2, NULL, NULL, '2023-03-23 13:14:49', '2023-03-23 13:14:49'),
(3, 4, 1, 1, '', '2023-03-31 16:49:48', '2023-03-31 16:49:48'),
(4, 5, 1, 1, 'A', '2023-04-01 15:13:40', '2023-04-01 15:13:40'),
(5, 6, 1, 1, 'B', '2023-04-01 15:42:05', '2023-04-01 15:42:05'),
(6, 7, 1, 1, 'A', '2023-04-01 19:26:48', '2023-04-01 19:26:48'),
(7, 8, 1, 1, 'B', '2023-04-01 19:29:46', '2023-04-01 19:29:46'),
(8, 9, 1, 1, 'A', '2023-04-01 19:36:15', '2023-04-01 19:36:15'),
(9, 10, 1, 1, 'B', '2023-04-01 19:38:57', '2023-04-01 19:38:57'),
(10, 11, 1, 2, '', '2023-04-06 00:20:18', '2023-04-06 00:20:18'),
(11, 12, 1, 2, 'A', '2023-04-06 00:24:34', '2023-04-06 00:24:34'),
(12, 13, 1, 2, 'B', '2023-04-06 00:27:28', '2023-04-06 00:27:28'),
(13, 14, 1, 2, 'A', '2023-04-06 00:31:00', '2023-04-06 00:31:00'),
(14, 15, 1, 2, 'B', '2023-04-06 00:34:22', '2023-04-06 00:34:22'),
(15, 16, 1, 2, 'A', '2023-04-06 00:37:08', '2023-04-06 00:37:08'),
(16, 17, 1, 2, 'B', '2023-04-06 00:39:45', '2023-04-06 00:39:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `map_lat` decimal(18,15) DEFAULT NULL,
  `map_long` decimal(18,15) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `address`, `phone`, `email`, `map_lat`, `map_long`, `created`, `modified`) VALUES
(1, 'Hospital Privado', 'Friuli 1500', '0351-4892560', 'info@hospitalprivado.com', '-31.442666334793927', '-64.198423116088380', '2023-04-22 15:23:07', '2023-04-22 15:34:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nets`
--

CREATE TABLE `nets` (
  `id` int(11) NOT NULL,
  `net_name` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `nets`
--

INSERT INTO `nets` (`id`, `net_name`, `group_id`, `created`, `modified`) VALUES
(1, 'UF No. 1', 1, '2023-03-23 12:14:27', '2023-03-23 12:14:27'),
(2, 'UF No. 2', 1, '2023-03-23 12:15:38', '2023-03-23 12:15:38'),
(3, 'UF No. 3', 1, '2023-03-23 12:16:05', '2023-03-23 12:16:05'),
(4, 'UF No. 4', 1, '2023-03-23 12:16:29', '2023-03-23 12:16:29'),
(5, 'UF No. 5', 1, '2023-03-23 12:16:53', '2023-03-23 12:16:53'),
(6, 'UF No. 6', 1, '2023-03-23 12:17:26', '2023-03-23 12:17:26'),
(7, 'UF No. 1', 2, '2023-03-23 12:17:49', '2023-03-23 12:17:49'),
(8, 'UF No. 2', 2, '2023-03-23 12:18:15', '2023-03-23 12:18:15'),
(9, 'UF No. 3', 2, '2023-03-23 12:18:57', '2023-03-23 12:18:57'),
(10, 'UF No. 4', 2, '2023-03-23 12:19:29', '2023-03-23 12:19:29'),
(11, 'UF No. 5', 2, '2023-03-23 12:19:58', '2023-03-23 12:19:58'),
(12, 'UF No. 6', 2, '2023-03-23 12:20:23', '2023-03-23 12:20:23'),
(13, 'UF No. 1', 3, '2023-03-23 12:20:52', '2023-03-23 12:20:52'),
(14, 'UF No. 2', 3, '2023-03-23 12:21:25', '2023-03-23 12:21:25'),
(15, 'UF No. 3', 3, '2023-03-23 12:21:56', '2023-03-23 12:21:56'),
(16, 'UF No. 4', 3, '2023-03-23 12:22:30', '2023-03-23 12:22:30'),
(17, 'UF No. 5', 3, '2023-03-23 12:23:00', '2023-03-23 12:23:00'),
(18, 'UF No. 6', 3, '2023-03-23 12:23:34', '2023-03-23 12:23:34'),
(19, 'UF No. 1', 4, '2023-03-23 12:24:02', '2023-03-23 12:24:02'),
(20, 'UF No. 2', 4, '2023-03-23 12:24:29', '2023-03-23 12:24:29'),
(21, 'UF No. 3', 4, '2023-03-23 12:25:02', '2023-03-23 12:25:02'),
(22, 'UF No. 4', 4, '2023-03-23 12:25:56', '2023-03-23 12:26:47'),
(23, 'UF No. 5', 4, '2023-03-23 12:27:24', '2023-03-23 12:27:24'),
(24, 'UF No. 6', 4, '2023-03-23 12:28:06', '2023-03-23 12:28:06'),
(25, 'UF No. 1', 5, '2023-03-23 12:28:51', '2023-03-23 12:28:51'),
(26, 'UF No. 2', 5, '2023-03-23 12:29:36', '2023-03-23 12:29:36'),
(27, 'UF No. 3', 5, '2023-03-23 12:30:11', '2023-03-23 12:30:11'),
(28, 'UF No. 4', 5, '2023-03-23 12:30:51', '2023-03-23 12:30:51'),
(29, 'UF No. 5', 5, '2023-03-23 12:31:38', '2023-03-23 12:31:38'),
(30, 'UF No. 6', 5, '2023-03-23 12:32:22', '2023-03-23 12:32:22'),
(31, 'UF No. 1', 6, '2023-03-23 12:33:23', '2023-03-23 12:33:23'),
(32, 'UF No. 2', 6, '2023-03-23 12:33:46', '2023-03-23 12:33:46'),
(33, 'UF No. 3', 6, '2023-03-23 12:34:34', '2023-03-23 12:34:34'),
(34, 'UF No. 4', 6, '2023-03-23 12:35:32', '2023-03-23 12:35:32'),
(35, 'UF No. 5', 6, '2023-03-23 12:36:14', '2023-03-23 12:36:14'),
(36, 'UF No. 6', 6, '2023-03-23 12:36:48', '2023-03-23 12:36:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observations`
--

CREATE TABLE `observations` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `question_1` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `question_2` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `question_3` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `net_id` int(11) NOT NULL,
  `main_gate` varchar(1) NOT NULL,
  `order_date` date NOT NULL,
  `admission_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacients`
--

CREATE TABLE `pacients` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lastname` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `contact_phone` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `contact_fullname` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `net_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `main_gate` varchar(1) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `statusAlert` int(11) DEFAULT NULL,
  `isolated` tinyint(4) DEFAULT '0',
  `inmunity_a` tinyint(1) DEFAULT '0',
  `inmunity_b` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `map_lat` decimal(18,15) DEFAULT NULL,
  `map_long` decimal(18,15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pacients`
--

INSERT INTO `pacients` (`id`, `name`, `lastname`, `birthday`, `phone`, `contact_phone`, `contact_fullname`, `address`, `institution_id`, `user_id`, `net_id`, `group_id`, `main_gate`, `status`, `statusAlert`, `isolated`, `inmunity_a`, `inmunity_b`, `created`, `modified`, `map_lat`, `map_long`) VALUES
(1, 'Zunilda', 'Giustetto', '1933-02-08', '3512046200', '3512046200', 'Jose Mateo Giustetto', 'Brown esq. Lagunilla', 1, 9, 1, 1, 'A', 1, NULL, 0, 1, 1, '2023-04-08 00:44:35', '2023-04-25 15:20:49', '-31.385358633912520', '-64.235677567335160'),
(2, 'Paciente', 'Prueba', '1935-07-20', '+5493512121486', '+5493512121486', 'Matías de Anquin', 'Guayaquil 1637', 1, 9, 1, 1, 'A', 2, NULL, 0, 1, 0, '2023-04-08 03:21:22', '2023-05-08 00:35:47', '-31.384808138967300', '-64.238895159289670');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer_profile_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `description`, `referrer_profile_id`, `created`, `modified`) VALUES
(1, 'Administrador', 'Administrador del sistema', NULL, '2023-03-13 21:34:40', '2023-03-13 21:34:40'),
(2, 'Médico coordinador de médicos', 'Coordinación de médicos del centro de salud', NULL, '2023-03-14 12:54:00', '2023-03-14 12:54:00'),
(3, 'Médico coordinador de célula', 'Coordinación de la célula del centro de salud', 2, '2023-03-14 12:54:59', '2023-03-14 12:54:59'),
(4, 'Coordinador de UF', 'Coordinación de la unidad funcional del centro de salud', 3, '2023-03-14 12:55:53', '2023-06-10 19:07:16'),
(5, 'Responsable de nodo', 'Responsable de nodo A o B del centro de salud', 4, '2023-03-14 12:56:49', '2023-06-10 19:07:16'),
(6, 'Operador Táctico', 'Asigna tareas a los agentes sanitarios', 5, '2023-03-14 12:57:51', '2023-06-10 19:07:16'),
(7, 'Agente sanitario', 'Realiza la vacunación y seguimiento de los pacientes', 6, '2023-03-14 12:59:01', '2023-06-10 19:07:16');

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
-- Estructura de tabla para la tabla `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `schedules`
--

INSERT INTO `schedules` (`id`, `description`, `created`, `modified`) VALUES
(1, 'Abastecimiento personal', '2020-04-21 20:31:50', '2020-04-21 21:19:47'),
(2, 'Vacunación', '2020-04-21 20:32:46', '2020-05-09 05:43:36'),
(3, 'Abastecimiento pacientes', '2020-04-21 20:33:55', '2020-04-21 21:20:33'),
(4, 'Llamado telefónico', '2020-04-21 20:34:48', '2020-05-09 05:43:47');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `statesx_days`
--

CREATE TABLE `statesx_days` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `net_id` int(11) NOT NULL,
  `main_gate` varchar(1) DEFAULT NULL,
  `pacient_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_groups`
--

CREATE TABLE `status_groups` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `net_id` int(11) NOT NULL,
  `main_gate` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `inmunity_a` tinyint(1) DEFAULT '0',
  `date_inmunity_a` date DEFAULT NULL,
  `inmunity_b` tinyint(1) DEFAULT '0',
  `date_inmunity_b` date DEFAULT NULL,
  `swabbed` tinyint(1) DEFAULT '0',
  `date_swabbed` date DEFAULT NULL,
  `globulin_m` tinyint(1) DEFAULT '0',
  `date_globulin_m` date DEFAULT NULL,
  `globulin_g` tinyint(1) DEFAULT '0',
  `date_globulin_g` date DEFAULT NULL,
  `polymerase` tinyint(1) DEFAULT '0',
  `date_polymerase` date DEFAULT NULL,
  `infected` tinyint(1) NOT NULL DEFAULT '0',
  `recovered` tinyint(1) NOT NULL DEFAULT '0',
  `dead` tinyint(1) NOT NULL DEFAULT '0',
  `medical_discharge` date DEFAULT NULL,
  `date_group` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `map_lat` decimal(10,8) DEFAULT NULL,
  `map_long` decimal(11,8) DEFAULT NULL,
  `cron` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stocks_users`
--

CREATE TABLE `stocks_users` (
  `id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `net_id` int(11) NOT NULL,
  `main_gate` varchar(1) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplies`
--

CREATE TABLE `supplies` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `supplies`
--

INSERT INTO `supplies` (`id`, `description`, `created`, `modified`) VALUES
(1, 'Barbijo', '2020-04-25 18:29:16', '2020-04-25 18:29:16'),
(2, 'Máscara', '2020-04-25 18:30:03', '2020-04-25 18:30:03'),
(3, 'Spray', '2020-04-25 18:30:48', '2020-04-25 18:30:48'),
(4, 'Guantes', '2020-04-25 18:31:30', '2020-04-25 18:31:30'),
(5, 'Alcohol en gel', '2020-04-25 21:36:14', '2020-04-25 21:36:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turns`
--

CREATE TABLE `turns` (
  `id` int(11) NOT NULL,
  `pacient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `net_id` int(11) NOT NULL,
  `main_gate` varchar(1) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `return_date` date NOT NULL,
  `return_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `profile_id` int(11) NOT NULL DEFAULT '1',
  `referrer_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `image_file_name_url` varchar(1000) DEFAULT NULL,
  `image_file_name` varchar(1000) DEFAULT NULL,
  `image_file_name_filename` varchar(1000) DEFAULT NULL,
  `map_lat` decimal(18,15) DEFAULT NULL,
  `map_long` decimal(18,15) DEFAULT NULL,
  `code` varchar(20) NOT NULL DEFAULT '1234567890',
  `status` int(11) DEFAULT '0',
  `isolated` tinyint(1) DEFAULT '0',
  `token` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `created`, `modified`, `profile_id`, `referrer_id`, `active`, `image_file_name_url`, `image_file_name`, `image_file_name_filename`, `map_lat`, `map_long`, `code`, `status`, `isolated`, `token`) VALUES
(1, 'mdeanquin@gmail.com', '$2y$10$ecLkZ5vOgDts.X65L9ARKehxqeuiP/IzAqB0miUuKOZvRRFZS6C46', 'mdeanquin@gmail.com', 'Matías', 'de Anquin', '2023-03-23 12:01:19', '2023-03-29 13:55:41', 1, NULL, 1, 'https://www.estadoatulado.com.ar/upload/Users/007.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/007.jpg', '007.jpg', NULL, NULL, '1234567890', 0, 0, NULL),
(2, 'mdeanquin2007@hotmail.com', '$2y$10$ojbSkPmOhj1ptk2ZpyYfsOczTC5sdi/izYYWPAijXjRXP5z0AL0ZK', 'mdeanquin2007@hotmail.com', 'Juan Manuel', 'Díaz', '2023-03-23 12:53:51', '2023-03-29 13:56:38', 2, NULL, 1, 'https://www.estadoatulado.com.ar/upload/Users/juan_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/juan_original.jpg', 'juan_original.jpg', NULL, NULL, '1234567890', 0, 0, NULL),
(3, 'cayojcs@gmail.com', '$2y$10$73p1Tioo9uc3y8bS5mRP8eaNyH0PGS5qmbBHcGK3ITZZlMjANwska', 'cayojcs@gmail.com', 'Julio Cesar', 'Sarmiento', '2023-03-23 13:14:49', '2023-04-02 01:15:07', 3, 2, 1, 'https://www.estadoatulado.com.ar/upload/Users/c2c11db8_c9cd_44fd_9c6a_556f2bd7028f_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/c2c11db8_c9cd_44fd_9c6a_556f2bd7028f_original.jpg', 'c2c11db8_c9cd_44fd_9c6a_556f2bd7028f_original.jpg', NULL, NULL, '1234567890', 0, 0, NULL),
(4, 'alejandro.ambrosini@unc.edu.ar', '$2y$10$LHXJASEVrCcHRX5jkAqLP.o.zxJPfDJUnSxC3HXOhBAXXbhzv0JWq', 'alejandro.ambrosini@unc.edu.ar', 'Alejandro', 'Ambrosini', '2023-03-31 16:49:48', '2023-04-02 21:35:19', 4, 3, 1, 'https://www.estadoatulado.com.ar/upload/Users/ale_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/ale_original.jpg', 'ale_original.jpg', '-31.383650007680200', '-64.243868229332920', '1234567890', 0, 0, NULL),
(5, 'ijuri@estadoatulado.com', '$2y$10$L.smLq2JuTHIkVvvz7olxOHesBMwv7qVoYHCsFrnulHDXTJLpsOum', 'ijuri@estadoatulado.com', 'Ignacio', 'Juri', '2023-04-01 15:13:39', '2023-06-11 13:57:21', 5, 4, 1, 'https://www.estadoatulado.com.ar/upload/Users/Ignacio_Jury_Ingeniero_Industrial_VENG_SA_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Ignacio_Jury_Ingeniero_Industrial_VENG_SA_original.jpg', 'Ignacio_Jury_Ingeniero_Industrial_VENG_SA_original.jpg', '-31.384667147393050', '-64.240178147812050', '1234567890', 0, 0, NULL),
(6, 'jppanero@estadoatulado.com', '$2y$10$hkWZnkBIydD5BgiIZlk7EuLUezmknLMGbg8nZGRpYa8ez5wW09l0u', 'jppanero@estadoatulado.com', 'Juan Pablo', 'Panero', '2023-04-01 15:15:29', '2023-04-02 19:22:28', 5, 4, 1, 'https://www.estadoatulado.com.ar/upload/Users/Juan_Pablo_Panero_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Juan_Pablo_Panero_original.jpg', 'Juan_Pablo_Panero_original.jpg', '-31.384034346442153', '-64.236822481359500', '1234567890', 0, 0, NULL),
(7, 'casis@estadoatulado.com', '$2y$10$1MN5RLL2WPeVMIvL6ob.Ie4doClTFmy4LEYxbg66xkK9713K2pMve', 'casis@estadoatulado.com', 'Cecilia', 'Asis', '2023-04-01 19:26:48', '2023-05-31 21:44:00', 6, 5, 1, 'https://www.estadoatulado.com.ar/upload/Users/Cecilia_Asis_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Cecilia_Asis_original.jpg', 'Cecilia_Asis_original.jpg', '-31.384332418062804', '-64.234708849995830', '1234567890', 0, 0, NULL),
(8, 'aruiz@estadoatulado.com', '$2y$10$ipjorwDNhDTShGwZNLprhOt82pQrcpi5Xflc9Csviw0DtDBB/8vgG', 'aruiz@estadoatulado.com', 'Andrea', 'Ruiz', '2023-04-01 19:29:46', '2023-04-02 19:23:34', 6, 6, 1, 'https://www.estadoatulado.com.ar/upload/Users/Ruiz_Knubel_Andrea_Lic_en_Cs_de_la_Comunicacion_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Ruiz_Knubel_Andrea_Lic_en_Cs_de_la_Comunicacion_original.jpg', 'Ruiz_Knubel_Andrea_Lic_en_Cs_de_la_Comunicacion_original.jpg', '-31.387500321281320', '-64.233120861674180', '1234567890', 0, 0, NULL),
(9, 'nmuguiro@estadoatulado.com', '$2y$10$SSg.k8wZggmLk4gH1XtUceKFUvxUvNi3XGL6qxD6.k107tdCTsswa', 'nmuguiro@estadoatulado.com', 'Nestor', 'Muguiro', '2023-04-01 19:36:15', '2023-05-31 21:44:00', 7, 7, 1, 'https://www.estadoatulado.com.ar/upload/Users/Nestor_Muguiro_original.jpeg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Nestor_Muguiro_original.jpeg', 'Nestor_Muguiro_original.jpeg', '-31.384767784009910', '-64.236198172037650', '1234567890', 0, 0, NULL),
(10, 'jbergagna@estadoatulado.com', '$2y$10$2iLKDelvXtyQJrjT5UfBl.EP8p/Nh6dvcTj7eBNjZEf/mLwM9pK66', 'jbergagna@estadoatulado.com', 'Jose', 'Bergagna', '2023-04-01 19:38:57', '2023-04-02 19:24:55', 7, 8, 1, 'https://www.estadoatulado.com.ar/upload/Users/pp_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/pp_original.jpg', 'pp_original.jpg', '-31.383824191615595', '-64.234633824490060', '1234567890', 0, 0, NULL),
(11, 'DrChapatinChespirito@estadoatulado.com', '$2y$10$IoY5kFbdsYXDdfBLI5pq6uUMJNlhrNYIfdVkWYEINoijCBhqYNZ9q', 'DrChapatinChespirito@estadoatulado.com', 'Dr. Chapatin', 'Chespirito', '2023-04-06 00:20:17', '2023-04-06 00:40:39', 4, 3, 0, 'https://www.estadoatulado.com.ar/upload/Users/doctor_chapatin_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/doctor_chapatin_original.jpg', 'doctor_chapatin_original.jpg', '-31.415722752015360', '-64.185682584088180', '1234567890', 0, 0, NULL),
(12, 'DrHouseGregori@estadoatulado.com', '$2y$10$iD8BVkQE9e9ThoytoQbA2u81t8A/wcpFn8K4pC7w953nwkMkIeDCy', 'DrHouseGregori@estadoatulado.com', 'Dr. House', 'Gregori', '2023-04-06 00:24:34', '2023-04-06 00:41:20', 5, 11, 1, 'https://www.estadoatulado.com.ar/upload/Users/Dr_House2_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Dr_House2_original.jpg', 'Dr_House2_original.jpg', '-31.415949179383390', '-64.180215104051780', '1234567890', 0, 0, NULL),
(13, 'DrWilsonJames@estadoatulado.com', '$2y$10$jdrRFLnXzL3qF7PNRcZFt.Fa7nqpXcR4n72FvhyizNAgIYzRBYMj6', 'DrWilsonJames@estadoatulado.com', 'Dr. Wilson', 'James', '2023-04-06 00:27:28', '2023-04-06 00:41:52', 5, 11, 1, 'https://www.estadoatulado.com.ar/upload/Users/dr_wilson_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/dr_wilson_original.jpg', 'dr_wilson_original.jpg', '-31.415518268235658', '-64.177404735517430', '1234567890', 0, 0, NULL),
(14, 'DrMickeyDisney@estadoatulado.com', '$2y$10$IpkV40kQZ5F.oCNtm3FHI.V6zXQyE0T6DAWU34/7XDsiB0uvAcTmC', 'DrMickeyDisney@estadoatulado.com', 'Dr. Mickey', 'Disney', '2023-04-06 00:31:00', '2023-04-06 00:42:29', 6, 12, 1, 'https://www.estadoatulado.com.ar/upload/Users/Dr_Mickey_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Dr_Mickey_original.jpg', 'Dr_Mickey_original.jpg', '-31.416753547374060', '-64.179646442918710', '1234567890', 0, 0, NULL),
(15, 'DrDolittleChiflado@estadoatulado.com', '$2y$10$2Z3PLfXuXB76H/S1eAVd9ul8YAQg8U4mp.wekG2wC8SZylZwKm1vi', 'DrDolittleChiflado@estadoatulado.com', 'Dr. Dolittle', 'Chiflado', '2023-04-06 00:34:22', '2023-04-06 00:43:19', 6, 13, 1, 'https://www.estadoatulado.com.ar/upload/Users/Dr_Dolittle_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Dr_Dolittle_original.jpg', 'Dr_Dolittle_original.jpg', '-31.415948791155560', '-64.177951319643210', '1234567890', 0, 0, NULL),
(16, 'profesorjirafalesC2UF1@estadoatulado.com', '$2y$10$prL5MXxU4lOViplCK6OelOcxyMFWKBcK3pOlQkgD1Jo1lFnND8eYG', 'profesorjirafalesC2UF1@estadoatulado.com', 'Profesor', 'Jirafales', '2023-04-06 00:37:08', '2023-04-06 00:43:58', 7, 14, 1, 'https://www.estadoatulado.com.ar/upload/Users/ProfesorJirafales_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/ProfesorJirafales_original.jpg', 'ProfesorJirafales_original.jpg', '-31.418972120831320', '-64.178629162549770', '1234567890', 0, 0, NULL),
(17, 'Charles_Ingalls_C2UF2@estadoatulado.com', '$2y$10$f91RUbcCu.NxGvRbydTqdej1hakBKWumR7WdY7Zmkz29TCZ3l0u.G', 'Charles_Ingalls_C2UF2@estadoatulado.com', 'Charles', 'Ingalls', '2023-04-06 00:39:45', '2023-04-14 15:12:26', 7, 15, 1, 'https://www.estadoatulado.com.ar/upload/Users/Charle_Ingalls_original.jpg', '/home/o12mg0png743/public_html/estadoatulado.com.ar/webroot/upload/Users/Charle_Ingalls_original.jpg', 'Charle_Ingalls_original.jpg', '-31.417171411396033', '-64.183555841445940', '1234567890', 0, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acl_phinxlog`
--
ALTER TABLE `acl_phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `acos`
--
ALTER TABLE `acos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`,`rght`),
  ADD KEY `alias` (`alias`);

--
-- Indices de la tabla `aros`
--
ALTER TABLE `aros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lft` (`lft`,`rght`),
  ADD KEY `alias` (`alias`);

--
-- Indices de la tabla `aros_acos`
--
ALTER TABLE `aros_acos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aro_id` (`aro_id`,`aco_id`),
  ADD KEY `aco_id` (`aco_id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `events_users`
--
ALTER TABLE `events_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `groups_users`
--
ALTER TABLE `groups_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nets`
--
ALTER TABLE `nets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacients`
--
ALTER TABLE `pacients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profiles_gates`
--
ALTER TABLE `profiles_gates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `schedules`
--
ALTER TABLE `schedules`
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
-- Indices de la tabla `statesx_days`
--
ALTER TABLE `statesx_days`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status_groups`
--
ALTER TABLE `status_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `stocks_users`
--
ALTER TABLE `stocks_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turns`
--
ALTER TABLE `turns`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acos`
--
ALTER TABLE `acos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `aros`
--
ALTER TABLE `aros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `aros_acos`
--
ALTER TABLE `aros_acos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events_users`
--
ALTER TABLE `events_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `groups_users`
--
ALTER TABLE `groups_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nets`
--
ALTER TABLE `nets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `observations`
--
ALTER TABLE `observations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacients`
--
ALTER TABLE `pacients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `profiles_gates`
--
ALTER TABLE `profiles_gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

--
-- AUTO_INCREMENT de la tabla `statesx_days`
--
ALTER TABLE `statesx_days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_groups`
--
ALTER TABLE `status_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `stocks_users`
--
ALTER TABLE `stocks_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turns`
--
ALTER TABLE `turns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
