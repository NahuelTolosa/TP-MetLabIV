-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2021 a las 16:38:19
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbutn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `idCompany` int(11) NOT NULL,
  `name` char(30) DEFAULT NULL,
  `cuit` bigint(20) DEFAULT NULL,
  `phoneNumer` bigint(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `joboffers`
--

CREATE TABLE `joboffers` (
  `offerID` varchar(20) NOT NULL,
  `tittle` varchar(20) DEFAULT NULL,
  `idCompany` int(11) DEFAULT NULL,
  `creationDate` char(15) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `salary` char(10) DEFAULT NULL,
  `workDay` char(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `reference` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `joboffers`
--

INSERT INTO `joboffers` (`offerID`, `tittle`, `idCompany`, `creationDate`, `description`, `salary`, `workDay`, `active`, `reference`) VALUES
('JO366375Q', 'worstu empresa', 527690, '06-11-2021', '', '230000', 'Full-Time', 0, 0),
('JO682018F', 'pirulo', 366170, '06-11-2021', 'sdfsdfds', '-15156', 'Part-Time', 0, 11),
('JO863682T', 'asdempresa', 527690, '06-11-2021', ' asfafa', '230000', 'Part-Time', 0, 0),
('JO994779Y', '1', 123456, '06-11-2021', '', '0', 'Part-Time', 0, 1),
('JO996990W', 'titulo', 123456, '05-11-2021', 'asfsafa', '01312', 'Part-Time', 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulations`
--

CREATE TABLE `postulations` (
  `idPostulations` int(11) NOT NULL,
  `idUser` varchar(20) DEFAULT NULL,
  `idJobOffer` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `postulations`
--

INSERT INTO `postulations` (`idPostulations`, `idUser`, `idJobOffer`) VALUES
(14, 'ST1D', 'JO994779Y'),
(16, 'ST2D', 'JO366375Q');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resetpassword`
--

CREATE TABLE `resetpassword` (
  `idResetPw` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `repeatPassword` varchar(50) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `userName` varchar(40) DEFAULT NULL,
  `userPassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `userName`, `userPassword`) VALUES
('AD1A', 'admin@utn.com', 'admin'),
('ST1D', 'orpianesi.mar@gmail.com', '3'),
('ST2D', 'wlorant1@sbwire.com', '2'),
('ST3H', 'aseemmonds2@upenn.edu', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`idCompany`),
  ADD UNIQUE KEY `unq_cuit` (`cuit`);

--
-- Indices de la tabla `joboffers`
--
ALTER TABLE `joboffers`
  ADD PRIMARY KEY (`offerID`);

--
-- Indices de la tabla `postulations`
--
ALTER TABLE `postulations`
  ADD PRIMARY KEY (`idPostulations`),
  ADD UNIQUE KEY `unq_idUser` (`idUser`),
  ADD KEY `fk_jobOffers` (`idJobOffer`);

--
-- Indices de la tabla `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`idResetPw`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_users` (`userName`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `postulations`
--
ALTER TABLE `postulations`
  MODIFY `idPostulations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `idResetPw` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `postulations`
--
ALTER TABLE `postulations`
  ADD CONSTRAINT `fk_jobOffers` FOREIGN KEY (`idJobOffer`) REFERENCES `joboffers` (`offerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
