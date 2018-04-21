-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2018 a las 04:32:38
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarPrecioLeche` (IN `precio` DOUBLE, IN `fecha` DATE, IN `id` INT)  NO SQL
UPDATE tbpreciolitroleche SET preciolitroleche= precio ,fechainicio= fecha WHERE idpreciolitroleche = id AND estadopreciolitroleche = "activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `aprobarSolicitud` (IN `idsolicitud` INT, IN `idpersonaprestamo` INT, IN `tasainteres` DOUBLE, IN `montototalprestamo` DOUBLE, IN `montocuota` DOUBLE, IN `fechaprestamo` DATE)  BEGIN
  INSERT INTO  tbprestamos(idpersonaprestamo,tasainteres,montototalprestamo,montocuota,fechaprestamo) VALUES(idpersonaprestamo,tasainteres,montototalprestamo,montocuota,fechaprestamo);
  INSERT INTO  tbprestamosporcobrar(idprestamo,saldoactualprestamoporcobrar,estadoprestamoporcobrar) VALUES((SELECT idprestamo FROM tbprestamos ORDER BY idprestamo DESC LIMIT 1),montototalprestamo,"activo");
  UPDATE tbsolicitudprestamo SET estado='Aprobado' WHERE tbsolicitudprestamo.idsolicitud=idsolicitud AND estado="Solicitud"; END$$

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
SELECT tbempleado.tipoempleado ,tbempleado.passwordempleado,tbpersona.idpersona,tbpersona.nombrepersona, tbpersona.apellido1persona,tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.correopersona FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbpersona.documentoidentidadpersona=documentoidentidad AND tbempleado.estadoempleado="activo"$$

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
p.direccionpersona,p.correopersona
FROM tbpersona p
INNER JOIN tbclientemayorista t  ON
t.idpersonamayorista=p.idpersona 
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarSolicitudes` ()  BEGIN
       SELECT tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona,tbsolicitudprestamo.idsolicitud,tbsolicitudprestamo.plazo,tbperiodopagoprestamo.tipopagoprestamo,tbsolicitudprestamo.cantidadsolicitud,tbinteresprestamo.porcentaje,tbsolicitudprestamo.fecha FROM tbsolicitudprestamo INNER JOIN tbpersona ON tbsolicitudprestamo.idpersona=tbpersona.idpersona INNER JOIN tbperiodopagoprestamo ON tbperiodopagoprestamo.idperiodopagoprestamo=tbsolicitudprestamo.idmodoplazo INNER JOIN tbinteresprestamo ON tbinteresprestamo.idinteres= tbsolicitudprestamo.idinteres WHERE tbsolicitudprestamo.estado="Solicitud";


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

CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenerPrestamosActivos` (IN `idPersona` INT)  BEGIN
    SELECT tbprestamos.idprestamo,tbprestamos.fechaprestamo,tbprestamos.montototalprestamo,tbprestamos.montocuota,tbprestamosporcobrar.saldoactualprestamoporcobrar,tbprestamosporcobrar.idprestamoporcobrar FROM tbprestamos INNER JOIN tbprestamosporcobrar ON tbprestamos.idprestamo=tbprestamosporcobrar.idprestamo  WHERE tbprestamosporcobrar.estadoprestamoporcobrar="activo" AND tbprestamos.idpersonaprestamo=idPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pagarAhorro` (`idProductor` INT)  BEGIN
	UPDATE tbahorrosemanal SET estadoahorrosemanal='pagado' WHERE idpersonaahorro=idProductor AND estadoahorrosemanal='activo'; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rechazarSolicitud` (IN `idsolicitud` INT)  BEGIN
  UPDATE tbsolicitudprestamo SET estado='Rechazado' WHERE tbsolicitudprestamo.idsolicitud=idsolicitud AND estado="Solicitud";
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarPagoCuota` (`idPrestamoCobrar` INT, `saldoActual` DOUBLE, `nuevoSaldo` DOUBLE, `cuota` DOUBLE, `fecha` DATE, `hora` TIME, `estado` TEXT)  BEGIN
  UPDATE  tbprestamosporcobrar SET saldoactualprestamoporcobrar=nuevoSaldo, estadoprestamoporcobrar=estado WHERE idprestamoporcobrar=idPrestamoCobrar;
  INSERT INTO tbpagoprestamo(idprestamoporcobrar,saldoanteriorpagopretsamo,saldoactualpagoprestamo,montocuotapagoprestamo,fechapagoprestamo,horapagoprestamo) VALUES(idPrestamoCobrar,saldoActual,nuevoSaldo,cuota,fecha,hora);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaDistribuidor` (IN `id` INT)  NO SQL
BEGIN
SELECT d.codigoproductoslacteos,
l.nombreproductolacteo,
d.preciounitariodetalleventa,
 d.cantidaddetalleventa, 
 d.subtotaldetalleventa, 
 d.descuento,
 d.idventa, 
 d.iddetalleventa
 
FROM tbdetalleventa d INNER JOIN tbproductoslacteos l ON
l.codigoproductoslacteos=d.codigoproductoslacteos
WHERE d.idventa=id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaNombre` (IN `id` INT)  NO SQL
BEGIN
SELECT `nombrepersona`, `apellido1persona`, `apellido2persona` FROM `tbpersona` WHERE idpersona=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaVentanilla` (IN `id` INT)  NO SQL
BEGIN
SELECT d.codigoproductoslacteos,
l.nombreproductolacteo,
d.preciounitariodetalleventa,
 d.cantidaddetalleventa, 
 d.subtotaldetalleventa, 
 d.descuento,
 d.idventa, 
 d.iddetalleventa
 
FROM tbdetalleventa d INNER JOIN tbproductoslacteos l ON
l.codigoproductoslacteos=d.codigoproductoslacteos
WHERE d.idventa=id;

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesPagos` (IN `inicial` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT s.idpersonalechediario, s.idpesalechediario, 
        s.fechaentregalechediario, s.turnopesolechediario, 
        s.pesoturno, s.estadopesalechediario, p.nombrepersona,
        p.apellido1persona,p.apellido2persona 
        FROM tbpesalechediario s 
        INNER JOIN tbpersona p ON 
        p.idpersona=s.idpersonalechediario
        WHERE s.fechaentregalechediario>=inicial AND
         s.fechaentregalechediario<=final;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportespagosll` (IN `ini` DATE, IN `fi` DATE)  NO SQL
BEGIN
SELECT 
sip.idpersonalechediario, sip.idpesalechediario, 
sip.fechaentregalechediario, sip.turnopesolechediario, sip.pesoturno, sip.estadopesalechediario, poo.nombrepersona,
poo.apellido1persona,poo.apellido2persona 
FROM tbpesalechediario sip 
INNER JOIN tbpersona poo ON 
poo.idpersona=sip.idpersonalechediario
WHERE sip.fechaentregalechediario>=ini AND
sip.fechaentregalechediario<=fi;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesPrestamos` (IN `inicial` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT s.idsolicitud, p.nombrepersona,
        p.apellido1persona ,p.apellido2persona,
        r.porcentaje,s.cantidadsolicitud, s.plazo, 				t.tipopagoprestamo,
        s.fecha , s.estado FROM tbsolicitudprestamo s
        INNER JOIN tbperiodopagoprestamo t ON 
        t.idperiodopagoprestamo=s.idmodoplazo
        INNER JOIN tbinteresprestamo r ON
        r.idinteres=s.idinteres
        INNER JOIN tbpersona p ON
        p.idpersona=s.idpersona
        WHERE s.estado='Solicitud' AND 
        s.fecha>=inicial AND s.fecha<=final;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarReportesProcesos` (IN `inicio` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT * FROM `tbproceso` 
WHERE fechaproceso>=inicio AND fechaproceso <=final;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesventa` (IN `inicial` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreporteventadistribuidor` (IN `inicial` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final AND tipoventa='Distribuidor';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreporteventaventanilla` (IN `inicial` DATE, IN `final` DATE)  NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final AND tipoventa='Ventanilla';
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `verPrecioLeche` ()  NO SQL
SELECT * FROM `tbpreciolitroleche` WHERE estadopreciolitroleche = "activo"$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verReporteAhorro` (IN `fechaInicio` DATE, IN `fechaFinal` DATE)  BEGIN
	SELECT tbahorrosemanal.idahorro, tbahorrosemanal.montoahorrosemanalporlitro,tbahorrosemanal.litrosentregadosahorrosemanal,tbahorrosemanal.fechaentregapago,tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona FROM tbahorrosemanal INNER JOIN tbpersona ON tbahorrosemanal.idpersonaahorro=tbpersona.idpersona WHERE tbahorrosemanal.fechaentregapago BETWEEN fechaInicio AND fechaFinal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verReportePagoLeche` (`fechaInicio` DATE, `fechaFinal` DATE)  BEGIN
  SELECT tbcompramateriaprima.idcompramateriaprima, tbcompramateriaprima.cantidadlitroscompramateriaprima,tbcompramateriaprima.montopagolitro,tbcompramateriaprima.totalpagarlitros,tbcompramateriaprima.fechacompramateriaprima,tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona FROM tbcompramateriaprima INNER JOIN tbpersona ON tbcompramateriaprima.idpersona=tbpersona.idpersona WHERE tbcompramateriaprima.fechacompramateriaprima BETWEEN fechaInicio AND fechaFinal;
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
  `idpersona` int(11) NOT NULL,
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
  `preciounitariodetalleventa` double NOT NULL,
  `cantidaddetalleventa` double NOT NULL,
  `subtotaldetalleventa` double NOT NULL,
  `codigoproductoslacteos` varchar(50) DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `idventa` int(11) NOT NULL,
  `iddetalleventa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbdetalleventaveterinaria`
--

CREATE TABLE `tbdetalleventaveterinaria` (
  `iddetalleventa` int(11) NOT NULL,
  `preciounitariodetalleventa` double DEFAULT NULL,
  `cantidaddetalleventa` int(11) DEFAULT NULL,
  `subtotaldetalleventa` double DEFAULT NULL,
  `idventa` int(11) NOT NULL,
  `idproductoveterinario` int(11) NOT NULL
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
(1, '$2y$10$jn8r0TfldNvzM7yya86QzOpX75AWud1fZTMCNsoejRLKDA0I2qg6W', 'Administrador', NULL, NULL, 'activo'),
(10, '$2y$10$SdrxlHlOKbR9BywtBoFx2./.eiyk4FuZsp4cy/YnXt1TCkudXGn1.', 'Bodega', NULL, NULL, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfacturero`
--

CREATE TABLE `tbfacturero` (
  `ultimafactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbfuncion`
--

CREATE TABLE `tbfuncion` (
  `idfuncion` int(11) NOT NULL,
  `nombrefuncion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbfuncion`
--

INSERT INTO `tbfuncion` (`idfuncion`, `nombrefuncion`) VALUES
(1, 'Analgésicos-Antiinflamatorios'),
(2, 'Antiinfecciosos'),
(3, 'Calmantes'),
(4, 'Antiparasitarios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbimagen`
--

CREATE TABLE `tbimagen` (
  `idimagen` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `nombreimagen` varchar(60) NOT NULL,
  `rutaimagen` varchar(60) NOT NULL
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
-- Estructura de tabla para la tabla `tbinteresprestamo`
--

CREATE TABLE `tbinteresprestamo` (
  `idinteres` int(11) NOT NULL,
  `porcentaje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbinteresprestamo`
--

INSERT INTO `tbinteresprestamo` (`idinteres`, `porcentaje`) VALUES
(1, 5),
(2, 10),
(3, 20);

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

--
-- Volcado de datos para la tabla `tbjuntadirectiva`
--

INSERT INTO `tbjuntadirectiva` (`idjuntadirectiva`, `fechainicioperiodo`, `fechafinalperiodo`, `presidente`, `vicepresidente`, `secretario`, `tesorero`, `fiscal`, `vocal1`, `vocal2`) VALUES
(1, '2018-02-01', '2018-02-24', 'Kervn', 'Nathalia', 'Lilliam', 'Hector', 'Minor', 'Sergio', 'Olman');

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

--
-- Volcado de datos para la tabla `tbpagoprestamo`
--

INSERT INTO `tbpagoprestamo` (`idpagoprestamo`, `idprestamoporcobrar`, `saldoanteriorpagopretsamo`, `saldoactualpagoprestamo`, `montocuotapagoprestamo`, `fechapagoprestamo`, `horapagoprestamo`) VALUES
(1, 1, 400000, 384000, 16000, '0000-00-00', '12:15:00'),
(2, 1, 384000, 368000, 16000, '2018-04-13', '12:15:00'),
(3, 1, 368000, 352000, 16000, '2018-04-13', '12:16:00'),
(4, 1, 352000, 336000, 16000, '2018-04-13', '12:17:00'),
(5, 1, 336000, 320000, 16000, '2018-04-13', '12:17:00'),
(6, 1, 320000, 0, 320000, '2018-04-13', '12:17:00'),
(7, 2, 450000, 450000, 0, '2018-04-13', '12:22:00'),
(8, 2, 450000, 450000, 0, '2018-04-13', '12:22:00'),
(9, 2, 450000, 450000, 0, '2018-04-13', '12:22:00'),
(10, 2, 450000, 430000, 20000, '2018-04-14', '11:46:00'),
(11, 3, 100000, 90000, 10000, '2018-04-14', '11:59:00');

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

--
-- Volcado de datos para la tabla `tbperiodopagoprestamo`
--

INSERT INTO `tbperiodopagoprestamo` (`idperiodopagoprestamo`, `tipopagoprestamo`) VALUES
(1, 'mes'),
(2, 'semana'),
(3, 'quincena'),
(4, '22 días');

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
(1, '402060267', 'Nathalia', 'Ovares', 'Vindas', '87539494', 'San Pablo', 'nathy@gmail.com'),
(4, '206990696', 'David', 'Salas', 'Lorente', '85479654', 'la virgen', 'david@gmail.com'),
(8, '302640297', 'Hector', 'Araya', 'Cordero', '88888888', 'El Sauce', 'N/A'),
(9, '473739927', 'Enrique', 'Albaro', 'Perez', '8667899', 'La Virgen', 'gga@hhd.com'),
(10, '305020820', 'Kervin JosÃ©', 'Araya', 'Romero', '88776655', '', 'ker@gmail.com'),
(13, '123', 'Brandon', 'Rodriguez', 'Mendez', '62091232', 'Sauce', 'brandon-ndsi@hotmail.com');

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

--
-- Volcado de datos para la tabla `tbpreciolitroleche`
--

INSERT INTO `tbpreciolitroleche` (`idpreciolitroleche`, `preciolitroleche`, `fechainicio`, `estadopreciolitroleche`) VALUES
(1, 300, '2018-04-14', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbprestamos`
--

CREATE TABLE `tbprestamos` (
  `idprestamo` int(11) NOT NULL,
  `idpersonaprestamo` int(11) NOT NULL,
  `tasainteres` double NOT NULL,
  `montototalprestamo` double NOT NULL,
  `montocuota` double NOT NULL,
  `fechaprestamo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbprestamos`
--

INSERT INTO `tbprestamos` (`idprestamo`, `idpersonaprestamo`, `tasainteres`, `montototalprestamo`, `montocuota`, `fechaprestamo`) VALUES
(1, 1, 15, 4000000, 16000, '2018-04-02'),
(2, 1, 15, 450000, 20000, '2018-04-03'),
(3, 1, 10, 100000, 190909.09090909, '2018-04-05'),
(4, 1, 10, 100000, 190909.09090909, '2018-04-05'),
(5, 1, 15, 100000, 10000, '2018-04-05'),
(6, 1, 15, 100000, 10000, '2018-04-05'),
(7, 1, 15, 100000, 10000, '2018-04-05'),
(8, 8, 10, 200000, 290909.09090909, '2018-04-05'),
(9, 1, 10, 100000, 190909.09090909, '2018-04-05'),
(10, 1, 10, 100000, 190909.09090909, '2018-04-05'),
(11, 9, 10, 150000, 286363.63636364, '2018-04-05'),
(12, 8, 10, 200000, 290909.09090909, '2018-04-05');

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

--
-- Volcado de datos para la tabla `tbprestamosporcobrar`
--

INSERT INTO `tbprestamosporcobrar` (`idprestamoporcobrar`, `idprestamo`, `saldoactualprestamoporcobrar`, `estadoprestamoporcobrar`) VALUES
(1, 1, 0, 'pagado'),
(2, 2, 430000, 'activo'),
(3, 6, 90000, 'activo'),
(4, 7, 100000, 'activo'),
(5, 8, 200000, 'activo'),
(6, 9, 100000, 'activo'),
(7, 10, 100000, 'activo'),
(8, 11, 150000, 'activo'),
(9, 12, 200000, 'activo');

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
  `fechaproceso` date NOT NULL,
  `estadoproceso` text NOT NULL
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

--
-- Volcado de datos para la tabla `tbproductorcliente`
--

INSERT INTO `tbproductorcliente` (`idpersonacliente`, `ahorroporlitroproductorcliente`, `imagencboproductorcliente`, `imagenexamensangradoproductorcliente`, `imagenescrituraproductorcliente`, `imagenreciboluzproductorcliente`, `imagenrecibaguaproductorcliente`, `imagenexamensolidoproductorcliente`, `imagenplanofincaproductorcliente`, `imagendocumentoidentidadproductorcliente`, `estadoproductorcliente`) VALUES
(8, 10, '../../image/productor/cliente/cbo.jpg', '../../image/productor/cliente/sangrado.jpg', '../../image/productor/cliente/escritura.jpg', '../../image/productor/cliente/luz.jpg', '../../image/productor/cliente/agua.jpg', '../../image/productor/cliente/solido.jpg', '../../image/productor/cliente/plano.jpg', '../../image/productor/cliente/cedula.jpg', 'activo');

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
(1, 10, '../../image/productor/socio/cbo.jpg', '../../image/productor/socio/sangrado.jpg', '../../image/productor/socio/escritura.jpg', '../../image/productor/socio/luz.jpg', '../../image/productor/socio/agua.jpg', '../../image/productor/socio/solido.jpg', '../../image/productor/socio/plano.jpg', '../../image/productor/socio/cedula.jpg', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproductoslacteos`
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
-- Volcado de datos para la tabla `tbproductoslacteos`
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
  `funcionveterinarios` int(11) NOT NULL,
  `precioproductoveterinario` double NOT NULL,
  `estadoproductoveterinario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbproductosveterinarios`
--

INSERT INTO `tbproductosveterinarios` (`idproductoveterinario`, `codigoproductoveterinario`, `nombreproductoveterinario`, `descripcionproductoveterinario`, `dosisproductoveterinario`, `diasretencionlecheproductoveterinario`, `viaaplicacionveterinarios`, `funcionveterinarios`, `precioproductoveterinario`, `estadoproductoveterinario`) VALUES
(1, '566788', 'Ectoline', 'Medicamento para parasitos', '1 cc', 0, 3, 2, 5000, 'activo'),
(2, '3456789', 'lolita', 'sirve para curar', '2cc', 2, 2, 3, 400, 'activo'),
(3, '345678', 'GG', 'dfghjk', '300', 0, 2, 2, 0, 'inactivo'),
(7, '344567', 'Paracetamol', 'sirve para el dolor de cabeza', '22 cc', 7, 1, 1, 2500, 'activo'),
(8, '10002', 'Agua Florida', 'Para dolor de nuca', '2 cc', 2, 1, 1, 2500, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbsolicitudprestamo`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbunidades`
--

CREATE TABLE `tbunidades` (
  `idunidad` int(11) NOT NULL,
  `unidad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbunidades`
--

INSERT INTO `tbunidades` (`idunidad`, `unidad`) VALUES
(1, 'Kilogramos'),
(2, 'Litros'),
(3, 'Gramos');

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
  `tipoventa` text NOT NULL,
  `idpersonaventa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbventaporcobrar`
--

CREATE TABLE `tbventaporcobrar` (
  `idventaporcobrar` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
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
-- Volcado de datos para la tabla `tbviaaplicacion`
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
  ADD PRIMARY KEY (`idcompramateriaprima`),
  ADD KEY `idpersona` (`idpersona`);

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
  ADD PRIMARY KEY (`iddetalleventa`),
  ADD KEY `codigoproductoslacteos` (`codigoproductoslacteos`),
  ADD KEY `idventa` (`idventa`);

--
-- Indices de la tabla `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  ADD PRIMARY KEY (`iddetalleventa`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `idproductoveterinario` (`idproductoveterinario`);

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
-- Indices de la tabla `tbimagen`
--
ALTER TABLE `tbimagen`
  ADD PRIMARY KEY (`idimagen`),
  ADD UNIQUE KEY `idpersona` (`idpersona`);

--
-- Indices de la tabla `tbimpuestoventa`
--
ALTER TABLE `tbimpuestoventa`
  ADD PRIMARY KEY (`idimpuestoventa`);

--
-- Indices de la tabla `tbinteresprestamo`
--
ALTER TABLE `tbinteresprestamo`
  ADD PRIMARY KEY (`idinteres`);

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
-- Indices de la tabla `tbsolicitudprestamo`
--
ALTER TABLE `tbsolicitudprestamo`
  ADD PRIMARY KEY (`idsolicitud`),
  ADD KEY `idinteres` (`idinteres`),
  ADD KEY `idpersona` (`idpersona`),
  ADD KEY `idmodoplazo` (`idmodoplazo`);

--
-- Indices de la tabla `tbunidades`
--
ALTER TABLE `tbunidades`
  ADD PRIMARY KEY (`idunidad`);

--
-- Indices de la tabla `tbventa`
--
ALTER TABLE `tbventa`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `idpersonaventa` (`idpersonaventa`);

--
-- Indices de la tabla `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD PRIMARY KEY (`idventaporcobrar`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `idpersona` (`idpersona`);

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
-- AUTO_INCREMENT de la tabla `tbdetalleventaveterinaria`
--
ALTER TABLE `tbdetalleventaveterinaria`
  MODIFY `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbfuncion`
--
ALTER TABLE `tbfuncion`
  MODIFY `idfuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbimagen`
--
ALTER TABLE `tbimagen`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbinteresprestamo`
--
ALTER TABLE `tbinteresprestamo`
  MODIFY `idinteres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbjuntadirectiva`
--
ALTER TABLE `tbjuntadirectiva`
  MODIFY `idjuntadirectiva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbpagoprestamo`
--
ALTER TABLE `tbpagoprestamo`
  MODIFY `idpagoprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbpagoventa`
--
ALTER TABLE `tbpagoventa`
  MODIFY `idpagoventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbperiodopagoprestamo`
--
ALTER TABLE `tbperiodopagoprestamo`
  MODIFY `idperiodopagoprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbpersona`
--
ALTER TABLE `tbpersona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbpesalechediario`
--
ALTER TABLE `tbpesalechediario`
  MODIFY `idpesalechediario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbpreciolitroleche`
--
ALTER TABLE `tbpreciolitroleche`
  MODIFY `idpreciolitroleche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbprestamos`
--
ALTER TABLE `tbprestamos`
  MODIFY `idprestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbprestamosporcobrar`
--
ALTER TABLE `tbprestamosporcobrar`
  MODIFY `idprestamoporcobrar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbproceso`
--
ALTER TABLE `tbproceso`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbproductoresvacaseca`
--
ALTER TABLE `tbproductoresvacaseca`
  MODIFY `idproductoresvacaseca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbproductosveterinarios`
--
ALTER TABLE `tbproductosveterinarios`
  MODIFY `idproductoveterinario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbsolicitudprestamo`
--
ALTER TABLE `tbsolicitudprestamo`
  MODIFY `idsolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbunidades`
--
ALTER TABLE `tbunidades`
  MODIFY `idunidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbventa`
--
ALTER TABLE `tbventa`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  MODIFY `idventaporcobrar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `tbviaaplicacion`
--
ALTER TABLE `tbviaaplicacion`
  MODIFY `idviaaplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Filtros para la tabla `tbcompramateriaprima`
--
ALTER TABLE `tbcompramateriaprima`
  ADD CONSTRAINT `tbcompramateriaprima_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbcuentabancaria`
--
ALTER TABLE `tbcuentabancaria`
  ADD CONSTRAINT `tbcuentabancaria_ibfk_1` FOREIGN KEY (`idpersonacuenta`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbdetalleventa`
--
ALTER TABLE `tbdetalleventa`
  ADD CONSTRAINT `tbdetalleventa_ibfk_1` FOREIGN KEY (`codigoproductoslacteos`) REFERENCES `tbproductoslacteos` (`codigoproductoslacteos`),
  ADD CONSTRAINT `tbdetalleventa_ibfk_2` FOREIGN KEY (`idventa`) REFERENCES `tbventa` (`idventa`);

--
-- Filtros para la tabla `tbempleado`
--
ALTER TABLE `tbempleado`
  ADD CONSTRAINT `tbempleado_ibfk_1` FOREIGN KEY (`idpersonaempleado`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbimagen`
--
ALTER TABLE `tbimagen`
  ADD CONSTRAINT `tbimagen_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`);

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
-- Filtros para la tabla `tbsolicitudprestamo`
--
ALTER TABLE `tbsolicitudprestamo`
  ADD CONSTRAINT `tbsolicitudprestamo_ibfk_1` FOREIGN KEY (`idinteres`) REFERENCES `tbinteresprestamo` (`idinteres`),
  ADD CONSTRAINT `tbsolicitudprestamo_ibfk_2` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`),
  ADD CONSTRAINT `tbsolicitudprestamo_ibfk_3` FOREIGN KEY (`idmodoplazo`) REFERENCES `tbperiodopagoprestamo` (`idperiodopagoprestamo`);

--
-- Filtros para la tabla `tbventa`
--
ALTER TABLE `tbventa`
  ADD CONSTRAINT `tbventa_ibfk_1` FOREIGN KEY (`idpersonaventa`) REFERENCES `tbpersona` (`idpersona`);

--
-- Filtros para la tabla `tbventaporcobrar`
--
ALTER TABLE `tbventaporcobrar`
  ADD CONSTRAINT `tbventaporcobrar_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `tbventa` (`idventa`),
  ADD CONSTRAINT `tbventaporcobrar_ibfk_2` FOREIGN KEY (`idpersona`) REFERENCES `tbpersona` (`idpersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
