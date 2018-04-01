DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarreportesventa`(IN `inicial` DATE, IN `final` DATE)
    NO SQL
BEGIN
SELECT `idventa`, `numerofactura`, `fechaventa`, `horaventa`, `totalbrutoventa`, `totalnetoventa`, `tipoventa`, `idpersonaventa` FROM `tbventa` 
WHERE fechaventa>=inicial AND fechaventa<=final;
END$$
DELIMITER ;
