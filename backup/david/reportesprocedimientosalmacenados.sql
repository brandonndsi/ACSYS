DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesventa`(IN `inicial` DATE, IN `final` DATE)
    NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVeterinario`(IN `id` INT)
    NO SQL
BEGIN
SELECT v.codigoproductoveterinario,
v.nombreproductoveterinario, 
d.preciounitariodetalleventa,
d.cantidaddetalleventa 
FROM tbdetalleventaveterinaria d 
INNER JOIN tbproductosveterinarios v ON d.idproductoveterinario=v.idproductoveterinario
WHERE d.idventa=id;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaNombre`(IN `id` INT)
    NO SQL
BEGIN
SELECT `nombrepersona`, `apellido1persona`, `apellido2persona` FROM `tbpersona` WHERE idpersona=id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaDistribuidor`(IN `id` INT)
    NO SQL
BEGIN
SELECT d.preciounitariodetalleventa, d.cantidaddetalleventa, d.subtotaldetalleventa, d.codigoproductoslacteos, d.descuento,d.idventa, d.iddetalleventa,l.nombreproductolacteo
FROM tbdetalleventa d INNER JOIN tbproductoslacteos l ON
l.codigoproductoslacteos=d.codigoproductoslacteos
WHERE d.idventa=id;

END$$
DELIMITER ;



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesPrestamos`(IN `inicial` DATE, IN `final` DATE)
    NO SQL
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesPagos`(IN `inicial` DATE, IN `final` DATE)
    NO SQL
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
DELIMITER ;






DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreporteventadistribuidor`(IN `inicial` DATE, IN `final` DATE)
    NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final AND tipoventa='Distribuidor';
END$$
DELIMITER ;



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreporteventaventanilla`(IN `inicial` DATE, IN `final` DATE)
    NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final AND tipoventa='Ventanilla';
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaDistribuidor`(IN `id` INT)
    NO SQL
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
DELIMITER ;



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarDetalleVentaVentanilla`(IN `id` INT)
    NO SQL
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
DELIMITER ;




DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrardetalleventadistribuidor`(IN `pre` DOUBLE, IN `can` DOUBLE, IN `sub` DOUBLE, IN `cod` VARCHAR(200), IN `des` DOUBLE, IN `id` INT)
    NO SQL
BEGIN
INSERT INTO tbdetalleventa(preciounitariodetalleventa,cantidaddetalleventa,subtotaldetalleventa, codigoproductoslacteos,descuento,idventa) VALUES (pre,can,sub,cod,des,id);
END$$
DELIMITER ;