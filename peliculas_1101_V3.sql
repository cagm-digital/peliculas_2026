-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-05-2026 a las 13:43:13
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `peliculas_1101`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id`, `genero`) VALUES
(1, 'PROGRAMACION'),
(2, 'DOCUMENTAL'),
(3, 'OTRO'),
(4, 'ACCION'),
(5, 'DRAMA'),
(6, 'COMEDIA'),
(7, 'ROMANCE'),
(8, 'ANIMADO'),
(11, 'BIOPIC'),
(21, 'TERROR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

DROP TABLE IF EXISTS `idioma`;
CREATE TABLE IF NOT EXISTS `idioma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idioma` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`id`, `idioma`) VALUES
(1, 'ESPANOL'),
(2, 'INGLES'),
(3, 'FRANCES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

DROP TABLE IF EXISTS `pelicula`;
CREATE TABLE IF NOT EXISTS `pelicula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `director` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `anio` year(4) NOT NULL,
  `duracion` time NOT NULL,
  `imagen` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pelicula_genero` (`id_genero`),
  KEY `pelicula_idioma` (`id_idioma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `nombre`, `director`, `id_genero`, `id_idioma`, `anio`, `duracion`, `imagen`, `descripcion`) VALUES
(1, 'EL PROGRAMADOR', 'BILL GATES', 2, 1, 2026, '22:06:43', 'https://www.polisura.edu.co/wp-content/uploads/2025/03/conocimientos-tecnicos.jpg', 'Documental sobre la programacion.'),
(2, 'El diario de un ciclista', 'NAIRO QUINTANA', 3, 1, 2024, '22:12:58', 'https://estaticos.elcolombiano.com/binrepository/848x566/68c0/780d565/none/11101/NRMY/no-es-un-ciclista_50464455_20260426174709.jpg', 'Pelicula de ciclismo y la consagracion por el sacrificio deportivo y el valor de la disciplina.'),
(3, 'BARBIE LA PELICULA', 'STAN SMITH', 6, 2, 2005, '12:21:20', 'https://thumbs.dreamstime.com/b/retrato-de-la-mu%C3%B1eca-rubia-barbie-contra-fondo-rosado-tambov-federaci%C3%B3n-rusa-noviembre-tiro-del-estudio-139629564.jpg', 'PELICULA DE LA MUÃ‘ECA MAS FAMOSA'),
(4, 'TITANIC', 'JAMES CAMERON', 7, 1, 1997, '03:14:22', 'https://upload.wikimedia.org/wikipedia/commons/d/d7/Sea_Trials_of_RMS_Titanic%2C_2nd_of_April_1912.jpg', 'Jack es un joven artista que gana un pasaje para viajar a AmÃ©rica en el Titanic, el transatlÃ¡ntico mÃ¡s grande y seguro jamÃ¡s construido. A bordo del buque conoce a Rose, una chica de clase alta que viaja con su madre y su prometido Cal, un millonario engreÃ­do a quien solo interesa el prestigio de la familia de su prometida. Jack y Rose se enamoran a pesar de las trabas que ponen la madre de ella y Cal en su relaciÃ³n. Mientras, el lujoso transatlÃ¡ntico se acerca a un inmenso iceberg.'),
(5, 'INCEPTION', 'CHRISTOPHER NOLAN', 2, 2, 2010, '01:48:00', 'https://i.blogs.es/bd4671/origen-inception-nolan-pelicula/1366_2000.jpg', 'Un ladrón que roba secretos corporativos a través del uso de la tecnología de compartir sueños.'),
(6, 'MARIO BROS', 'AARON HORVATH', 8, 1, 2023, '01:20:00', 'https://media.es.wired.com/photos/64381d70f381a957088482d6/16:9/w_1600,c_limit/Super-Mario-Bros-Movie-Success-Is-Impossible-To-Replicate-Culture-2530_T2_00041.jpg', 'Super Mario Bros.: La PelÃ­cula (2023) es una adaptaciÃ³n animada espectacular y vibrante producida por Illumination y Nintendo. Destaca por su fidelidad al material original, repleta de referencias (\"fan service\") y una animaciÃ³n de alta calidad, convirtiÃ©ndola en una experiencia divertida y nostÃ¡lgica para fans, aunque con una trama sencilla.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `perfil`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'EDITOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(32) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_perfil` (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `clave`, `id_perfil`) VALUES
(100, 'CESAR GONZALEZ', '1234', 1),
(200, 'MARISOL CASAS', '1234', 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_genero` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pelicula_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
