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

