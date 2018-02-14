/* Mostrar todos los empleados*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarempleados`()
    NO SQL
BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona, tbempleado.tipoempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbempleado.estadoempleado="activo";
END$$
DELIMITER ;

/*insertar empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempleado`(IN `clave` VARCHAR(30), IN `tipo` TEXT)
    NO SQL
INSERT INTO tbempleado(idpersonaempleado,passwordempleado,tipoempleado,estadoempleado) VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1),clave,tipo,"activo")$$
DELIMITER ;

/*modificar empleados*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarempleados`(IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT, IN `id` INT(11))
    NO SQL
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id$$
DELIMITER ;

/* eliminar empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarempleado`(IN `id` VARCHAR(20))
    NO SQL
BEGIN
UPDATE tbempleado set estadoempleado='inactivo' WHERE idpersonaempleado=id AND estadoempleado='activo';
END$$
DELIMITER ;
