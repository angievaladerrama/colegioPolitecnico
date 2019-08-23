-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-08-2019 a las 21:28:31
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `estudiante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(55) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `direccion` text,
  `acudiente` varchar(255) DEFAULT NULL,
  `telefonoAcudiente` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `identificacion`, `nombre`, `apellidos`, `email`, `password`, `role`, `direccion`, `acudiente`, `telefonoAcudiente`, `image`) VALUES
(10, '10546515', 'sofia', 'Aranguren', 'sofia@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '1', 'edificio real piso 4', 'sebastian Perez', '3124569875', NULL),
(31, '1002464521', 'Yurani', 'Perez', 'yurani@gmai.com', '9cd656169600157ec17231dcf0613c94932efcdc', '1', 'calle 4 32a', 'marta', '3124569875', '1566475323-data-mining-adsi.jpg'),
(21, '1002460898', 'Angie Paola', 'Valderrrama Cely', 'sara27@gmail.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', '0', 'kra 3 n 12 -29', 'Jose Perez', '31254789366', '1566315355-data-mining-adsi.jpg'),
(30, '100237850', 'Angela', 'corredor', 'pepe07@gmail.com', '255f53c62ddcd8771941fe7fc3d316761f204966', '0', 'iuehfej', 'Jose Perez', '3124569875', '1566473903-data-mining-adsi.jpg'),
(26, '1055346788', 'Juan Sebastian ', 'floresb', 'sara27@gmail.com', '17794e78629e28f1b1936ac746e26fc655e5c924', '0', 'calle 21 -23', 'Sofia', '3456987822', '1566384527-contactenos.jpg'),
(32, '1002346854', 'jonathan', 'corredor', 'jonathan@gmail.com', '23d026bcf5368f936b6e51248b24f518ed23c938', '0', 'jhvjkknklkl', 'Sofia', '31456896521', '1566475609-data-mining-adsi.jpg'),
(33, '1485278687', 'juan', 'cely', 'sofia233434@gmail.com', 'e956b5c6d75e1013a2f94ffe73a2f55c57606699', '0', 'rgdrgdr8245', 'wefd', '46576575675', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
