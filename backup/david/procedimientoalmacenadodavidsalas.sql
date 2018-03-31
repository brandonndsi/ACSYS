DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarDistribuidor`()
    NO SQL
BEGIN
SELECT * FROM tbpersona p
INNER JOIN tbclientemayorista t  ON t.idpersonamayorista=p.idpersona WHERE t.estadoclientemayorista='activo';
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarDistribuidor`(IN `cedula` VARCHAR(30), IN `nombre` VARCHAR(30), IN `apellido1` VARCHAR(30), IN `apellido2` VARCHAR(30), IN `telefono` INT, IN `direccion` VARCHAR(30), IN `correo` VARCHAR(30), IN `id` INT)
    NO SQL
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
DELIMITER ;



DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `extraeridpersona`(IN `id` VARCHAR(30))
    NO SQL
BEGIN
SELECT `idpersona`FROM `tbpersona` WHERE documentoidentidadpersona=id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `nuevoclientemayorista`(IN `id` INT, IN `estado` VARCHAR(20))
    NO SQL
BEGIN
INSERT INTO `tbclientemayorista`(`idpersonamayorista`, `estadoclientemayorista`) VALUES (id,estado);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarclientemayorista`(IN `id` INT)
    NO SQL
BEGIN
UPDATE `tbclientemayorista` SET `estadoclientemayorista`='Inactivo'
WHERE idpersonamayorista=id;
END$$
DELIMITER ;


/*nuevos procedimientos mios*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarcliente`(IN `id` INT)
    NO SQL
BEGIN
SELECT `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona` FROM `tbpersona` WHERE idpersona=id;

END$$
DELIMITER ;
/*Producto modificado para poder hacer el ingreso de los datos**/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarDetalleVenta`(IN `precio` DOUBLE, IN `cantidad` INT, IN `total` DOUBLE, IN `codigo` VARCHAR(50), IN `descuento` DOUBLE, IN `idventa` INT)
    NO SQL
    DETERMINISTIC
BEGIN
INSERT INTO tbdetalleventa(preciounitariodetalleventa, cantidaddetalleventa, subtotaldetalleventa, codigoproductoslacteos, descuento, idventa) VALUES (precio,cantidad,total,codigo,descuento,idventa);
END$$
DELIMITER ;
/*Alteracion de mi metodo de datos de el nombre del cliente*/

/*fecha 30/03/2018*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenproductorcliente`(IN `id` INT)
    NO SQL
BEGIN
SELECT `imagencboproductorcliente`, `imagenexamensangradoproductorcliente`, `imagenescrituraproductorcliente`, `imagenreciboluzproductorcliente`, `imagenrecibaguaproductorcliente`, `imagenexamensolidoproductorcliente`, `imagenplanofincaproductorcliente`, `imagendocumentoidentidadproductorcliente`
FROM `tbproductorcliente` WHERE idpersonacliente=id AND estadoproductorcliente='activo';
END$$
DELIMITER ;
/*modificacion de un metodo de la optencion de la imagen del distribuidor para obtener la imagen*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarDistribuidor`()
    NO SQL
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
DELIMITER ;
/*terminacion de los datos*/

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenproductorcliente`(IN `id` INT)
    NO SQL
BEGIN
SELECT `imagencboproductorcliente`, `imagenexamensangradoproductorcliente`, `imagenescrituraproductorcliente`, `imagenreciboluzproductorcliente`, `imagenrecibaguaproductorcliente`, `imagenexamensolidoproductorcliente`, `imagenplanofincaproductorcliente`, `imagendocumentoidentidadproductorcliente`
FROM `tbproductorcliente` WHERE idpersonacliente=id AND estadoproductorcliente='activo';
END$$
DELIMITER ;
/***************************************************************/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenproductorsocio`(IN `id` INT)
    NO SQL
BEGIN
SELECT `imagencboproductorsocio`, `imagenexamensangradoproductorsocio`, `imagenescrituraproductorsocio`, `imagenreciboluzproductorsocio`, `imagenrecibaguaproductorsocio`, `imagenexamensolidoproductorsocio`, `imagenplanofincaproductorsocio`, `imagendocumentoidentidadproductorsocio` FROM `tbproductorsocio` WHERE idpersonasocio=id AND estadoproductorsocio='activo';
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarimagenEmpleado`(IN `id` INT)
    NO SQL
BEGIN
SELECT `imagentitulomanipulacionalimentosempleado`, `imagendocumentoidentidadempleado`
FROM `tbempleado` WHERE idpersonaempleado=id  AND estadoempleado='activo';
END$$
DELIMITER ;
