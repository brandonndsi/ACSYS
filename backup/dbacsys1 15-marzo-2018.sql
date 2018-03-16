-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2018 at 02:19 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbacsys1`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarRecepcion` (IN `fecha` DATE)  BEGIN
SELECT  tbpersona.idpesona,tbpesalechediario.idpesalechediario, tbpesalechediario.fechaentregalechediario,tbpesalechediario.turnopesolechediario,tbpesalechediario.pesoturno ,tbpersona.nombrepersona, tbpersona.apellido1persona, tbpersona.apellido2persona FROM tbpesalechediario INNER JOIN tbpersona ON tbpesalechediario.idpersonalechediario=tbpersona.idpersona WHERE tbpesalechediario.estadopesalechediario="activo" AND tbpesalechediario.fechaentregalechediario=fecha ORDER BY tbpesalechediario.idpersonalechediario DESC;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarclientemayorista` (IN `id` INT)  NO SQL
BEGIN
UPDATE `tbclientemayorista` SET `estadoclientemayorista`='Inactivo'
WHERE idpersonamayorista=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarempleado` (IN `id` VARCHAR(20))  NO SQL
BEGIN
UPDATE tbempleado set estadoempleado='inactivo' WHERE idpersonaempleado=id AND estadoempleado='activo';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarproductolacteo` (IN `codigo` VARCHAR(50))  BEGIN
UPDATE tbproductoslacteos SET estadoproductoslacteos="inactivo" WHERE codigoproductoslacteos=codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarproductorcliente` (`id` INT)  BEGIN
UPDATE tbproductorcliente SET estadoproductorcliente="inactivo" WHERE idpersonacliente=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarproductorsocio` (IN `id` INT)  BEGIN
UPDATE tbproductorsocio SET estadoproductorsocio="inactivo" WHERE idpersonasocio=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarproductoveterinario` (`codigo` INT)  BEGIN
UPDATE tbproductosveterinarios SET estadoproductoveterinario="inactivo" WHERE codigoproductoveterinario=codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `extraeridpersona` (IN `id` VARCHAR(30))  NO SQL
BEGIN
SELECT `idpersona`FROM `tbpersona` WHERE documentoidentidadpersona=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `documentoidentidad` VARCHAR(50))  NO SQL
SELECT tbempleado.passwordempleado,tbpersona.idpersona,tbpersona.nombrepersona, tbpersona.apellido1persona,tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.correopersona FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbpersona.documentoidentidadpersona=documentoidentidad AND tbempleado.estadoempleado="activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAhorroCliente` (`id` INT, `ahorro` DOUBLE)  BEGIN
UPDATE tbproductorcliente  SET ahorroporlitroproductorcliente=ahorro WHERE idpersonacliente=id AND estadoproductorcliente="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarAhorroSocio` (`id` INT, `ahorro` DOUBLE)  BEGIN
UPDATE tbproductorsocio  SET ahorroporlitroproductorsocio=ahorro WHERE idpersonasocio=id AND estadoproductorsocio="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarcontrasenia` (IN `id` VARCHAR(30), IN `pass` TEXT)  NO SQL
UPDATE tbempleado SET  passwordempleado=pass WHERE idpersonaempleado = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarDistribuidor` (IN `cedula` VARCHAR(30), IN `nombre` VARCHAR(30), IN `apellido1` VARCHAR(30), IN `apellido2` VARCHAR(30), IN `telefono` INT, IN `direccion` VARCHAR(30), IN `correo` VARCHAR(30), IN `id` INT)  NO SQL
BEGIN
UPDATE `tbpersona` SET
`documentoidentidadpersona`=cedula,
`nombrepersona`=nombre,
`apellido1persona`=apellido1,
`apellido2persona`=apellido2,
`telefonopersona`=telefono,
`direccionpersona`=direccion,
`correopersona`=correo 
WHERE idpersona=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarempleadopersona` (IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT, IN `id` INT(11))  NO SQL
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarempleados` (IN `id` VARCHAR(30), IN `clave` VARCHAR(15), IN `tipo` TEXT)  NO SQL
UPDATE tbempleado SET passwordempleado=clave,tipoempleado=tipo
WHERE idpersonaempleado=id and estadoempleado="activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarJuntaDirectiva` (IN `presidente` TEXT, IN `vicepresidente` TEXT, IN `secretario` TEXT, IN `tesorero` TEXT, IN `fiscal` TEXT, IN `vocal1` TEXT, IN `vocal2` TEXT, IN `inicio` DATE, IN `final` DATE, IN `id` VARCHAR(30))  NO SQL
BEGIN
UPDATE tbjuntadirectiva SET presidente=presidente,vicepresidente=vicepresidente,secretario=secretario,tesorero=tesorero,fiscal=fiscal,vocal1=vocal1,vocal2=vocal2,fechainicioperiodo=inicio,fechafinalperiodo=final WHERE idjuntadirectiva = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproductolacteo` (`codigo` VARCHAR(50), `nombre` TEXT, `precio` DOUBLE, `cantidad` DOUBLE, `unidad` INT)  BEGIN
UPDATE tbproductoslacteos SET nombreproductolacteo=nombre,preciounitarioproductolacteo=precio,cantidadinventarioproductolacteo=cantidad,unidadproductoslacteos=unidad WHERE codigoproductoslacteos=codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproductorcliente` (IN `id` INT, IN `nombre` TEXT, IN `cedula` VARCHAR(30), IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT)  NO SQL
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproductores` (IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT, IN `id` INT(11))  NO SQL
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproductoveterinario` (IN `codigo` VARCHAR(50), IN `nombre` TEXT, IN `descripcion` TEXT, IN `dosis` TEXT, IN `dias` INT, IN `via` INT, IN `funcion` INT, IN `precio` DOUBLE)  BEGIN
UPDATE tbproductosveterinarios SET 
nombreproductoveterinario=nombre,descripcionproductoveterinario=descripcion,dosisproductoveterinario=dosis,diasretencionlecheproductoveterinario=dias,viaaplicacionveterinarios=via,funcionveterinarios=funcion,precioproductoveterinario=precio WHERE codigoproductoveterinario=codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarDistribuidor` ()  NO SQL
BEGIN
SELECT * FROM tbpersona p
INNER JOIN tbclientemayorista t  ON t.idpersonamayorista=p.idpersona WHERE t.estadoclientemayorista='activo';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarempleados` ()  NO SQL
BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona, tbempleado.tipoempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbempleado.estadoempleado="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarfunciones` ()  BEGIN
SELECT  tbfuncion.nombrefuncion FROM tbfuncion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarJuntaDirectiva` ()  NO SQL
BEGIN
SELECT tbjuntadirectiva.idjuntadirectiva,tbjuntadirectiva.fechainicioperiodo,tbjuntadirectiva.fechafinalperiodo,tbjuntadirectiva.presidente, tbjuntadirectiva.vicepresidente,tbjuntadirectiva.secretario,tbjuntadirectiva.tesorero,tbjuntadirectiva.fiscal, tbjuntadirectiva.vocal1, tbjuntadirectiva.vocal2 FROM tbjuntadirectiva;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarproductolacteo` ()  BEGIN
SELECT tbproductoslacteos.codigoproductoslacteos,tbproductoslacteos.nombreproductolacteo,tbproductoslacteos.preciounitarioproductolacteo,tbproductoslacteos.cantidadinventarioproductolacteo,tbunidades.unidad FROM tbproductoslacteos INNER JOIN tbunidades ON tbproductoslacteos.unidadproductoslacteos=tbunidades.idunidad WHERE tbproductoslacteos.estadoproductoslacteos="activo";    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarproductores` ()  BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona,tbproductorsocio.ahorroporlitroproductorsocio FROM tbproductorsocio INNER JOIN tbpersona ON tbproductorsocio.idpersonasocio=tbpersona.idpersona WHERE tbproductorsocio.estadoproductorsocio="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarproductoresclientes` ()  BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona,tbproductorcliente.ahorroporlitroproductorcliente FROM tbproductorcliente INNER JOIN tbpersona ON tbproductorcliente.idpersonacliente=tbpersona.idpersona WHERE tbproductorcliente.estadoproductorcliente="activo";    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarproductoveterinario` ()  BEGIN
SELECT  tbproductosveterinarios.codigoproductoveterinario,tbproductosveterinarios.nombreproductoveterinario,tbproductosveterinarios.descripcionproductoveterinario,tbproductosveterinarios.precioproductoveterinario,tbproductosveterinarios.dosisproductoveterinario,tbproductosveterinarios.diasretencionlecheproductoveterinario, tbviaaplicacion.nombreviaaplicacion, tbfuncion.nombrefuncion FROM tbproductosveterinarios INNER JOIN tbviaaplicacion ON tbproductosveterinarios.viaaplicacionveterinarios=tbviaaplicacion.idviaaplicacion INNER JOIN tbfuncion ON tbproductosveterinarios.funcionveterinarios=tbfuncion.idfuncion WHERE tbproductosveterinarios.estadoproductoveterinario="activo";    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarunidades` ()  BEGIN
SELECT  tbunidades.unidad FROM tbunidades;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarvias` ()  BEGIN
SELECT  tbviaaplicacion.nombreviaaplicacion FROM tbviaaplicacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevoclientemayorista` (IN `id` INT, IN `estado` VARCHAR(20))  NO SQL
BEGIN
INSERT INTO `tbclientemayorista`(`idpersonamayorista`, `estadoclientemayorista`) VALUES (id,estado);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempleado` (IN `clave` VARCHAR(30), IN `tipo` TEXT)  NO SQL
INSERT INTO tbempleado(idpersonaempleado,passwordempleado,tipoempleado,estadoempleado) VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1),clave,tipo,"activo")$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarjuntadirectiva` (IN `presidente` TEXT, IN `vicepresidente` TEXT, IN `secretario` TEXT, IN `tesorero` TEXT, IN `fiscal` TEXT, IN `vocal1` TEXT, IN `vocal2` TEXT, IN `inicio` DATE, IN `final` DATE)  NO SQL
INSERT INTO tbjuntadirectiva(presidente, vicepresidente, secretario, tesorero, fiscal, vocal1, vocal2,fechainicioperiodo, fechafinalperiodo) VALUES (presidente,vicepresidente,secretario,tesorero,fiscal,vocal1,vocal2,inicio,final)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarLecheDiaria` (`cliente` INT, `fecha` DATE, `turno` TEXT, `peso` DOUBLE)  BEGIN
INSERT INTO tbpesalechediario (idpersonalechediario,fechaentregalechediario,turnopesolechediario,pesoturno, estadopesalechediario)
VALUES (cliente,fecha,turno,peso,"activo");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarpersona` (IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT)  INSERT INTO tbpersona(documentoidentidadpersona,nombrepersona, apellido1persona,apellido2persona,telefonopersona,direccionpersona,correopersona) VALUES (cedula,nombre,apellido1,apellido2,telefono,direccion,correo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarproductolacteo` (`codigo` VARCHAR(50), `nombre` TEXT, `precio` DOUBLE, `cantidad` DOUBLE, `unidad` INT)  BEGIN
INSERT INTO tbproductoslacteos (codigoproductoslacteos,nombreproductolacteo,preciounitarioproductolacteo,cantidadinventarioproductolacteo,estadoproductoslacteos,unidadproductoslacteos)
VALUES (codigo,nombre,precio,cantidad,"activo",unidad);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarproductorcliente` ()  BEGIN
INSERT INTO tbproductorcliente(idpersonacliente,estadoproductorcliente,ahorroporlitroproductorcliente) VALUES ((SELECT idpersona FROM tbpersona order by idpersona desc limit 1), "activo",0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarproductorsocio` ()  NO SQL
INSERT INTO tbproductorsocio(idpersonasocio,estadoproductorsocio,ahorroporlitroproductorsocio) VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1), "activo",0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarproductoveterinario` (IN `codigo` VARCHAR(50), IN `nombre` TEXT, IN `descripcion` TEXT, IN `dosis` TEXT, IN `dias` INT, IN `via` INT, IN `funcion` INT, IN `precio` DOUBLE)  BEGIN
INSERT INTO tbproductosveterinarios (codigoproductoveterinario,nombreproductoveterinario,descripcionproductoveterinario,	dosisproductoveterinario,diasretencionlecheproductoveterinario,viaaplicacionveterinarios,funcionveterinarios,precioproductoveterinario,estadoproductoveterinario)
VALUES (codigo,nombre,descripcion,dosis,dias,via,funcion,precio,"activo");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchproductveterinario` (`codigo` TEXT)  BEGIN
  SELECT nombreproductoveterinario,precioproductoveterinario FROM tbproductosveterinarios WHERE codigoproductoveterinario=codigo LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verificarturno` (IN `fecha` DATE, IN `turno` TEXT, IN `cliente` INT)  NO SQL
SELECT tbpesalechediario.turnopesolechediario, tbpesalechediario.fechaentregalechediario FROM tbpesalechediario WHERE  tbpesalechediario.fechaentregalechediario=fecha AND tbpesalechediario.turnopesolechediario=turno AND tbpesalechediario.idpersonalechediario=cliente$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbahorrosemanal`
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
-- Table structure for table `tbclientedetallista`
--

CREATE TABLE `tbclientedetallista` (
  `idpersonadetallista` int(11) NOT NULL,
  `estadoclientedetallista` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbclientemayorista`
--

CREATE TABLE `tbclientemayorista` (
  `idpersonamayorista` int(11) NOT NULL,
  `estadoclientemayorista` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbclientemayorista`
--

INSERT INTO `tbclientemayorista` (`idpersonamayorista`, `estadoclientemayorista`) VALUES
(10, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbcobrovacaseca`
--

CREATE TABLE `tbcobrovacaseca` (
  `idcobrovacaseca` int(11) NOT NULL,
  `montocobrovacaseca` double NOT NULL,
  `fechacobrovacaseca` date NOT NULL,
  `estadocobrovacaseca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbcompramateriaprima`
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
-- Table structure for table `tbcuentabancaria`
--

CREATE TABLE `tbcuentabancaria` (
  `idpersonacuenta` int(11) NOT NULL,
  `numerocuentabancaria` text NOT NULL,
  `entidadcuentabancaria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbcuotavacaseca`
--

CREATE TABLE `tbcuotavacaseca` (
  `idcuotavacaseca` int(11) NOT NULL,
  `montocuotavacaseca` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbdetalleventa`
--

CREATE TABLE `tbdetalleventa` (
  `iddetalleventa` int(11) NOT NULL,
  `preciounitariodetalleventa` double NOT NULL,
  `cantidaddetalleventa` double NOT NULL,
  `subtotaldetalleventa` double NOT NULL,
  `codigoproductoslacteos` varchar(50) DEFAULT NULL,
  `descuento` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbdetalleventaveterinaria`
--

CREATE TABLE `tbdetalleventaveterinaria` (
  `iddetalleventa` int(11) NOT NULL,
  `preciounitariodetalleventa` double DEFAULT NULL,
  `cantidaddetalleventa` int(11) DEFAULT NULL,
  `subtotaldetalleventa` double DEFAULT NULL,
  `codigoproductoslacteos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbempleado`
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
-- Dumping data for table `tbempleado`
--

INSERT INTO `tbempleado` (`idpersonaempleado`, `passwordempleado`, `tipoempleado`, `imagentitulomanipulacionalimentosempleado`, `imagendocumentoidentidadempleado`, `estadoempleado`) VALUES
(1, '$2y$10$PXqIWhFC1PlthoIhvJHL7.8da7cBhjdZg0jZh/KcfCrBxrx0J31jm', '', NULL, NULL, 'activo'),
(12, '$2y$10$rbKXQbZ.', 'Bodega', NULL, NULL, 'activo'),
(13, 'undefined', 'Administrador', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbfuncion`
--

CREATE TABLE `tbfuncion` (
  `idfuncion` int(11) NOT NULL,
  `nombrefuncion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbfuncion`
--

INSERT INTO `tbfuncion` (`idfuncion`, `nombrefuncion`) VALUES
(1, 'Analgésicos-Antiinflamatorios'),
(2, 'Antiinfecciosos'),
(3, 'Calmantes'),
(4, 'Antiparasitarios');

-- --------------------------------------------------------

--
-- Table structure for table `tbimpuestoventa`
--

CREATE TABLE `tbimpuestoventa` (
  `idimpuestoventa` int(11) NOT NULL,
  `montoimpuestoventa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbjuntadirectiva`
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

--
-- Dumping data for table `tbjuntadirectiva`
--

INSERT INTO `tbjuntadirectiva` (`idjuntadirectiva`, `fechainicioperiodo`, `fechafinalperiodo`, `presidente`, `vicepresidente`, `secretario`, `tesorero`, `fiscal`, `vocal1`, `vocal2`) VALUES
(1, '2018-02-01', '2018-02-24', 'Kervn', 'Nathalia', 'Lilliam', 'Hector', 'Minor', 'Sergio', 'Olman');

-- --------------------------------------------------------

--
-- Table structure for table `tbpagoprestamo`
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
-- Table structure for table `tbpagoventa`
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
-- Table structure for table `tbperiodopagoprestamo`
--

CREATE TABLE `tbperiodopagoprestamo` (
  `idperiodopagoprestamo` int(11) NOT NULL,
  `tipopagoprestamo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbpersona`
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
-- Dumping data for table `tbpersona`
--

INSERT INTO `tbpersona` (`idpersona`, `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona`, `direccionpersona`, `correopersona`) VALUES
(1, '402060267', 'Nathalia', 'Ovares', 'Vindas', '87539494', 'San Pablo', 'nathy@gmail.com'),
(2, '305020820', 'Kervin', 'Araya', 'Romero', '22345678', 'El Sauce', 'kervin@gmail.com'),
(4, '2345678', 'dsfgh', 'sdfgh', 'sadfg', '4567', 'asdf', 'sdfg'),
(5, '234567890', 'Giorno', 'Giovana', 'Giovana', '2345678', 'Vento', 'gg@gmail.com'),
(6, '2345678934', 'nanita', 'ovarios', 'mevago', '1234567', '23456', 'sdfgh@gmail.com'),
(7, '900570431', 'Marlene', 'Vindas', 'Vindas', '84421444', 'San Pablo', 'N/A'),
(8, '302640297', 'Hector', 'Araya', 'Cordero', '88888888', 'El Sauce', 'N/A'),
(9, '473739927', 'kkskks', 'ksmksds', 'mksmmiad', '8667899', 'sxjjxjx', 'gga@hhd.com'),
(10, '305020820', 'Kervin JosÃ©', 'Araya', 'Romero', '88776655', '', 'ker@gmail.com'),
(12, '33440667', 'Berny', 'Garro', 'Dur&aacute;n', '22768900', 'La Victoria', 'b@gmail.com'),
(13, '302510265', 'Merlin', 'Garcia', 'Villalobos', '87986987', 'Sauce', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `tbpesalechediario`
--

CREATE TABLE `tbpesalechediario` (
  `idpersonalechediario` int(11) NOT NULL,
  `idpesalechediario` int(11) NOT NULL,
  `fechaentregalechediario` date NOT NULL,
  `turnopesolechediario` text NOT NULL,
  `pesoturno` double NOT NULL,
  `estadopesalechediario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbpesalechediario`
--

INSERT INTO `tbpesalechediario` (`idpersonalechediario`, `idpesalechediario`, `fechaentregalechediario`, `turnopesolechediario`, `pesoturno`, `estadopesalechediario`) VALUES
(1, 6, '2018-02-21', 'Mañana', 40, 'activo'),
(1, 7, '2018-02-21', 'Tarde', 40, 'activo'),
(5, 8, '2018-02-21', 'Tarde', 40, 'activo'),
(1, 9, '2018-02-22', 'Mañana', 40, 'activo'),
(1, 10, '2018-03-12', 'Mañana', 38.6, 'activo'),
(1, 11, '2018-03-12', 'Tarde', 38.6, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbpreciolitroleche`
--

CREATE TABLE `tbpreciolitroleche` (
  `idpreciolitroleche` int(11) NOT NULL,
  `preciolitroleche` double NOT NULL,
  `fechainicio` date NOT NULL,
  `estadopreciolitroleche` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbprestamos`
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
-- Table structure for table `tbprestamosporcobrar`
--

CREATE TABLE `tbprestamosporcobrar` (
  `idprestamoporcobrar` int(11) NOT NULL,
  `idprestamo` int(11) NOT NULL,
  `saldoactualprestamoporcobrar` double NOT NULL,
  `estadoprestamoporcobrar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbproceso`
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
-- Table structure for table `tbproductorcliente`
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

--
-- Dumping data for table `tbproductorcliente`
--

INSERT INTO `tbproductorcliente` (`idpersonacliente`, `ahorroporlitroproductorcliente`, `imagencboproductorcliente`, `imagenexamensangradoproductorcliente`, `imagenescrituraproductorcliente`, `imagenreciboluzproductorcliente`, `imagenrecibaguaproductorcliente`, `imagenexamensolidoproductorcliente`, `imagenplanofincaproductorcliente`, `imagendocumentoidentidadproductorcliente`, `estadoproductorcliente`) VALUES
(2, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'inactivo'),
(7, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(8, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbproductoresvacaseca`
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
-- Table structure for table `tbproductorsocio`
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
-- Dumping data for table `tbproductorsocio`
--

INSERT INTO `tbproductorsocio` (`idpersonasocio`, `ahorroporlitroproductorsocio`, `imagencboproductorsocio`, `imagenexamensangradoproductorsocio`, `imagenescrituraproductorsocio`, `imagenreciboluzproductorsocio`, `imagenrecibaguaproductorsocio`, `imagenexamensolidoproductorsocio`, `imagenplanofincaproductorsocio`, `imagendocumentoidentidadproductorsocio`, `estadoproductorsocio`) VALUES
(1, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(4, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'inactivo'),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(6, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(9, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbproductoslacteos`
--

CREATE TABLE `tbproductoslacteos` (
  `unidadproductoslacteos` int(11) NOT NULL,
  `codigoproductoslacteos` varchar(50) NOT NULL,
  `nombreproductolacteo` text NOT NULL,
  `preciounitarioproductolacteo` double NOT NULL,
  `cantidadinventarioproductolacteo` double NOT NULL,
  `estadoproductoslacteos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbproductoslacteos`
--

INSERT INTO `tbproductoslacteos` (`unidadproductoslacteos`, `codigoproductoslacteos`, `nombreproductolacteo`, `preciounitarioproductolacteo`, `cantidadinventarioproductolacteo`, `estadoproductoslacteos`) VALUES
(2, '1234', 'Yogurt PiÃ±a', 1000, 200, 'activo'),
(1, '4390', 'Queso Mozarrella', 4000, 200, 'activo'),
(2, '6790', 'Yogurt fresa', 1000, 200, 'activo'),
(2, '6997', 'Queso Chessar', 4000, 150, 'activo'),
(1, '8658', 'Queso Tierno', 2400, 200, 'inactivo');

-- --------------------------------------------------------

--
-- Table structure for table `tbproductosveterinarios`
--

CREATE TABLE `tbproductosveterinarios` (
  `idproductoveterinario` int(11) NOT NULL,
  `codigoproductoveterinario` text NOT NULL,
  `nombreproductoveterinario` text NOT NULL,
  `descripcionproductoveterinario` text NOT NULL,
  `dosisproductoveterinario` text NOT NULL,
  `diasretencionlecheproductoveterinario` int(11) NOT NULL,
  `viaaplicacionveterinarios` int(11) NOT NULL,
  `funcionveterinarios` int(11) NOT NULL,
  `precioproductoveterinario` double NOT NULL,
  `estadoproductoveterinario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbproductosveterinarios`
--

INSERT INTO `tbproductosveterinarios` (`idproductoveterinario`, `codigoproductoveterinario`, `nombreproductoveterinario`, `descripcionproductoveterinario`, `dosisproductoveterinario`, `diasretencionlecheproductoveterinario`, `viaaplicacionveterinarios`, `funcionveterinarios`, `precioproductoveterinario`, `estadoproductoveterinario`) VALUES
(1, '566788', 'Ectoline', 'Medicamento para parasitos', '1 cc', 0, 3, 2, 5000, 'activo'),
(2, '3456789', 'lolita', 'sirve para curar', '2cc', 2, 2, 3, 400, 'activo'),
(3, '345678', 'GG', 'dfghjk', '300', 0, 2, 2, 0, 'inactivo'),
(7, '344567', 'Paracetamol', 'sirve para el dolor de cabeza', '22 cc', 7, 1, 1, 2500, 'activo'),
(8, '10002', 'Agua Florida', 'Para dolor de nuca', '2 cc', 2, 1, 1, 2500, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbtasaprestamo`
--

CREATE TABLE `tbtasaprestamo` (
  `idtasaprestamo` int(11) NOT NULL,
  `montotasaprestamo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbunidades`
--

CREATE TABLE `tbunidades` (
  `idunidad` int(11) NOT NULL,
  `unidad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbunidades`
--

INSERT INTO `tbunidades` (`idunidad`, `unidad`) VALUES
(1, 'Kilogramos'),
(2, 'Litros'),
(3, 'Gramos');

-- --------------------------------------------------------

--
-- Table structure for table `tbventa`
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
-- Table structure for table `tbventaporcobrar`
--

CREATE TABLE `tbventaporcobrar` (
  `idventaporcobrar` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `saldoactualventaporcobrar` double NOT NULL,
  `estadoventaporcobrar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbviaaplicacion`
--

CREATE TABLE `tbviaaplicacion` (
  `idviaaplicacion` int(11) NOT NULL,
  `nombreviaaplicacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbviaaplicacion`
--

INSERT INTO `tbviaaplicacion` (`idviaaplicacion`, `nombreviaaplicacion`) VALUES
(1, 'Subcútanea'),
(2, 'Intramuscular'),
(3, 'Intravenosa'),
(4, 'Intraruminal'),
(5, 'Intravaginal'),
(6, 'Oral'),
(7, 'Pour on'),
(8, 'Aspersión'),
(9, 'Inmersión'),
(10, 'Intramamaria'),
(11, 'Intrauterina');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbahorrosemanal`
--
ALTER TABLE `tbahorrosemanal`
  ADD PRIMARY KEY (`idahorro`),
  ADD KEY `idpersonaahorro` (`idpersonaahorro`);

--
-- Indexes for table `tbclientedetallista`
--
ALTER TABLE `tbclientedetallista`
  ADD PRIMARY KEY (`idpersonadetallista`);

--
-- Indexes for table `tbclientemayorista`
--
ALTER TABLE `tbclientemayorista`
  ADD PRIMARY KEY (`idpersonamayorista`);

--
-- Indexes for table `tbcobrovacaseca`
--
ALTER TABLE `tbcobrovacaseca`
  ADD PRIMARY KEY (`idcobrovacaseca`);

--
-- Indexes for table `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  ADD PRIMARY KEY (`idcompramateriaprima`);

--
-- Indexes for table `tbcuentabancaria`
--
ALTER TABLE `tbcuentabancaria`
  ADD PRIMARY KEY (`idpersonacuenta`);

--
-- Indexes for table `tbcuotavacaseca`
--
ALTER TABLE `tbcuotavacaseca`
  ADD PRIMARY KEY (`idcuotavacaseca`);

--
-- Indexes for table `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD PRIMARY KEY (`iddetalleventa`),
  ADD KEY `codigoproductoslacteos` (`codigoproductoslacteos`);

--
-- Indexes for table `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  ADD PRIMARY KEY (`iddetalleventa`),
  ADD KEY `codigoproductoslacteos` (`codigoproductoslacteos`);

--
-- Indexes for table `tbempleado`
--
ALTER TABLE `tbempleado`
  ADD PRIMARY KEY (`idpersonaempleado`);

--
-- Indexes for table `tbfuncion`
--
ALTER TABLE `tbfuncion`
  ADD PRIMARY KEY (`idfuncion`);

--
-- Indexes for table `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`idimpuestoventa`);

--
-- Indexes for table `tbjuntadirectiva`
--
ALTER TABLE `tbjuntadirectiva`
  ADD PRIMARY KEY (`idjuntadirectiva`);

--
-- Indexes for table `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  ADD PRIMARY KEY (`idpagoprestamo`),
  ADD KEY `idprestamoporcobrar` (`idprestamoporcobrar`);

--
-- Indexes for table `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  ADD PRIMARY KEY (`idpagoventa`),
  ADD KEY `idventaporcobrar` (`idventaporcobrar`);

--
-- Indexes for table `tbperiodopagoprestamo`
--
ALTER TABLE `tbperiodopagoprestamo`
  ADD PRIMARY KEY (`idperiodopagoprestamo`);

--
-- Indexes for table `tbpersona`
--
ALTER TABLE `tbpersona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indexes for table `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  ADD PRIMARY KEY (`idpesalechediario`),
  ADD KEY `idpersonalechediario` (`idpersonalechediario`);

--
-- Indexes for table `tbpreciolitroleche`
--
ALTER TABLE `tbpreciolitroleche`
  ADD PRIMARY KEY (`idpreciolitroleche`);

--
-- Indexes for table `tbprestamos`
--
ALTER TABLE `tbprestamos`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `idpersonaprestamo` (`idpersonaprestamo`);

--
-- Indexes for table `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  ADD PRIMARY KEY (`idprestamoporcobrar`),
  ADD KEY `idprestamo` (`idprestamo`);

--
-- Indexes for table `tbproceso`
--
ALTER TABLE `tbproceso`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indexes for table `tbproductorcliente`
--
ALTER TABLE `tbproductorcliente`
  ADD PRIMARY KEY (`idpersonacliente`);

--
-- Indexes for table `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  ADD PRIMARY KEY (`idproductoresvacaseca`),
  ADD KEY `idproductorsociovacaseca` (`idproductorsociovacaseca`);

--
-- Indexes for table `tbproductorsocio`
--
ALTER TABLE `tbproductorsocio`
  ADD PRIMARY KEY (`idpersonasocio`);

--
-- Indexes for table `tbproductoslacteos`
--
ALTER TABLE `tbproductoslacteos`
  ADD PRIMARY KEY (`codigoproductoslacteos`),
  ADD KEY `unidadproductoslacteos` (`unidadproductoslacteos`);

--
-- Indexes for table `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  ADD PRIMARY KEY (`idproductoveterinario`),
  ADD KEY `funcionveterinarios` (`funcionveterinarios`),
  ADD KEY `viaaplicacionveterinarios` (`viaaplicacionveterinarios`);

--
-- Indexes for table `tbtasaprestamo`
--
ALTER TABLE `tbtasaprestamo`
  ADD PRIMARY KEY (`idtasaprestamo`);

--
-- Indexes for table `tbunidades`
--
ALTER TABLE `tbunidades`
  ADD PRIMARY KEY (`idunidad`);

--
-- Indexes for table `tbventa`
--
ALTER TABLE `tbventa`
  ADD PRIMARY KEY (`idventa`);

--
-- Indexes for table `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD PRIMARY KEY (`idventaporcobrar`),
  ADD KEY `idventa` (`idventa`);

--
-- Indexes for table `tbviaaplicacion`
--
ALTER TABLE `tbviaaplicacion`
  ADD PRIMARY KEY (`idviaaplicacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbahorrosemanal`
--
ALTER TABLE `tbahorrosemanal`
  MODIFY `idahorro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcobrovacaseca`
--
ALTER TABLE `tbcobrovacaseca`
  MODIFY `idcobrovacaseca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  MODIFY `idcompramateriaprima` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcuotavacaseca`
--
ALTER TABLE `tbcuotavacaseca`
  MODIFY `idcuotavacaseca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbfuncion`
--
ALTER TABLE `tbfuncion`
  MODIFY `idfuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbjuntadirectiva`
--
ALTER TABLE `tbjuntadirectiva`
  MODIFY `idjuntadirectiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  MODIFY `idpagoprestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  MODIFY `idpagoventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbperiodopagoprestamo`
--
ALTER TABLE `tbperiodopagoprestamo`
  MODIFY `idperiodopagoprestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpersona`
--
ALTER TABLE `tbpersona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  MODIFY `idpesalechediario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbpreciolitroleche`
--
ALTER TABLE `tbpreciolitroleche`
  MODIFY `idpreciolitroleche` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprestamos`
--
ALTER TABLE `tbprestamos`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  MODIFY `idprestamoporcobrar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbproceso`
--
ALTER TABLE `tbproceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  MODIFY `idproductoresvacaseca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  MODIFY `idproductoveterinario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbtasaprestamo`
--
ALTER TABLE `tbtasaprestamo`
  MODIFY `idtasaprestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbunidades`
--
ALTER TABLE `tbunidades`
  MODIFY `idunidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbventa`
--
ALTER TABLE `tbventa`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  MODIFY `idventaporcobrar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbviaaplicacion`
--
ALTER TABLE `tbviaaplicacion`
  MODIFY `idviaaplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbahorrosemanal`
--
ALTER TABLE `tbahorrosemanal`
  ADD CONSTRAINT `tbahorrosemanal_ibfk_1` FOREIGN KEY (`idpersonaahorro`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbclientedetallista`
--
ALTER TABLE `tbclientedetallista`
  ADD CONSTRAINT `tbclientedetallista_ibfk_1` FOREIGN KEY (`idpersonadetallista`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbclientemayorista`
--
ALTER TABLE `tbclientemayorista`
  ADD CONSTRAINT `tbclientemayorista_ibfk_1` FOREIGN KEY (`idpersonamayorista`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbcuentabancaria`
--
ALTER TABLE `tbcuentabancaria`
  ADD CONSTRAINT `tbcuentabancaria_ibfk_1` FOREIGN KEY (`idpersonacuenta`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD CONSTRAINT `tbdetalleventa_ibfk_1` FOREIGN KEY (`codigoproductoslacteos`) REFERENCES `tbproductoslacteos` (`codigoproductoslacteos`);

--
-- Constraints for table `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  ADD CONSTRAINT `tbdetalleventaveterinaria_ibfk_1` FOREIGN KEY (`codigoproductoslacteos`) REFERENCES `tbproductoslacteos` (`codigoproductoslacteos`);

--
-- Constraints for table `tbempleado`
--
ALTER TABLE `tbempleado`
  ADD CONSTRAINT `tbempleado_ibfk_1` FOREIGN KEY (`idpersonaempleado`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  ADD CONSTRAINT `tbpagoprestamo_ibfk_1` FOREIGN KEY (`idprestamoporcobrar`) REFERENCES `tbprestamosporcobrar` (`idprestamoporcobrar`);

--
-- Constraints for table `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  ADD CONSTRAINT `tbpagoventa_ibfk_1` FOREIGN KEY (`idventaporcobrar`) REFERENCES `tbventaporcobrar` (`idventaporcobrar`);

--
-- Constraints for table `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  ADD CONSTRAINT `tbpesalechediario_ibfk_1` FOREIGN KEY (`idpersonalechediario`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbprestamos`
--
ALTER TABLE `tbprestamos`
  ADD CONSTRAINT `tbprestamos_ibfk_1` FOREIGN KEY (`idpersonaprestamo`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  ADD CONSTRAINT `tbprestamosporcobrar_ibfk_1` FOREIGN KEY (`idprestamo`) REFERENCES `tbprestamos` (`idprestamo`);

--
-- Constraints for table `tbproductorcliente`
--
ALTER TABLE `tbproductorcliente`
  ADD CONSTRAINT `tbproductorcliente_ibfk_1` FOREIGN KEY (`idpersonacliente`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  ADD CONSTRAINT `tbproductoresvacaseca_ibfk_1` FOREIGN KEY (`idproductorsociovacaseca`) REFERENCES `tbproductorsocio` (`idpersonasocio`);

--
-- Constraints for table `tbproductorsocio`
--
ALTER TABLE `tbproductorsocio`
  ADD CONSTRAINT `tbproductorsocio_ibfk_1` FOREIGN KEY (`idpersonasocio`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbproductoslacteos`
--
ALTER TABLE `tbproductoslacteos`
  ADD CONSTRAINT `tbproductoslacteos_ibfk_1` FOREIGN KEY (`unidadproductoslacteos`) REFERENCES `tbunidades` (`idunidad`);

--
-- Constraints for table `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  ADD CONSTRAINT `tbproductosveterinarios_ibfk_1` FOREIGN KEY (`funcionveterinarios`) REFERENCES `tbfuncion` (`idfuncion`),
  ADD CONSTRAINT `tbproductosveterinarios_ibfk_2` FOREIGN KEY (`viaaplicacionveterinarios`) REFERENCES `tbviaaplicacion` (`idviaaplicacion`);

--
-- Constraints for table `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD CONSTRAINT `tbventaporcobrar_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `tbventa` (`idventa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
