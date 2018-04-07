-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2018 at 05:28 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarcliente` (IN `id` INT)  NO SQL
BEGIN
SELECT `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona` FROM `tbpersona` WHERE idpersona=id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `compramateriaprima` (IN `idProductor` INT, IN `cantidadlitroscompramateriaprima` DOUBLE, IN `montopagolitro` DOUBLE, IN `totalpagarlitros` DOUBLE, IN `fechacompramateriaprima` DATE)  BEGIN
	INSERT INTO  tbcompramateriaprima(idpersona,cantidadlitroscompramateriaprima,montopagolitro,totalpagarlitros,fechacompramateriaprima) VALUES(idProductor,cantidadlitroscompramateriaprima,montopagolitro,totalpagarlitros,fechacompramateriaprima); 
	UPDATE tbpesalechediario SET estadopesalechediario='inactivo' WHERE idpersonalechediario=idProductor AND fechaentregalechediario!=fechacompramateriaprima AND estadopesalechediario='activo';
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarproceso` (IN `id` INT(30))  NO SQL
BEGIN
UPDATE tbproceso set estadoproceso='inactivo' WHERE idproceso=id AND estadoproceso='activo';
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `login2` (IN `idpersona` VARCHAR(50))  NO SQL
SELECT tbempleado.passwordempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbpersona.idpersona=idpersona AND tbempleado.estadoempleado="activo"$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarempleados` (IN `id` VARCHAR(30), IN `clave` TEXT, IN `tipo` TEXT)  NO SQL
UPDATE tbempleado SET passwordempleado=clave,tipoempleado=tipo
WHERE idpersonaempleado=id and estadoempleado="activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarJuntaDirectiva` (IN `presidente` TEXT, IN `vicepresidente` TEXT, IN `secretario` TEXT, IN `tesorero` TEXT, IN `fiscal` TEXT, IN `vocal1` TEXT, IN `vocal2` TEXT, IN `inicio` DATE, IN `final` DATE, IN `id` VARCHAR(30))  NO SQL
BEGIN
UPDATE tbjuntadirectiva SET presidente=presidente,vicepresidente=vicepresidente,secretario=secretario,tesorero=tesorero,fiscal=fiscal,vocal1=vocal1,vocal2=vocal2,fechainicioperiodo=inicio,fechafinalperiodo=final WHERE idjuntadirectiva = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproceso` (IN `nombre` TEXT, IN `cantidad` DOUBLE, IN `porcentaje` DOUBLE, IN `entera` DOUBLE, IN `descremada` DOUBLE, IN `cuajo` DOUBLE, IN `cloruro` DOUBLE, IN `sal` DOUBLE, IN `cultivo` TEXT, IN `estabilizador` DOUBLE, IN `colorante` DOUBLE, IN `crema1` DOUBLE, IN `leche1` DOUBLE, IN `crema2` DOUBLE, IN `leche2` DOUBLE, IN `hora` TIME, IN `fecha` DATE, IN `id` INT(30))  NO SQL
UPDATE tbproceso SET productoproceso= nombre,cantidadproceso=cantidad,porcentajegrasalecheproceso=porcentaje,lecheenteraproceso=entera,lechedescremadaproceso=descremada,cuajoproceso=cuajo,clorurdecalcioproceso=cloruro,salproceso=sal,cultivocodigoproceso=cultivo,estabilizadorcodigo=estabilizador,colorateproceso=colorante,cremaproceso1=crema1,lecheproceso1=leche1,cremaproceso2=crema2,lecheproceso2=leche2,horaproceso=hora,fechaproceso=fecha WHERE idproceso = id$$

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
SELECT p.idpersona,p.documentoidentidadpersona,
p.nombrepersona,p.apellido1persona,
p.apellido2persona, p.telefonopersona,
p.direccionpersona,p.correopersona,i.rutaimagen
FROM tbpersona p
INNER JOIN tbclientemayorista t  ON
t.idpersonamayorista=p.idpersona 
INNER JOIN tbimagen i ON
i.idpersona=t.idpersonamayorista
WHERE t.estadoclientemayorista='activo';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarempleados` ()  NO SQL
BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona, tbempleado.tipoempleado, tbempleado.passwordempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbempleado.estadoempleado="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarfunciones` ()  BEGIN
SELECT  tbfuncion.nombrefuncion FROM tbfuncion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarJuntaDirectiva` ()  NO SQL
BEGIN
SELECT tbjuntadirectiva.idjuntadirectiva,tbjuntadirectiva.fechainicioperiodo,tbjuntadirectiva.fechafinalperiodo,tbjuntadirectiva.presidente, tbjuntadirectiva.vicepresidente,tbjuntadirectiva.secretario,tbjuntadirectiva.tesorero,tbjuntadirectiva.fiscal, tbjuntadirectiva.vocal1, tbjuntadirectiva.vocal2 FROM tbjuntadirectiva;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarProcesos` ()  NO SQL
BEGIN
SELECT * FROM tbproceso WHERE estadoproceso = "activo";
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenercantidadproducto` (IN `id` INT(30))  NO SQL
SELECT cantidadinventarioproductolacteo FROM tbproductoslacteos WHERE codigoproductoslacteos = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pagarAhorro` (`idProductor` INT)  BEGIN
	UPDATE tbahorrosemanal SET estadoahorrosemanal='pagado' WHERE idpersonaahorro=idProductor AND estadoahorrosemanal='activo'; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarAhorroTotalSemanal` (`id` INT, `montoAhorro` DOUBLE, `litrosEntregados` DOUBLE, `fecha` DATE)  BEGIN
INSERT INTO tbahorrosemanal(idpersonaahorro,montoahorrosemanalporlitro,litrosentregadosahorrosemanal,fechaentregapago,estadoahorrosemanal) VALUES(id,montoAhorro,litrosEntregados,fecha,"activo");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarDetalleVenta` (IN `precio` DOUBLE, IN `cantidad` INT, IN `total` DOUBLE, IN `codigo` VARCHAR(50), IN `descuento` DOUBLE, IN `idventa` INT)  NO SQL
    DETERMINISTIC
