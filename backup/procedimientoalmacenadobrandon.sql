/* Mostrar todos los empleados*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarempleados`()
    NO SQL
BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona, tbempleado.tipoempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbempleado.estadoempleado="activo";
END$$
DELIMITER ;


/* eliminar empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarempleado`(IN `id` VARCHAR(20))
    NO SQL
BEGIN
UPDATE tbempleado set estadoempleado='inactivo' WHERE idpersonaempleado=id AND estadoempleado='activo';
END$$
DELIMITER ;

/*insertar persona*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarpersona`(IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT)
    NO SQL
BEGIN
INSERT INTO tbpersona(documentoidentidadpersona, nombrepersona, apellido1persona, apellido2persona, telefonopersona, direccionpersona, correopersona) VALUES (cedula,nombre,apellido1,apellido2,telefono,direccion,correo);
END$$
DELIMITER ;

/*insertar empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarempleado`(IN `id` VARCHAR(30), IN `clave` TEXT, IN `tipo` TEXT, IN `estado` TEXT)
    NO SQL
BEGIN
INSERT INTO tbempleado(idpersonaempleado, passwordempleado,  tipoempleado, estadoempleado)
VALUES (id, clave, tipo, estado);
END$$
DELIMITER ;

/* buscar id de persona*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarPersonaID`(IN `cedula` VARCHAR(30))
    NO SQL
BEGIN
SELECT idpersona
FROM tbpersona 
WHERE documentoidentidadpersona = cedula;
END$$
DELIMITER ;