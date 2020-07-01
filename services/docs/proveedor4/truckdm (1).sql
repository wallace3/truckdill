-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2020 a las 00:48:03
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `truckdm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

CREATE TABLE `document` (
  `ID_Document` int(11) NOT NULL,
  `ID_Supplier` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `Url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `ID_Invoice` int(11) NOT NULL,
  `Amount` double DEFAULT NULL,
  `Date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `Status` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments_to_supplier`
--

CREATE TABLE `payments_to_supplier` (
  `ID_Payment` int(11) NOT NULL,
  `ID_Supplier` int(11) DEFAULT NULL,
  `ID_Invoice` int(11) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `Date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `ID_Service` int(11) NOT NULL,
  `Service` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_products`
--

CREATE TABLE `service_products` (
  `ID_Service_Products` int(11) NOT NULL,
  `ID_Service` int(11) DEFAULT NULL,
  `Product` varchar(255) DEFAULT NULL,
  `Cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `ID_Supplier` int(11) NOT NULL,
  `ID_User` int(11) DEFAULT NULL,
  `Supplier` varchar(200) NOT NULL,
  `Rfc` varchar(20) NOT NULL,
  `Legal` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `suppliers`
--

INSERT INTO `suppliers` (`ID_Supplier`, `ID_User`, `Supplier`, `Rfc`, `Legal`) VALUES
(1, 3, 'Salud644', 'HEBE9008067Q2', 'Edgar Hernandez'),
(2, NULL, 'Higiene', 'HEBE9008067Q2GB', 'Saul Valles'),
(3, NULL, 'Higiene', 'HEBE9008067Q2GB', 'Saul Valles'),
(4, 4, 'Higiene', 'HEBE9008067Q2GB', 'Saul Valles'),
(5, 5, 'Salud Higiene bucsl', 'HEBE67008066GB', 'Jorge Elias Hernandez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers_has_services`
--

CREATE TABLE `suppliers_has_services` (
  `ID_Has_Service` int(11) NOT NULL,
  `ID_Supplier` int(11) DEFAULT NULL,
  `ID_Service` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers_services`
--

CREATE TABLE `suppliers_services` (
  `ID_Service` int(11) NOT NULL,
  `Service` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_User` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `ID_Type` int(11) DEFAULT NULL,
  `Status` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_User`, `Username`, `Password`, `Email`, `ID_Type`, `Status`) VALUES
(1, 'edgar', '99800b85d3383e3a2fb45eb7d0066a4879a9dad0', 'edgar@gmail.com', 1, 2),
(2, 'proveedor', '99800b85d3383e3a2fb45eb7d0066a4879a9dad0', NULL, 4, 1),
(3, 'proveedor4', '5176ba4b4a316b10474a234240fe5eda454996a0', 'proveedo2r@gmail.com', 4, 1),
(4, 'Proveedor Saul', '99800b85d3383e3a2fb45eb7d0066a4879a9dad0', 'proveedor@gmail.com', 4, 1),
(5, 'Proveedor Jorge3', '99800b85d3383e3a2fb45eb7d0066a4879a9dad0', 'jorge2@gmail.com', 4, 1),
(6, 'admin', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'admin@admin.com', 1, 1),
(7, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', 1, 1),
(8, 'residente', '263de2a612cd286a2dc360f74896aee24c5eec6b', 'residente@res.com', 3, 1),
(9, 'gerente', 'e0ffb90b074691c42ebd7b3cc39771b344c0083b', 'gerente@ger.com', 2, 1),
(10, 'gerente', 'e0ffb90b074691c42ebd7b3cc39771b344c0083b', 'gerente@ger.com', 2, 1),
(11, 'gerente', 'e0ffb90b074691c42ebd7b3cc39771b344c0083b', 'gerente@ger.com', 2, 1),
(12, 'otro', 'a1da106dfc67e74b885d8ae72de62d41ce5278cc', 'otro@otro.com', 1, 1),
(13, 'otro', 'a1da106dfc67e74b885d8ae72de62d41ce5278cc', 'otro@otro.com', 1, 1),
(14, 'm', '6b0d31c0d563223024da45691584643ac78c96e8', 'm@m.com', 2, 1),
(15, 'ningun', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'prueba@preba.com', 2, 1),
(16, '', '', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_types`
--

CREATE TABLE `user_types` (
  `ID_Type` int(11) NOT NULL,
  `Type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_types`
--

INSERT INTO `user_types` (`ID_Type`, `Type`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Residente'),
(4, 'Proveedor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`ID_Document`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID_Invoice`);

--
-- Indices de la tabla `payments_to_supplier`
--
ALTER TABLE `payments_to_supplier`
  ADD PRIMARY KEY (`ID_Payment`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID_Service`);

--
-- Indices de la tabla `service_products`
--
ALTER TABLE `service_products`
  ADD PRIMARY KEY (`ID_Service_Products`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- Indices de la tabla `suppliers_has_services`
--
ALTER TABLE `suppliers_has_services`
  ADD PRIMARY KEY (`ID_Has_Service`);

--
-- Indices de la tabla `suppliers_services`
--
ALTER TABLE `suppliers_services`
  ADD PRIMARY KEY (`ID_Service`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indices de la tabla `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`ID_Type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID_Invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payments_to_supplier`
--
ALTER TABLE `payments_to_supplier`
  MODIFY `ID_Payment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `ID_Service` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `service_products`
--
ALTER TABLE `service_products`
  MODIFY `ID_Service_Products` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `suppliers_has_services`
--
ALTER TABLE `suppliers_has_services`
  MODIFY `ID_Has_Service` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `user_types`
--
ALTER TABLE `user_types`
  MODIFY `ID_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