BEGIN
INSERT INTO tbdetalleventa(preciounitariodetalleventa, cantidaddetalleventa, subtotaldetalleventa, codigoproductoslacteos, descuento, idventa) VALUES (precio,cantidad,total,codigo,descuento,idventa);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarDetalleVentaVeterinaria` (`preciounitariodetalleventa` DOUBLE, `cantidaddetalleventa` INT, `subtotaldetalleventa` DOUBLE, `codigoproductoslacteos` VARCHAR(50), `idVenta` INT)  BEGIN
  INSERT INTO tbdetalleventaveterinaria(preciounitariodetalleventa,cantidaddetalleventa,subtotaldetalleventa,idproductoveterinario,idventa) VALUES(preciounitariodetalleventa,cantidaddetalleventa ,subtotaldetalleventa,(SELECT idproductoveterinario FROM tbproductosveterinarios WHERE codigoproductoveterinario=codigoproductoslacteos),idVenta);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempleado` (IN `clave` TEXT, IN `tipo` TEXT)  NO SQL
INSERT INTO tbempleado(idpersonaempleado,passwordempleado,tipoempleado,estadoempleado) VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1),clave,tipo,"activo")$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarjuntadirectiva` (IN `presidente` TEXT, IN `vicepresidente` TEXT, IN `secretario` TEXT, IN `tesorero` TEXT, IN `fiscal` TEXT, IN `vocal1` TEXT, IN `vocal2` TEXT, IN `inicio` DATE, IN `final` DATE)  NO SQL
INSERT INTO tbjuntadirectiva(presidente, vicepresidente, secretario, tesorero, fiscal, vocal1, vocal2,fechainicioperiodo, fechafinalperiodo) VALUES (presidente,vicepresidente,secretario,tesorero,fiscal,vocal1,vocal2,inicio,final)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarLecheDiaria` (`cliente` INT, `fecha` DATE, `turno` TEXT, `peso` DOUBLE)  BEGIN
INSERT INTO tbpesalechediario (idpersonalechediario,fechaentregalechediario,turnopesolechediario,pesoturno, estadopesalechediario)
VALUES (cliente,fecha,turno,peso,"activo");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarpersona` (IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT)  INSERT INTO tbpersona(documentoidentidadpersona,nombrepersona, apellido1persona,apellido2persona,telefonopersona,direccionpersona,correopersona) VALUES (cedula,nombre,apellido1,apellido2,telefono,direccion,correo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarProceso` (IN `nombre` TEXT, IN `cantidad` DOUBLE, IN `porcentaje` DOUBLE, IN `entera` DOUBLE, IN `descremada` DOUBLE, IN `cuajo` DOUBLE, IN `cloruro` DOUBLE, IN `sal` DOUBLE, IN `cultivo` TEXT, IN `estabilizador` DOUBLE, IN `colorante` DOUBLE, IN `crema1` DOUBLE, IN `leche1` DOUBLE, IN `crema2` DOUBLE, IN `leche2` DOUBLE, IN `hora` TIME, IN `fecha` DATE)  NO SQL
INSERT INTO tbproceso( productoproceso, cantidadproceso, porcentajegrasalecheproceso, lecheenteraproceso, lechedescremadaproceso, cuajoproceso, clorurdecalcioproceso, salproceso, cultivocodigoproceso, estabilizadorcodigo, colorateproceso, cremaproceso1, lecheproceso1, cremaproceso2, lecheproceso2, horaproceso, fechaproceso, estadoproceso) VALUES(nombre,cantidad,porcentaje,entera,descremada,cuajo,cloruro,sal,cultivo,estabilizador,colorante,crema1,leche1,crema2,leche2,hora,fecha,"activo")$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarSolicitudPrestamo` (`idPersona` INT, `interes` INT, `montoPrestamo` DOUBLE, `plazo` INT, `modoPlazo` INT, `fecha` DATE)  BEGIN
  INSERT INTO tbsolicitudprestamo(idpersona,idinteres,cantidadsolicitud,plazo,idmodoplazo,estado,fecha) VALUES(idPersona,interes,montoPrestamo,plazo,modoPlazo,"Solicitud",fecha);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarVenta` (`idCliente` INT, `facturaVenta` INT, `fecha` DATE, `hora` TIME, `totalBruto` DOUBLE, `totalNeto` DOUBLE, `tipoVenta` TEXT)  BEGIN
    INSERT INTO tbventa(numerofactura,fechaventa,horaventa,totalbrutoventa,totalnetoventa,tipoventa,idpersonaventa) VALUES(facturaVenta,fecha,hora,totalBruto,totalNeto,tipoVenta,idCliente);
    UPDATE tbfacturero SET ultimafactura=facturaVenta+1;
    SELECT idventa FROM tbventa ORDER BY idventa DESC limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarVentaPorCobrar` (`idCliente` INT, `idVenta` INT, `totalVenta` DOUBLE)  BEGIN
  INSERT INTO tbventaporcobrar(idventa,idpersona,saldoactualventaporcobrar,estadoventaporcobrar) VALUES(idVenta,idCliente,totalVenta,"activo");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restastockproceso` (IN `cantidad` DOUBLE, IN `nombre` TEXT)  NO SQL
