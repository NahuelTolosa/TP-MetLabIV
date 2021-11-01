-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2021 a las 23:44:15
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

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
-- Estructura de tabla para la tabla `joboffers`
--

CREATE TABLE `joboffers` (
  `offerID` int(11) NOT NULL,
  `tittle` varchar(20) DEFAULT NULL,
  `idCompany` int(11) DEFAULT NULL,
  `creationDate` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `workDay` char(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `reference` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulations`
--

CREATE TABLE `postulations` (
  `idPostulations` int(11) NOT NULL,
  `idUser` varchar(20) DEFAULT NULL,
  `idJobOffer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Índices para tablas volcadas
--

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
  ADD CONSTRAINT `fk_jobOffers` FOREIGN KEY (`idJobOffer`) REFERENCES `joboffers` (`offerID`),
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
