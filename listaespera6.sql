-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2016 a las 09:36:41
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `listaespera6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1447366308),
('administrator', '2', 1447366383),
('superuser', '3', 1447366388);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, NULL, NULL, 1447366308, 1447366308),
('superuser', 1, NULL, NULL, NULL, 1447366388, 1447366388);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('superuser', 'administrator');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
`id` int(11) NOT NULL,
  `max_subject_regular` int(11) NOT NULL,
  `max_subject_extraordinary` int(11) NOT NULL,
  `instructions_before_open` text COLLATE utf8_unicode_ci NOT NULL,
  `instructions_while_open` text COLLATE utf8_unicode_ci NOT NULL,
  `instructions_after_close` text COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_msg` text COLLATE utf8_unicode_ci NOT NULL,
  `date_open` datetime NOT NULL,
  `date_close` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuration`
--

INSERT INTO `configuration` (`id`, `max_subject_regular`, `max_subject_extraordinary`, `instructions_before_open`, `instructions_while_open`, `instructions_after_close`, `confirmation_msg`, `date_open`, `date_close`) VALUES
(1, 3, 1, '<p><strong>[Mensaje Antes]</strong> El sistema se abrir&aacute; al medio d&iacute;<em>a de...</em></p>', '<p><strong>[Mensaje Durante]</strong> Inicia con tu cuenta de inet, selecciona tus datos y las materias que deseas...</p>', '<p><strong>[Mensaje Despu&eacute;s]&nbsp;</strong>El tiempo para registrarse a la lista de espera de asignaturas ha terminado.</p>\r\n<p>&nbsp;Ya no es posible cargar asignaturas.</p>', '<p>Aseg&uacute;rate de estar pendiente a la lista final de las materias que acabas de solicitar.&nbsp;</p>\r\n<p>Este mensaje se puede cambiar dentro de la configuraci&oacute;n del sistema.</p>', '2016-05-15 10:45:00', '2016-05-20 14:10:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculum`
--

CREATE TABLE IF NOT EXISTS `curriculum` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curriculum`
--

INSERT INTO `curriculum` (`id`, `name`, `short_name`) VALUES
(1, 'Licenciatura en Ingeniería de Software', 'LIS'),
(2, 'Licenciatura en Ingeniería de Computación', 'LIC'),
(3, 'Licenciatura en Ciencias de la Computación', 'LCC'),
(4, 'Licenciatura en Actuaría', 'LA'),
(5, 'Licenciatura en Enseñanza de las Matemáticas', 'LEM'),
(6, 'Licenciatura en Matemáticas', 'LM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1447360855),
('m140506_102106_rbac_init', 1447361113);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
`id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `modality` int(10) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `model` int(10) unsigned NOT NULL,
  `curriculum_id` int(10) unsigned NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`user_id`, `first_name`, `last_name`, `student_id`, `model`, `curriculum_id`, `phone`) VALUES
(1, 'Víctor Julián', 'Sosa Baeza', '12216345', 1, 1, '1234'),
(2, 'Daniel Alejandro', 'Gamboa Frayre', '08003008', 0, 2, ''),
(3, 'Rodrigo', 'Esparza Sánchez', '97001068', 1, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `teacher` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule` varchar(135) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classroom` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `educational_model` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `auth_key`, `access_token`) VALUES
(1, 'victor', '$2y$13$fEi4oRsLYImm/A68vNtQ3O3wbo50oA2G/aadQYvr5GEEEDAugF8Vu', 'TR4cuXssSqx61tIMugDwdP9BknfHBDHl', 'Q_CkAPn515Z16dzlfD9z0QrrU2TyVBCY'),
(2, 'daniel', '$2y$13$a/x7po6d.vpFqvt5nCuNPeFN//4ld6GAjBpjqwDOJrc0ZW9x2eRAm', 'vovrPkF_11lVlEOoK_zrByGln56780aD', '__e7zP5jbKrkLTXsNA_W0_27cX6MeQYj'),
(3, 'super', '$2y$13$UE8HU.60BmEp6dqX48OFZ.jB3aBjbtwRbt3P8xVMArlEoEMFX2xcS', 'MhVCFR-16FVajcY4z8uvLht28x8i9bOC', 'VOCUdwuDCE7JCCF014rXBkyAa5y1X9Bw');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `configuration`
--
ALTER TABLE `configuration`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curriculum`
--
ALTER TABLE `curriculum`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`id`), ADD KEY `subject_index` (`subject_id`), ADD KEY `student_index` (`student_id`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`user_id`), ADD KEY `curriculum_id` (`curriculum_id`);

--
-- Indices de la tabla `subject`
--
ALTER TABLE `subject`
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
-- AUTO_INCREMENT de la tabla `configuration`
--
ALTER TABLE `configuration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `curriculum`
--
ALTER TABLE `curriculum`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `registration`
--
ALTER TABLE `registration`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `subject`
--
ALTER TABLE `subject`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registration`
--
ALTER TABLE `registration`
ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