UPDATE tbproductoslacteos SET cantidadinventarioproductolacteo = cantidadinventarioproductolacteo - cantidad WHERE nombreproductolacteo = nombre AND estadoproductoslacteos = "activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retornarMontoAhorroCliente` (IN `id` INT)  BEGIN
SELECT tbproductorcliente.ahorroporlitroproductorcliente FROM tbproductorcliente WHERE idpersonacliente=id AND estadoproductorcliente="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `retornarMontoAhorroSocio` (`id` INT)  BEGIN
SELECT tbproductorsocio.ahorroporlitroproductorsocio FROM tbproductorsocio WHERE idpersonasocio=id AND estadoproductorsocio="activo";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaNombre` (IN `id` INT)  NO SQL
BEGIN
SELECT `nombrepersona`, `apellido1persona`, `apellido2persona` FROM `tbpersona` WHERE idpersona=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVeterinario` (IN `id` INT)  NO SQL
BEGIN
SELECT v.codigoproductoveterinario,
v.nombreproductoveterinario, 
d.preciounitariodetalleventa,
d.cantidaddetalleventa 
FROM tbdetalleventaveterinaria d 
INNER JOIN tbproductosveterinarios v ON d.idproductoveterinario=v.idproductoveterinario
WHERE d.idventa=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenEmpleado` (IN `id` INT)  NO SQL
BEGIN
SELECT `imagentitulomanipulacionalimentosempleado`, `imagendocumentoidentidadempleado`
FROM `tbempleado` WHERE idpersonaempleado=id  AND estadoempleado='activo';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenproductorcliente` (IN `id` INT)  NO SQL
BEGIN
SELECT `imagencboproductorcliente`, `imagenexamensangradoproductorcliente`, `imagenescrituraproductorcliente`, `imagenreciboluzproductorcliente`, `imagenrecibaguaproductorcliente`, `imagenexamensolidoproductorcliente`, `imagenplanofincaproductorcliente`, `imagendocumentoidentidadproductorcliente`
FROM `tbproductorcliente` WHERE idpersonacliente=id AND estadoproductorcliente='activo';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenproductorsocio` (IN `id` INT)  NO SQL
BEGIN
SELECT `imagencboproductorsocio`, `imagenexamensangradoproductorsocio`, `imagenescrituraproductorsocio`, `imagenreciboluzproductorsocio`, `imagenrecibaguaproductorsocio`, `imagenexamensolidoproductorsocio`, `imagenplanofincaproductorsocio`, `imagendocumentoidentidadproductorsocio` FROM `tbproductorsocio` WHERE idpersonasocio=id AND estadoproductorsocio='activo';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesventa` (IN `inicial` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchproductlacteo` (IN `codigo` TEXT)  NO SQL
    DETERMINISTIC
BEGIN
  SELECT nombreproductolacteo,preciounitarioproductolacteo
  FROM tbproductoslacteos
  WHERE codigoproductoslacteos=codigo LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `searchproductveterinario` (`codigo` TEXT)  BEGIN
  SELECT nombreproductoveterinario,precioproductoveterinario FROM tbproductosveterinarios WHERE codigoproductoveterinario=codigo LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sumastockproceso` (IN `cantidad` DOUBLE, IN `nombre` TEXT)  NO SQL
UPDATE tbproductoslacteos SET cantidadinventarioproductolacteo = cantidadinventarioproductolacteo + cantidad WHERE nombreproductolacteo = nombre AND estadoproductoslacteos = "activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verificarturno` (IN `fecha` DATE, IN `turno` TEXT, IN `cliente` INT)  NO SQL
SELECT tbpesalechediario.turnopesolechediario, tbpesalechediario.fechaentregalechediario FROM tbpesalechediario WHERE  tbpesalechediario.fechaentregalechediario=fecha AND tbpesalechediario.turnopesolechediario=turno AND tbpesalechediario.idpersonalechediario=cliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verReporteAhorro` (IN `fechaInicio` DATE, IN `fechaFinal` DATE)  BEGIN
	SELECT tbahorrosemanal.idahorro, tbahorrosemanal.montoahorrosemanalporlitro,tbahorrosemanal.litrosentregadosahorrosemanal,tbahorrosemanal.fechaentregapago,tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona FROM tbahorrosemanal INNER JOIN tbpersona ON tbahorrosemanal.idpersonaahorro=tbpersona.idpersona WHERE tbahorrosemanal.fechaentregapago BETWEEN fechaInicio AND fechaFinal;
END$$

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

--
-- Dumping data for table `tbahorrosemanal`
--

INSERT INTO `tbahorrosemanal` (`idpersonaahorro`, `idahorro`, `montoahorrosemanalporlitro`, `litrosentregadosahorrosemanal`, `fechaentregapago`, `estadoahorrosemanal`) VALUES
(5, 1, 50, 40, '2018-04-04', 'activo'),
(5, 2, 50, 40, '2018-04-04', 'activo'),
(1, 3, 10, 197.2, '2018-04-04', 'activo'),
(5, 4, 50, 40, '2018-04-04', 'activo'),
(5, 5, 50, 40, '2018-04-04', 'activo'),
(2, 6, 40, 290.7, '2018-03-01', 'activo');

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
(4, 'activo');

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
  `idpersona` int(11) NOT NULL,
  `idcompramateriaprima` int(11) NOT NULL,
  `cantidadlitroscompramateriaprima` double NOT NULL,
  `montopagolitro` double NOT NULL,
  `totalpagarlitros` double NOT NULL,
  `fechacompramateriaprima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbcompramateriaprima`
--

INSERT INTO `tbcompramateriaprima` (`idpersona`, `idcompramateriaprima`, `cantidadlitroscompramateriaprima`, `montopagolitro`, `totalpagarlitros`, `fechacompramateriaprima`) VALUES
(1, 1, 23, 280, 1000, '2017-01-01'),
(5, 2, 40, 280, 160, '2018-04-04'),
(5, 3, 40, 280, 160, '2018-04-04'),
(5, 4, 40, 280, 160, '2018-04-04'),
(5, 5, 40, 280, 160, '2018-04-04'),
(5, 6, 40, 280, 160, '2018-04-04'),
(5, 7, 40, 280, 160, '2018-04-04'),
(5, 8, 40, 285, 160, '2018-04-04'),
(5, 9, 40, 285, 160, '2018-04-04'),
(5, 10, 40, 285, 160, '2018-04-04'),
(5, 11, 40, 285, 11400, '2018-04-04'),
(5, 12, 40, 285, 11400, '2018-04-04'),
(5, 13, 40, 285, 11400, '2018-04-04'),
(5, 14, 40, 285, 11400, '2018-04-04'),
(5, 15, 40, 285, 11400, '2018-04-04'),
(5, 16, 40, 285, 11400, '2018-04-04'),
(5, 17, 40, 285, 11400, '2018-04-04'),
(5, 18, 40, 285, 11400, '2018-04-04'),
(5, 19, 40, 285, 11400, '2018-04-04'),
(5, 20, 40, 285, 11400, '2018-04-04'),
(5, 21, 40, 285, 11400, '2018-04-04'),
(5, 22, 40, 285, 11400, '2018-04-04'),
(5, 23, 40, 285, 11400, '2018-04-04'),
(5, 24, 40, 285, 11400, '2018-04-04'),
(5, 25, 50, 285, 14250, '2018-04-04'),
(5, 26, 50, 285, 14250, '2018-04-04'),
(5, 27, 40, 285, 11400, '2018-04-04'),
(1, 28, 197.2, 285, 56202, '2018-04-04'),
(5, 29, 40, 285, 11400, '2018-04-04'),
(5, 30, 40, 285, 11400, '2018-04-04'),
(5, 31, 40, 285, 11400, '2018-04-04'),
(5, 32, 40, 285, 11400, '2018-04-04'),
(5, 33, 40, 285, 11400, '2018-04-04'),
(5, 34, 40, 285, 11400, '2018-04-04'),
(5, 35, 40, 285, 11400, '2018-04-04'),
(5, 36, 40, 285, 11400, '2018-04-04'),
(1, 37, 197.2, 285, 56202, '2018-04-04'),
(5, 38, 40, 285, 11400, '2018-04-04'),
(5, 39, 40, 285, 11400, '2018-04-04'),
(2, 40, 290.7, 285, 82849.5, '2018-04-04'),
(2, 41, 290.7, 285, 82849.5, '2018-04-04');

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
  `preciounitariodetalleventa` double NOT NULL,
  `cantidaddetalleventa` double NOT NULL,
  `subtotaldetalleventa` double NOT NULL,
  `codigoproductoslacteos` varchar(50) DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `idventa` int(11) NOT NULL,
  `iddetalleventa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdetalleventa`
--

INSERT INTO `tbdetalleventa` (`preciounitariodetalleventa`, `cantidaddetalleventa`, `subtotaldetalleventa`, `codigoproductoslacteos`, `descuento`, `idventa`, `iddetalleventa`) VALUES
(100, 4, 458, '1234', 5, 35, 2),
(51651, 4, 4, '1234', 4, 35, 3),
(4, 4, 2, '1234', 0, 35, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbdetalleventaveterinaria`
--

CREATE TABLE `tbdetalleventaveterinaria` (
  `iddetalleventa` int(11) NOT NULL,
  `preciounitariodetalleventa` double DEFAULT NULL,
  `cantidaddetalleventa` int(11) DEFAULT NULL,
  `subtotaldetalleventa` double DEFAULT NULL,
  `idventa` int(11) NOT NULL,
  `idproductoveterinario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbdetalleventaveterinaria`
--

INSERT INTO `tbdetalleventaveterinaria` (`iddetalleventa`, `preciounitariodetalleventa`, `cantidaddetalleventa`, `subtotaldetalleventa`, `idventa`, `idproductoveterinario`) VALUES
(7, 400, 1, 400, 5, 2),
(8, 5000, 1, 5000, 6, 1),
(9, 2500, 1, 2500, 6, 7),
(10, 2500, 1, 2500, 10, 7),
(11, 5000, 1, 5000, 22, 1),
(12, 5000, 1, 5000, 35, 1),
(13, 5000, 1, 5000, 53, 1),
(14, 5000, 1, 5000, 54, 1),
(15, 5000, 1, 5000, 56, 1),
(16, 5000, 1, 5000, 58, 1),
(17, 2500, 1, 2500, 58, 7),
(18, 5000, 1, 5000, 60, 1),
(19, 2500, 1, 2500, 60, 7),
(20, 5000, 1, 5000, 62, 1),
(21, 2500, 1, 2500, 62, 7),
(22, 5000, 1, 5000, 64, 1),
(23, 5000, 1, 5000, 66, 1),
(24, 5000, 1, 5000, 68, 1),
(25, 5000, 1, 5000, 70, 1),
(26, 5000, 1, 5000, 77, 1),
(27, 5000, 1, 5000, 80, 1);

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
(1, '$2y$10$PXqIWhFC1PlthoIhvJHL7.8da7cBhjdZg0jZh/KcfCrBxrx0J31jm', '', '../../image/empleado/manipulacion.jpg', '../../image/empleado/cedula.jpg', 'activo'),
(4, '$2y$10$ssu88Q7mN17EmUoy6h56cuMtKZPG1x9PT7idvyHzyh9Dk.Tr8Asvy', 'Bodega', NULL, NULL, 'activo'),
(12, '$2y$10$rbKXQbZ.', 'Bodega', NULL, NULL, 'activo'),
(13, '$2y$10$fT2E4Vs3GYFUmSYV347.pe7FYDensRubdjRs0Nfcn3dTX6YdxANLy', 'Administrador', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbfacturero`
--

CREATE TABLE `tbfacturero` (
  `ultimafactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbfacturero`
--

INSERT INTO `tbfacturero` (`ultimafactura`) VALUES
(73);

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
-- Table structure for table `tbimagen`
--

CREATE TABLE `tbimagen` (
  `idimagen` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `nombreimagen` varchar(60) NOT NULL,
  `rutaimagen` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbimagen`
--

INSERT INTO `tbimagen` (`idimagen`, `idpersona`, `nombreimagen`, `rutaimagen`) VALUES
(1, 4, 'david', '../../image/distribuidor/david.jpg');

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
-- Table structure for table `tbinteresprestamo`
--

CREATE TABLE `tbinteresprestamo` (
  `idinteres` int(11) NOT NULL,
  `porcentaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbinteresprestamo`
--

INSERT INTO `tbinteresprestamo` (`idinteres`, `porcentaje`) VALUES
(1, 5),
(2, 10),
(3, 20);

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
(1, '2018-02-01', '2018-02-24', 'Kervn', 'Nathalia', 'Lilliam', 'Hector', 'Minor', 'Sergio', 'Olman'),
(2, '2018-03-06', '2018-03-06', 'a', 'a', 'a', 'a', 'a', 'a', 'a');

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

--
-- Dumping data for table `tbperiodopagoprestamo`
--

INSERT INTO `tbperiodopagoprestamo` (`idperiodopagoprestamo`, `tipopagoprestamo`) VALUES
(1, 'mes'),
(2, 'semana'),
(3, 'quincena'),
(4, '22 días');

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
(4, '206990696', 'David', 'Salas', 'Lorente', '85479654', 'la virgen', 'david@gmail.com'),
(5, '234567890', 'Giorno', 'Giovana', 'Giovana', '2345678', 'Vento', 'gg@gmail.com'),
(6, '2345678934', 'nanita', 'ovarios', 'mevago', '1234567', 'La oruca', 'sdfgh@gmail.com'),
(7, '900570431', 'Marlene', 'Vindas', 'Vindas', '84421444', 'San Pablo', 'N/A'),
(8, '302640297', 'Hector', 'Araya', 'Cordero', '88888888', 'El Sauce', 'N/A'),
(9, '473739927', 'Enrique', 'Albaro', 'Perez', '8667899', 'La Virgen', 'gga@hhd.com'),
(10, '305020820', 'Kervin JosÃ©', 'Araya', 'Romero', '88776655', '', 'ker@gmail.com'),
(12, '33440667', 'Berny', 'Garro', 'Dur&aacute;n', '22768900', 'La Victoria', 'b@gmail.com'),
(13, '207210905', 'Brandon', 'Rodriguez', 'Mendez', '62091232', 'Sauce', 'brandon-ndsi@hotmail.com');

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
(1, 11, '2018-03-12', 'Tarde', 38.6, 'activo'),
(2, 12, '2018-04-01', 'Mañana', 50, 'inactivo'),
(2, 13, '2018-04-01', 'Tarde', 45.8, 'inactivo'),
(2, 14, '2018-04-02', 'Tarde', 45.8, 'inactivo'),
(2, 15, '2018-04-02', 'Mañana', 53.1, 'inactivo'),
(2, 16, '2018-04-03', 'Mañana', 53, 'inactivo'),
(2, 17, '2018-04-03', 'Tarde', 43, 'inactivo');

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

--
-- Dumping data for table `tbpreciolitroleche`
--

INSERT INTO `tbpreciolitroleche` (`idpreciolitroleche`, `preciolitroleche`, `fechainicio`, `estadopreciolitroleche`) VALUES
(1, 285, '2018-04-04', 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `tbprestamos`
--

CREATE TABLE `tbprestamos` (
  `idprestamo` int(11) NOT NULL,
  `idpersonaprestamo` int(11) NOT NULL,
  `tasainteres` double NOT NULL,
  `montototalprestamo` double NOT NULL,
  `montocuota` double NOT NULL,
  `fechaprestamo` date NOT NULL
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
  `fechaproceso` date NOT NULL,
  `estadoproceso` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbproceso`
--

INSERT INTO `tbproceso` (`idproceso`, `productoproceso`, `cantidadproceso`, `porcentajegrasalecheproceso`, `lecheenteraproceso`, `lechedescremadaproceso`, `cuajoproceso`, `clorurdecalcioproceso`, `salproceso`, `cultivocodigoproceso`, `estabilizadorcodigo`, `colorateproceso`, `cremaproceso1`, `lecheproceso1`, `cremaproceso2`, `lecheproceso2`, `horaproceso`, `fechaproceso`, `estadoproceso`) VALUES
(1, 'Queso Mozarrella', 4, 12, 111, 111, 11, 11, 11, 'aasss', 11, 11, 11, 11, 11, 11, '09:14:00', '2018-04-07', 'inactivo'),
(2, 'Queso Mozarrella', 50, 11, 11, 11, 11, 11, 11, '11', 11, 11, 11, 11, 11, 11, '09:16:00', '2018-04-07', 'inactivo');

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
(2, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(7, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
(8, 10, '../../image/productor/cliente/cbo.jpg', '../../image/productor/cliente/sangrado.jpg', '../../image/productor/cliente/escritura.jpg', '../../image/productor/cliente/luz.jpg', '../../image/productor/cliente/agua.jpg', '../../image/productor/cliente/solido.jpg', '../../image/productor/cliente/plano.jpg', '../../image/productor/cliente/cedula.jpg', 'activo');

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
(1, 10, '../../image/productor/socio/cbo.jpg', '../../image/productor/socio/sangrado.jpg', '../../image/productor/socio/escritura.jpg', '../../image/productor/socio/luz.jpg', '../../image/productor/socio/agua.jpg', '../../image/productor/socio/solido.jpg', '../../image/productor/socio/plano.jpg', '../../image/productor/socio/cedula.jpg', 'activo'),
(4, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'inactivo'),
(5, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'activo'),
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
(1, '445', 'granos de leche', 55, 45, 'activo'),
(2, '515466965', 'jffu', 78, 55, 'activo'),
(1, '5156455', 'leche asteca', 78, 55, 'activo'),
(2, '51574965', 'jffu', 78, 55, 'activo'),
(1, '5159695', 'leche italiana', 78, 55, 'activo'),
(2, '51598865', 'jffu', 78, 55, 'activo'),
(2, '51599965', 'jffu', 78, 55, 'activo'),
(2, '51918765', 'jffu', 78, 55, 'activo'),
(1, '5193865', 'leche irlandeza', 78, 55, 'activo'),
(1, '51965', 'perros de leche', 78, 55, 'activo'),
(1, '519765', 'leche evaporada', 78, 55, 'activo'),
(1, '5415965', 'leche fresca', 78, 55, 'activo'),
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
-- Table structure for table `tbsolicitudprestamo`
--

CREATE TABLE `tbsolicitudprestamo` (
  `idsolicitud` int(11) NOT NULL,
  `idpersona` int(11) DEFAULT NULL,
  `idinteres` int(11) DEFAULT NULL,
  `cantidadsolicitud` double DEFAULT NULL,
  `plazo` int(11) DEFAULT NULL,
  `idmodoplazo` int(11) DEFAULT NULL,
  `estado` text,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbsolicitudprestamo`
--

INSERT INTO `tbsolicitudprestamo` (`idsolicitud`, `idpersona`, `idinteres`, `cantidadsolicitud`, `plazo`, `idmodoplazo`, `estado`, `fecha`) VALUES
(1, 1, 2, 100000, 11, 2, 'Solicitud', '2018-04-05'),
(2, 6, 2, 150000, 12, 2, 'Solicitud', '2018-04-05'),
(3, 1, 2, 150000, 11, 2, 'Solicitud', '2018-04-05'),
(4, 9, 2, 150000, 11, 2, 'Solicitud', '2018-04-05'),
(5, 2, 2, 125000, 11, 2, 'Solicitud', '2018-04-05'),
(6, 8, 2, 200000, 22, 2, 'Solicitud', '2018-04-05'),
(7, 1, 2, 100000, 15, 2, 'Solicitud', '2018-04-07');

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
  `tipoventa` text NOT NULL,
  `idpersonaventa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbventa`
--

INSERT INTO `tbventa` (`idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa`) VALUES
(1, '0', '2018-03-16', '10:32:00', 400, 400, 'Veterinaria', 1),
(2, '1', '2018-03-16', '10:35:00', 400, 400, 'Veterinaria', 1),
(21, '20', '2018-03-17', '02:55:00', 0, 0, 'Ventanilla', 1),
(22, '21', '2018-03-17', '02:57:00', 5000, 5000, 'Veterinaria', 8),
(25, '24', '2018-03-17', '03:06:00', 0, 0, 'Ventanilla', 5),
(26, '25', '2018-03-17', '03:15:00', 4000, 4000, 'Ventanilla', 6),
(28, '26', '2018-03-17', '03:27:00', 1000, 1000, 'Ventanilla', 7),
(30, '27', '2018-03-17', '03:58:00', 64000, 64000, 'Ventanilla', 8),
(31, '28', '2018-03-17', '04:02:00', 2000000, 2000000, 'Ventanilla', 5),
(32, '29', '2018-03-17', '04:05:00', 4000, 4000, 'Ventanilla', 5),
(33, '30', '2018-03-22', '10:47:00', 4000, 4000, 'Distribuidor', 10),
(34, '31', '2018-03-22', '10:48:00', 4000, 4000, 'Ventanilla', 6),
(35, '32', '2018-03-23', '11:13:00', 5000, 5000, 'Veterinaria', 9),
(36, '33', '2018-03-24', '12:22:00', 4000, 4000, 'Distribuidor', 4),
(37, '34', '2018-03-24', '12:24:00', 1000, 1000, 'Distribuidor', 4),
(38, '35', '2018-03-24', '12:28:00', 4000, 4000, 'Distribuidor', 4),
(39, '36', '2018-03-24', '12:55:00', 4000, 4000, 'Distribuidor', 4),
(40, '37', '2018-03-24', '08:38:00', 8000, 8000, 'Distribuidor', 4),
(42, '38', '2018-03-24', '08:46:00', 1000, 1000, 'Distribuidor', 4),
(43, '39', '2018-03-24', '09:22:00', 4000, 4000, 'Distribuidor', 4),
(44, '40', '2018-03-24', '09:24:00', 4000, 4000, 'Distribuidor', 4),
(45, '41', '2018-03-24', '09:30:00', 8000, 8000, 'Distribuidor', 4),
(46, '42', '2018-03-24', '11:10:00', 4000, 4000, 'Distribuidor', 4),
(47, '43', '2018-03-24', '11:11:00', 11000, 11000, 'Distribuidor', 4),
(48, '44', '2018-03-24', '11:19:00', 6312, 6312, 'Distribuidor', 4),
(49, '45', '2018-03-24', '04:52:00', 12000, 12000, 'Distribuidor', 4),
(50, '46', '2018-03-25', '04:57:00', 8000, 8000, 'Distribuidor', 4),
(51, '47', '2018-03-27', '12:15:00', 12000, 12000, 'Distribuidor', 1),
(52, '48', '2018-03-27', '12:21:00', 4000, 4000, 'Distribuidor', 1),
(53, '49', '2018-03-27', '12:32:00', 5000, 5000, 'Veterinaria', 1),
(54, '50', '2018-03-27', '12:32:00', 5000, 5000, 'Veterinaria', 1),
(55, '51', '2018-03-27', '12:36:00', 5000, 5000, 'Distribuidor', 1),
(56, '51', '2018-03-27', '12:36:00', 5000, 5000, 'Veterinaria', 1),
(57, '52', '2018-03-27', '02:00:00', 7500, 7500, 'Distribuidor', 7),
(58, '52', '2018-03-27', '02:00:00', 7500, 7500, 'Veterinaria', 7),
(59, '53', '2018-03-27', '02:01:00', 7500, 7500, 'Distribuidor', 7),
(60, '53', '2018-03-27', '02:01:00', 7500, 7500, 'Veterinaria', 7),
(61, '54', '2018-03-27', '02:02:00', 7500, 7500, 'Distribuidor', 7),
(62, '54', '2018-03-27', '02:02:00', 7500, 7500, 'Veterinaria', 7),
(63, '55', '2018-03-27', '02:13:00', 5000, 5000, 'Distribuidor', 1),
(64, '55', '2018-03-27', '02:13:00', 5000, 5000, 'Veterinaria', 1),
(65, '56', '2018-03-27', '02:54:00', 5000, 5000, 'Distribuidor', 1),
(66, '56', '2018-03-27', '02:54:00', 5000, 5000, 'Veterinaria', 1),
(67, '57', '2018-03-27', '02:55:00', 5000, 5000, 'Distribuidor', 1),
(68, '57', '2018-03-27', '02:55:00', 5000, 5000, 'Veterinaria', 1),
(69, '58', '2018-03-27', '02:58:00', 5000, 5000, 'Distribuidor', 1),
(70, '58', '2018-03-27', '02:58:00', 5000, 5000, 'Veterinaria', 1),
(71, '59', '2018-03-27', '03:05:00', 4000, 4000, 'Distribuidor', 5),
(72, '60', '2018-03-27', '03:24:00', 4000, 4000, 'Distribuidor', 5),
(73, '61', '2018-03-27', '03:24:00', 4000, 4000, 'Distribuidor', 6),
(74, '62', '2018-03-27', '03:26:00', 4000, 4000, 'Distribuidor', 4),
(75, '63', '2018-03-27', '03:27:00', 4000, 4000, 'Distribuidor', 4),
(76, '64', '2018-03-27', '03:27:00', 5000, 5000, 'Distribuidor', 1),
(77, '64', '2018-03-27', '03:27:00', 5000, 5000, 'Veterinaria', 1),
(78, '65', '2018-03-27', '03:29:00', 4000, 4000, 'Distribuidor', 4),
(79, '66', '2018-03-27', '03:37:00', 5000, 5000, 'Distribuidor', 1),
(80, '66', '2018-03-27', '03:37:00', 5000, 5000, 'Veterinaria', 1),
(81, '67', '2018-03-27', '05:49:00', 4000, 4000, 'Distribuidor', 7),
(82, '68', '2018-04-04', '11:24:00', 6000, 6000, 'Distribuidor', 1),
(83, '69', '2018-04-04', '11:25:00', 4000, 4000, 'Distribuidor', 5),
(84, '70', '2018-04-04', '11:26:00', 4000, 4000, 'Distribuidor', 5),
(85, '71', '2018-04-04', '11:28:00', 4000, 4000, 'Distribuidor', 5),
(86, '72', '2018-04-04', '11:28:00', 1000, 1000, 'Distribuidor', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbventaporcobrar`
--

CREATE TABLE `tbventaporcobrar` (
  `idventaporcobrar` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `saldoactualventaporcobrar` double NOT NULL,
  `estadoventaporcobrar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbventaporcobrar`
--

INSERT INTO `tbventaporcobrar` (`idventaporcobrar`, `idventa`, `idpersona`, `saldoactualventaporcobrar`, `estadoventaporcobrar`) VALUES
(1, 1, 1, 400, 'activo'),
(2, 2, 1, 400, 'activo'),
(21, 1, 1, 0, 'activo'),
(22, 22, 8, 5000, 'activo'),
(25, 1, 5, 0, 'activo'),
(26, 1, 6, 4000, 'activo'),
(27, 1, 7, 1000, 'activo'),
(28, 1, 8, 64000, 'activo'),
(29, 1, 5, 2000000, 'activo'),
(30, 1, 5, 4000, 'activo'),
(31, 33, 10, 4000, 'activo'),
(32, 1, 6, 4000, 'activo'),
(33, 35, 9, 5000, 'activo'),
(34, 36, 4, 4000, 'activo'),
(35, 37, 4, 1000, 'activo'),
(36, 38, 4, 4000, 'activo'),
(37, 39, 4, 4000, 'activo'),
(38, 40, 4, 8000, 'activo'),
(39, 42, 4, 1000, 'activo'),
(40, 43, 4, 4000, 'activo'),
(41, 44, 4, 4000, 'activo'),
(42, 45, 4, 8000, 'activo'),
(43, 46, 4, 4000, 'activo'),
(44, 47, 4, 11000, 'activo'),
(45, 48, 4, 6312, 'activo'),
(46, 49, 4, 12000, 'activo'),
(47, 50, 4, 8000, 'activo'),
(48, 51, 1, 12000, 'activo'),
(49, 52, 1, 4000, 'activo'),
(50, 53, 1, 5000, 'activo'),
(51, 54, 1, 5000, 'activo'),
(52, 56, 1, 5000, 'activo'),
(53, 56, 1, 5000, 'activo'),
(54, 58, 7, 7500, 'activo'),
(55, 58, 7, 7500, 'activo'),
(56, 60, 7, 7500, 'activo'),
(57, 60, 7, 7500, 'activo'),
(58, 62, 7, 7500, 'activo'),
(59, 62, 7, 7500, 'activo'),
(60, 64, 1, 5000, 'activo'),
(61, 64, 1, 5000, 'activo'),
(62, 66, 1, 5000, 'activo'),
(63, 66, 1, 5000, 'activo'),
(64, 68, 1, 5000, 'activo'),
(65, 68, 1, 5000, 'activo'),
(66, 70, 1, 5000, 'activo'),
(67, 70, 1, 5000, 'activo'),
(68, 71, 5, 4000, 'activo'),
(69, 72, 5, 4000, 'activo'),
(70, 73, 6, 4000, 'activo'),
(71, 74, 4, 4000, 'activo'),
(72, 75, 4, 4000, 'activo'),
(73, 77, 1, 5000, 'activo'),
(74, 77, 1, 5000, 'activo'),
(75, 78, 4, 4000, 'activo'),
(76, 80, 1, 5000, 'activo'),
(77, 80, 1, 5000, 'activo'),
(78, 81, 7, 4000, 'activo'),
(79, 82, 1, 6000, 'activo'),
(80, 83, 5, 4000, 'activo'),
(81, 84, 5, 4000, 'activo'),
(82, 85, 5, 4000, 'activo'),
(83, 86, 6, 1000, 'activo');

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
  ADD PRIMARY KEY (`idcompramateriaprima`),
  ADD KEY `idpersona` (`idpersona`);

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
  ADD KEY `codigoproductoslacteos` (`codigoproductoslacteos`),
  ADD KEY `idventa` (`idventa`);

--
-- Indexes for table `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  ADD PRIMARY KEY (`iddetalleventa`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `idproductoveterinario` (`idproductoveterinario`);

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
-- Indexes for table `tbimagen`
--
ALTER TABLE `tbimagen`
  ADD PRIMARY KEY (`idimagen`),
  ADD UNIQUE KEY `idpersona` (`idpersona`);

--
-- Indexes for table `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`idimpuestoventa`);

--
-- Indexes for table `tbinteresprestamo`
--
ALTER TABLE `tbinteresprestamo`
  ADD PRIMARY KEY (`idinteres`);

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
-- Indexes for table `tbsolicitudprestamo`
--
ALTER TABLE `tbsolicitudprestamo`
  ADD PRIMARY KEY (`idsolicitud`),
  ADD KEY `idinteres` (`idinteres`),
  ADD KEY `idpersona` (`idpersona`),
  ADD KEY `idmodoplazo` (`idmodoplazo`);

--
-- Indexes for table `tbunidades`
--
ALTER TABLE `tbunidades`
  ADD PRIMARY KEY (`idunidad`);

--
-- Indexes for table `tbventa`
--
ALTER TABLE `tbventa`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `idpersonaventa` (`idpersonaventa`);

--
-- Indexes for table `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD PRIMARY KEY (`idventaporcobrar`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `idpersona` (`idpersona`);

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
  MODIFY `idahorro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbcobrovacaseca`
--
ALTER TABLE `tbcobrovacaseca`
  MODIFY `idcobrovacaseca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  MODIFY `idcompramateriaprima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbcuotavacaseca`
--
ALTER TABLE `tbcuotavacaseca`
  MODIFY `idcuotavacaseca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbfuncion`
--
ALTER TABLE `tbfuncion`
  MODIFY `idfuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbimagen`
--
ALTER TABLE `tbimagen`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbinteresprestamo`
--
ALTER TABLE `tbinteresprestamo`
  MODIFY `idinteres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbjuntadirectiva`
--
ALTER TABLE `tbjuntadirectiva`
  MODIFY `idjuntadirectiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idperiodopagoprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbpersona`
--
ALTER TABLE `tbpersona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  MODIFY `idpesalechediario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbpreciolitroleche`
--
ALTER TABLE `tbpreciolitroleche`
  MODIFY `idpreciolitroleche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `tbsolicitudprestamo`
--
ALTER TABLE `tbsolicitudprestamo`
  MODIFY `idsolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbunidades`
--
ALTER TABLE `tbunidades`
  MODIFY `idunidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbventa`
--
ALTER TABLE `tbventa`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  MODIFY `idventaporcobrar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
-- Constraints for table `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  ADD CONSTRAINT `tbcompramateriaprima_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbcuentabancaria`
--
ALTER TABLE `tbcuentabancaria`
  ADD CONSTRAINT `tbcuentabancaria_ibfk_1` FOREIGN KEY (`idpersonacuenta`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD CONSTRAINT `tbdetalleventa_ibfk_1` FOREIGN KEY (`codigoproductoslacteos`) REFERENCES `tbproductoslacteos` (`codigoproductoslacteos`),
  ADD CONSTRAINT `tbdetalleventa_ibfk_2` FOREIGN KEY (`idventa`) REFERENCES `tbventa` (`idventa`);

--
-- Constraints for table `tbempleado`
--
ALTER TABLE `tbempleado`
  ADD CONSTRAINT `tbempleado_ibfk_1` FOREIGN KEY (`idpersonaempleado`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbimagen`
--
ALTER TABLE `tbimagen`
  ADD CONSTRAINT `tbimagen_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`);

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
-- Constraints for table `tbsolicitudprestamo`
--
ALTER TABLE `tbsolicitudprestamo`
  ADD CONSTRAINT `tbsolicitudprestamo_ibfk_1` FOREIGN KEY (`idinteres`) REFERENCES `tbinteresprestamo` (`idinteres`),
  ADD CONSTRAINT `tbsolicitudprestamo_ibfk_2` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`),
  ADD CONSTRAINT `tbsolicitudprestamo_ibfk_3` FOREIGN KEY (`idmodoplazo`) REFERENCES `tbperiodopagoprestamo` (`idperiodopagoprestamo`);

--
-- Constraints for table `tbventa`
--
ALTER TABLE `tbventa`
  ADD CONSTRAINT `tbventa_ibfk_1` FOREIGN KEY (`idpersonaventa`) REFERENCES `tbpersona` (`idpersona`);

--
-- Constraints for table `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD CONSTRAINT `tbventaporcobrar_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `tbventa` (`idventa`),
  ADD CONSTRAINT `tbventaporcobrar_ibfk_2` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
