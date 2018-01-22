-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-01-2018 a las 05:26:19
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbacsys1`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `documentoidentidad` VARCHAR(50))  NO SQL
SELECT tbempleado.passwordempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbpersona.documentoidentidadpersona=documentoidentidad AND tbempleado.estadoempleado="activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproductores` (IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT, IN `id` INT(11))  NO SQL
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarproductores` ()  BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona FROM tbproductorsocio INNER JOIN tbpersona ON tbproductorsocio.idpersonasocio=tbpersona.idpersona WHERE tbproductorsocio.estadoproductorsocio="activo";
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbahorrosemanal`
--

CREATE TABLE `tbahorrosemanal` (
  `idpersonaahorro` int(11) NOT NULL,
  `idahorro` int(11) NOT NULL,
  `montoahorrosemanalporlitro` double NOT NULL,
  `litrosentregadosahorrosemanal` double NOT NULL,
  `fechaentregapago` date NOT NULL,
  `estadoahorrosemanal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientedetallista`
--

CREATE TABLE `tbclientedetallista` (
  `idpersonadetallista` int(11) NOT NULL,
  `estadoclientedetallista` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclientemayorista`
--

CREATE TABLE `tbclientemayorista` (
  `idpersonamayorista` int(11) NOT NULL,
  `estadoclientemayorista` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcobrovacaseca`
--

CREATE TABLE `tbcobrovacaseca` (
  `idcobrovacaseca` int(11) NOT NULL,
  `montocobrovacaseca` double NOT NULL,
  `fechacobrovacaseca` date NOT NULL,
  `estadocobrovacaseca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcompramateriaprima`
--

CREATE TABLE `tbcompramateriaprima` (
  `idcompramateriaprima` int(11) NOT NULL,
  `cantidadlitroscompramateriaprima` double NOT NULL,
  `montopagolitro` double NOT NULL,
  `totalpagarlitros` double NOT NULL,
  `fechacompramateriaprima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcuentabancaria`
--

CREATE TABLE `tbcuentabancaria` (
  `idpersonacuenta` int(11) NOT NULL,
  `numerocuentabancaria` text NOT NULL,
  `entidadcuentabancaria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcuotavacaseca`
--

CREATE TABLE `tbcuotavacaseca` (
  `idcuotavacaseca` int(11) NOT NULL,
  `montocuotavacaseca` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdetalleventa`
--

CREATE TABLE `tbdetalleventa` (
  `iddetalleventa` int(11) NOT NULL,
  `preciounitariodetalleventa` double NOT NULL,
  `cantidaddetalleventa` double NOT NULL,
  `subtotaldetalleventa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbempleado`
--

CREATE TABLE `tbempleado` (
  `idpersonaempleado` int(11) NOT NULL,
  `passwordempleado` text NOT NULL,
  `tipoempleado` text NOT NULL,
  `imagentitulomanipulacionalimentosempleado` text,
  `imagendocumentoidentidadempleado` text,
  `estadoempleado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbempleado`
--

INSERT INTO `tbempleado` (`idpersonaempleado`, `passwordempleado`, `tipoempleado`, `imagentitulomanipulacionalimentosempleado`, `imagendocumentoidentidadempleado`, `estadoempleado`) VALUES
(1, '$2y$10$PXqIWhFC1PlthoIhvJHL7.8da7cBhjdZg0jZh/KcfCrBxrx0J31jm', '', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfuncion`
--

CREATE TABLE `tbfuncion` (
  `idfuncion` int(11) NOT NULL,
  `nombrefuncion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimpuestoventa`
--

CREATE TABLE `tbimpuestoventa` (
  `idimpuestoventa` int(11) NOT NULL,
  `montoimpuestoventa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbjuntadirectiva`
--

CREATE TABLE `tbjuntadirectiva` (
  `idjuntadirectiva` int(11) NOT NULL,
  `fechainicioperiodo` date NOT NULL,
  `fechafinalperiodo` date NOT NULL,
  `presidente` text NOT NULL,
  `vicepresidente` text NOT NULL,
  `secretario` text NOT NULL,
  `tesorero` text NOT NULL,
  `fiscal` text NOT NULL,
  `vocal1` text NOT NULL,
  `vocal2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpagoprestamo`
--

CREATE TABLE `tbpagoprestamo` (
  `idpagoprestamo` int(11) NOT NULL,
  `idprestamoporcobrar` int(11) NOT NULL,
  `saldoanteriorpagopretsamo` double NOT NULL,
  `saldoactualpagoprestamo` double NOT NULL,
  `montocuotapagoprestamo` double NOT NULL,
  `fechapagoprestamo` date NOT NULL,
  `horapagoprestamo` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpagoventa`
--

CREATE TABLE `tbpagoventa` (
  `idpagoventa` int(11) NOT NULL,
  `idventaporcobrar` int(11) NOT NULL,
  `saldoanteriorpagoventa` double NOT NULL,
  `saldoactualpagoventa` double NOT NULL,
  `montocuotapagoventa` double NOT NULL,
  `fechapagoventa` date NOT NULL,
  `horapagoventa` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbperiodopagoprestamo`
--

CREATE TABLE `tbperiodopagoprestamo` (
  `idperiodopagoprestamo` int(11) NOT NULL,
  `tipopagoprestamo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpersona`
--

CREATE TABLE `tbpersona` (
  `idpersona` int(11) NOT NULL,
  `documentoidentidadpersona` varchar(30) NOT NULL,
  `nombrepersona` text NOT NULL,
  `apellido1persona` text NOT NULL,
  `apellido2persona` text NOT NULL,
  `telefonopersona` varchar(15) NOT NULL,
  `direccionpersona` text NOT NULL,
  `correopersona` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbpersona`
--

INSERT INTO `tbpersona` (`idpersona`, `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona`, `direccionpersona`, `correopersona`) VALUES
(1, '402060267', 'Nathalia', 'Ovares', 'Vindas', '87539494', 'San Pablo', 'nathy@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpesalechediario`
--

CREATE TABLE `tbpesalechediario` (
  `idpersonalechediario` int(11) NOT NULL,
  `idpesalechediario` int(11) NOT NULL,
  `fechaentregalechediario` date NOT NULL,
  `turnopesolechediario` text NOT NULL,
  `pesoturno` double NOT NULL,
  `estadopesalechediario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpreciolitroleche`
--

CREATE TABLE `tbpreciolitroleche` (
  `idpreciolitroleche` int(11) NOT NULL,
  `preciolitroleche` double NOT NULL,
  `fechainicio` date NOT NULL,
  `estadopreciolitroleche` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprestamos`
--

CREATE TABLE `tbprestamos` (
  `idprestamo` int(11) NOT NULL,
  `idpersonaprestamo` int(11) NOT NULL,
  `tasainteres` double NOT NULL,
  `montototalprestamo` double NOT NULL,
  `montocuota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprestamosporcobrar`
--

CREATE TABLE `tbprestamosporcobrar` (
  `idprestamoporcobrar` int(11) NOT NULL,
  `idprestamo` int(11) NOT NULL,
  `saldoactualprestamoporcobrar` double NOT NULL,
  `estadoprestamoporcobrar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproceso`
--

CREATE TABLE `tbproceso` (
  `idproceso` int(11) NOT NULL,
  `productoproceso` text,
  `cantidadproceso` double DEFAULT NULL,
  `porcentajegrasalecheproceso` double DEFAULT NULL,
  `lecheenteraproceso` double DEFAULT NULL,
  `lechedescremadaproceso` double DEFAULT NULL,
  `cuajoproceso` double DEFAULT NULL,
  `clorurdecalcioproceso` double DEFAULT NULL,
  `salproceso` double DEFAULT NULL,
  `cultivocodigoproceso` varchar(30) DEFAULT NULL,
  `estabilizadorcodigo` double DEFAULT NULL,
  `colorateproceso` double DEFAULT NULL,
  `cremaproceso1` double DEFAULT NULL,
  `lecheproceso1` double DEFAULT NULL,
  `cremaproceso2` double DEFAULT NULL,
  `lecheproceso2` double DEFAULT NULL,
  `horaproceso` time NOT NULL,
  `fechaproceso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductorcliente`
--

CREATE TABLE `tbproductorcliente` (
  `idpersonacliente` int(11) NOT NULL,
  `ahorroporlitroproductorcliente` double DEFAULT NULL,
  `imagencboproductorcliente` text,
  `imagenexamensangradoproductorcliente` text,
  `imagenescrituraproductorcliente` text,
  `imagenreciboluzproductorcliente` text,
  `imagenrecibaguaproductorcliente` text,
  `imagenexamensolidoproductorcliente` text,
  `imagenplanofincaproductorcliente` text,
  `imagendocumentoidentidadproductorcliente` text,
  `estadoproductorcliente` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductoresvacaseca`
--

CREATE TABLE `tbproductoresvacaseca` (
  `idproductoresvacaseca` int(11) NOT NULL,
  `idproductorsociovacaseca` int(11) NOT NULL,
  `fechainiciovacaseca` date NOT NULL,
  `fechafinalvacaseca` date NOT NULL,
  `estadovacaseca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductorsocio`
--

CREATE TABLE `tbproductorsocio` (
  `idpersonasocio` int(11) NOT NULL,
  `ahorroporlitroproductorsocio` double DEFAULT NULL,
  `imagencboproductorsocio` text,
  `imagenexamensangradoproductorsocio` text,
  `imagenescrituraproductorsocio` text,
  `imagenreciboluzproductorsocio` text,
  `imagenrecibaguaproductorsocio` text,
  `imagenexamensolidoproductorsocio` text,
  `imagenplanofincaproductorsocio` text,
  `imagendocumentoidentidadproductorsocio` text,
  `estadoproductorsocio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbproductorsocio`
--

INSERT INTO `tbproductorsocio` (`idpersonasocio`, `ahorroporlitroproductorsocio`, `imagencboproductorsocio`, `imagenexamensangradoproductorsocio`, `imagenescrituraproductorsocio`, `imagenreciboluzproductorsocio`, `imagenrecibaguaproductorsocio`, `imagenexamensolidoproductorsocio`, `imagenplanofincaproductorsocio`, `imagendocumentoidentidadproductorsocio`, `estadoproductorsocio`) VALUES
(1, 0.26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductoslacteos`
--

CREATE TABLE `tbproductoslacteos` (
  `unidadproductoslacteos` int(11) NOT NULL,
  `codigoproductoslacteos` varchar(50) NOT NULL,
  `nombreproductolacteo` text NOT NULL,
  `preciounitarioproductolacteo` double NOT NULL,
  `cantidadinventarioproductolacteo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductosveterinarios`
--

CREATE TABLE `tbproductosveterinarios` (
  `idproductoveterinario` int(11) NOT NULL,
  `codigoproductoveterinario` text NOT NULL,
  `nombreproductoveterinario` text NOT NULL,
  `descripcionproductoveterinario` text NOT NULL,
  `dosisproductoveterinario` text NOT NULL,
  `diasretencionlecheproductoveterinario` int(11) NOT NULL,
  `viaaplicacionveterinarios` int(11) NOT NULL,
  `funcionveterinarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbtasaprestamo`
--

CREATE TABLE `tbtasaprestamo` (
  `idtasaprestamo` int(11) NOT NULL,
  `montotasaprestamo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbunidades`
--

CREATE TABLE `tbunidades` (
  `idunidad` int(11) NOT NULL,
  `unidad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventa`
--

CREATE TABLE `tbventa` (
  `idventa` int(11) NOT NULL,
  `numerofactura` text NOT NULL,
  `fechaventa` date NOT NULL,
  `horaventa` time NOT NULL,
  `totalbrutoventa` double NOT NULL,
  `totalnetoventa` double NOT NULL,
  `tipoventa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventaporcobrar`
--

CREATE TABLE `tbventaporcobrar` (
  `idventaporcobrar` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `saldoactualventaporcobrar` double NOT NULL,
  `estadoventaporcobrar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbviaaplicacion`
--

CREATE TABLE `tbviaaplicacion` (
  `idviaaplicacion` int(11) NOT NULL,
  `nombreviaaplicacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbahorrosemanal`
--
ALTER TABLE `tbahorrosemanal`
  ADD PRIMARY KEY (`idahorro`),
  ADD KEY `idpersonaahorro` (`idpersonaahorro`);

--
-- Indices de la tabla `tbclientedetallista`
--
ALTER TABLE `tbclientedetallista`
  ADD PRIMARY KEY (`idpersonadetallista`);

--
-- Indices de la tabla `tbclientemayorista`
--
ALTER TABLE `tbclientemayorista`
  ADD PRIMARY KEY (`idpersonamayorista`);

--
-- Indices de la tabla `tbcobrovacaseca`
--
ALTER TABLE `tbcobrovacaseca`
  ADD PRIMARY KEY (`idcobrovacaseca`);

--
-- Indices de la tabla `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  ADD PRIMARY KEY (`idcompramateriaprima`);

--
-- Indices de la tabla `tbcuentabancaria`
--
ALTER TABLE `tbcuentabancaria`
  ADD PRIMARY KEY (`idpersonacuenta`);

--
-- Indices de la tabla `tbcuotavacaseca`
--
ALTER TABLE `tbcuotavacaseca`
  ADD PRIMARY KEY (`idcuotavacaseca`);

--
-- Indices de la tabla `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD PRIMARY KEY (`iddetalleventa`);

--
-- Indices de la tabla `tbempleado`
--
ALTER TABLE `tbempleado`
  ADD PRIMARY KEY (`idpersonaempleado`);

--
-- Indices de la tabla `tbfuncion`
--
ALTER TABLE `tbfuncion`
  ADD PRIMARY KEY (`idfuncion`);

--
-- Indices de la tabla `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`idimpuestoventa`);

--
-- Indices de la tabla `tbjuntadirectiva`
--
ALTER TABLE `tbjuntadirectiva`
  ADD PRIMARY KEY (`idjuntadirectiva`);

--
-- Indices de la tabla `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  ADD PRIMARY KEY (`idpagoprestamo`),
  ADD KEY `idprestamoporcobrar` (`idprestamoporcobrar`);

--
-- Indices de la tabla `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  ADD PRIMARY KEY (`idpagoventa`),
  ADD KEY `idventaporcobrar` (`idventaporcobrar`);

--
-- Indices de la tabla `tbperiodopagoprestamo`
--
ALTER TABLE `tbperiodopagoprestamo`
  ADD PRIMARY KEY (`idperiodopagoprestamo`);

--
-- Indices de la tabla `tbpersona`
--
ALTER TABLE `tbpersona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  ADD PRIMARY KEY (`idpesalechediario`),
  ADD KEY `idpersonalechediario` (`idpersonalechediario`);

--
-- Indices de la tabla `tbpreciolitroleche`
--
ALTER TABLE `tbpreciolitroleche`
  ADD PRIMARY KEY (`idpreciolitroleche`);

--
-- Indices de la tabla `tbprestamos`
--
ALTER TABLE `tbprestamos`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `idpersonaprestamo` (`idpersonaprestamo`);

--
-- Indices de la tabla `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  ADD PRIMARY KEY (`idprestamoporcobrar`),
  ADD KEY `idprestamo` (`idprestamo`);

--
-- Indices de la tabla `tbproceso`
--
ALTER TABLE `tbproceso`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indices de la tabla `tbproductorcliente`
--
ALTER TABLE `tbproductorcliente`
  ADD PRIMARY KEY (`idpersonacliente`);

--
-- Indices de la tabla `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  ADD PRIMARY KEY (`idproductoresvacaseca`),
  ADD KEY `idproductorsociovacaseca` (`idproductorsociovacaseca`);

--
-- Indices de la tabla `tbproductorsocio`
--
ALTER TABLE `tbproductorsocio`
  ADD PRIMARY KEY (`idpersonasocio`);

--
-- Indices de la tabla `tbproductoslacteos`
--
ALTER TABLE `tbproductoslacteos`
  ADD PRIMARY KEY (`codigoproductoslacteos`),
  ADD KEY `unidadproductoslacteos` (`unidadproductoslacteos`);

--
-- Indices de la tabla `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  ADD PRIMARY KEY (`idproductoveterinario`),
  ADD KEY `funcionveterinarios` (`funcionveterinarios`),
  ADD KEY `viaaplicacionveterinarios` (`viaaplicacionveterinarios`);

--
-- Indices de la tabla `tbtasaprestamo`
--
ALTER TABLE `tbtasaprestamo`
  ADD PRIMARY KEY (`idtasaprestamo`);

--
-- Indices de la tabla `tbunidades`
--
ALTER TABLE `tbunidades`
  ADD PRIMARY KEY (`idunidad`);

--
-- Indices de la tabla `tbventa`
--
ALTER TABLE `tbventa`
  ADD PRIMARY KEY (`idventa`);

--
-- Indices de la tabla `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD PRIMARY KEY (`idventaporcobrar`),
  ADD KEY `idventa` (`idventa`);

--
-- Indices de la tabla `tbviaaplicacion`
--
ALTER TABLE `tbviaaplicacion`
  ADD PRIMARY KEY (`idviaaplicacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbahorrosemanal`
--
ALTER TABLE `tbahorrosemanal`
  MODIFY `idahorro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbcobrovacaseca`
--
ALTER TABLE `tbcobrovacaseca`
  MODIFY `idcobrovacaseca` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  MODIFY `idcompramateriaprima` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbcuotavacaseca`
--
ALTER TABLE `tbcuotavacaseca`
  MODIFY `idcuotavacaseca` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbfuncion`
--
ALTER TABLE `tbfuncion`
  MODIFY `idfuncion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbjuntadirectiva`
--
ALTER TABLE `tbjuntadirectiva`
  MODIFY `idjuntadirectiva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  MODIFY `idpagoprestamo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  MODIFY `idpagoventa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbperiodopagoprestamo`
--
ALTER TABLE `tbperiodopagoprestamo`
  MODIFY `idperiodopagoprestamo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbpersona`
--
ALTER TABLE `tbpersona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  MODIFY `idpesalechediario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbpreciolitroleche`
--
ALTER TABLE `tbpreciolitroleche`
  MODIFY `idpreciolitroleche` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbprestamos`
--
ALTER TABLE `tbprestamos`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  MODIFY `idprestamoporcobrar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbproceso`
--
ALTER TABLE `tbproceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  MODIFY `idproductoresvacaseca` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  MODIFY `idproductoveterinario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbtasaprestamo`
--
ALTER TABLE `tbtasaprestamo`
  MODIFY `idtasaprestamo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbunidades`
--
ALTER TABLE `tbunidades`
  MODIFY `idunidad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbventa`
--
ALTER TABLE `tbventa`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  MODIFY `idventaporcobrar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbviaaplicacion`
--
ALTER TABLE `tbviaaplicacion`
  MODIFY `idviaaplicacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbahorrosemanal`
--
ALTER TABLE `tbahorrosemanal`
  ADD CONSTRAINT `tbahorrosemanal_ibfk_1` FOREIGN KEY (`idpersonaahorro`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbclientedetallista`
--
ALTER TABLE `tbclientedetallista`
  ADD CONSTRAINT `tbclientedetallista_ibfk_1` FOREIGN KEY (`idpersonadetallista`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbclientemayorista`
--
ALTER TABLE `tbclientemayorista`
  ADD CONSTRAINT `tbclientemayorista_ibfk_1` FOREIGN KEY (`idpersonamayorista`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbcuentabancaria`
--
ALTER TABLE `tbcuentabancaria`
  ADD CONSTRAINT `tbcuentabancaria_ibfk_1` FOREIGN KEY (`idpersonacuenta`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbempleado`
--
ALTER TABLE `tbempleado`
  ADD CONSTRAINT `tbempleado_ibfk_1` FOREIGN KEY (`idpersonaempleado`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  ADD CONSTRAINT `tbpagoprestamo_ibfk_1` FOREIGN KEY (`idprestamoporcobrar`) REFERENCES `tbprestamosporcobrar` (`idprestamoporcobrar`);

--
-- Filtros para la tabla `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  ADD CONSTRAINT `tbpagoventa_ibfk_1` FOREIGN KEY (`idventaporcobrar`) REFERENCES `tbventaporcobrar` (`idventaporcobrar`);

--
-- Filtros para la tabla `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  ADD CONSTRAINT `tbpesalechediario_ibfk_1` FOREIGN KEY (`idpersonalechediario`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbprestamos`
--
ALTER TABLE `tbprestamos`
  ADD CONSTRAINT `tbprestamos_ibfk_1` FOREIGN KEY (`idpersonaprestamo`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  ADD CONSTRAINT `tbprestamosporcobrar_ibfk_1` FOREIGN KEY (`idprestamo`) REFERENCES `tbprestamos` (`idprestamo`);

--
-- Filtros para la tabla `tbproductorcliente`
--
ALTER TABLE `tbproductorcliente`
  ADD CONSTRAINT `tbproductorcliente_ibfk_1` FOREIGN KEY (`idpersonacliente`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  ADD CONSTRAINT `tbproductoresvacaseca_ibfk_1` FOREIGN KEY (`idproductorsociovacaseca`) REFERENCES `tbproductorsocio` (`idpersonasocio`);

--
-- Filtros para la tabla `tbproductorsocio`
--
ALTER TABLE `tbproductorsocio`
  ADD CONSTRAINT `tbproductorsocio_ibfk_1` FOREIGN KEY (`idpersonasocio`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbproductoslacteos`
--
ALTER TABLE `tbproductoslacteos`
  ADD CONSTRAINT `tbproductoslacteos_ibfk_1` FOREIGN KEY (`unidadproductoslacteos`) REFERENCES `tbunidades` (`idunidad`);

--
-- Filtros para la tabla `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  ADD CONSTRAINT `tbproductosveterinarios_ibfk_1` FOREIGN KEY (`funcionveterinarios`) REFERENCES `tbfuncion` (`idfuncion`),
  ADD CONSTRAINT `tbproductosveterinarios_ibfk_2` FOREIGN KEY (`viaaplicacionveterinarios`) REFERENCES `tbviaaplicacion` (`idviaaplicacion`);

--
-- Filtros para la tabla `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD CONSTRAINT `tbventaporcobrar_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `tbventa` (`idventa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
