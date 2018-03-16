/* Mostrar todos los empleados*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarempleados`()
    NO SQL
BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona, tbempleado.tipoempleado, tbempleado.passwordempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbempleado.estadoempleado="activo";
END$$
DELIMITER ;

/*insertar empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempleado`(IN `clave` TEXT, IN `tipo` TEXT)
    NO SQL
INSERT INTO tbempleado(idpersonaempleado,passwordempleado,tipoempleado,estadoempleado) VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1),clave,tipo,"activo")$$
DELIMITER ;

/* eliminar empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarempleado`(IN `id` VARCHAR(20))
    NO SQL
BEGIN
UPDATE tbempleado set estadoempleado='inactivo' WHERE idpersonaempleado=id AND estadoempleado='activo';
END$$
DELIMITER ;

/* actualizar la tabla persona de un empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarempleadopersona`(IN `cedula` VARCHAR(30), IN `nombre` TEXT, IN `apellido1` TEXT, IN `apellido2` TEXT, IN `telefono` VARCHAR(15), IN `direccion` TEXT, IN `correo` TEXT, IN `id` INT(11))
    NO SQL
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id$$
DELIMITER ;

/* actualiza la tabla empleado de un empleado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarempleados`(IN `id` VARCHAR(30), IN `clave` TEXT, IN `tipo` TEXT)
    NO SQL
UPDATE tbempleado SET passwordempleado=clave,tipoempleado=tipo
WHERE idpersonaempleado=id and estadoempleado="activo"$$
DELIMITER ;

/* muestra la junta directiva*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarJuntaDirectiva`()
    NO SQL
BEGIN
SELECT tbjuntadirectiva.idjuntadirectiva,tbjuntadirectiva.fechainicioperiodo,tbjuntadirectiva.fechafinalperiodo,tbjuntadirectiva.presidente, tbjuntadirectiva.vicepresidente,tbjuntadirectiva.secretario,tbjuntadirectiva.tesorero,tbjuntadirectiva.fiscal, tbjuntadirectiva.vocal1, tbjuntadirectiva.vocal2 FROM tbjuntadirectiva;
END$$
DELIMITER ;

/* ingresar junta directiva*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarjuntadirectiva`(IN `presidente` TEXT, IN `vicepresidente` TEXT, IN `secretario` TEXT, IN `tesorero` TEXT, IN `fiscal` TEXT, IN `vocal1` TEXT, IN `vocal2` TEXT, IN `inicio` DATE, IN `final` DATE)
    NO SQL
INSERT INTO tbjuntadirectiva(presidente, vicepresidente, secretario, tesorero, fiscal, vocal1, vocal2,fechainicioperiodo, fechafinalperiodo) VALUES (presidente,vicepresidente,secretario,tesorero,fiscal,vocal1,vocal2,inicio,final)$$
DELIMITER ;

/* modificar junta directiva*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarJuntaDirectiva`(IN `presidente` TEXT, IN `vicepresidente` TEXT, IN `secretario` TEXT, IN `tesorero` TEXT, IN `fiscal` TEXT, IN `vocal1` TEXT, IN `vocal2` TEXT, IN `inicio` DATE, IN `final` DATE, IN `id` VARCHAR(30))
    NO SQL
BEGIN
UPDATE tbjuntadirectiva SET presidente=presidente,vicepresidente=vicepresidente,secretario=secretario,tesorero=tesorero,fiscal=fiscal,vocal1=vocal1,vocal2=vocal2,fechainicioperiodo=inicio,fechafinalperiodo=final WHERE idjuntadirectiva = id;
END$$
DELIMITER ;

/* loguin actualizado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(IN `documentoidentidad` VARCHAR(50))
    NO SQL
SELECT tbempleado.passwordempleado,tbpersona.idpersona,tbpersona.nombrepersona, tbpersona.apellido1persona,tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.correopersona FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbpersona.documentoidentidadpersona=documentoidentidad AND tbempleado.estadoempleado="activo"$$
DELIMITER ;

/* modificar contra*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarcontrasenia`(IN `id` VARCHAR(30), IN `pass` TEXT)
    NO SQL
UPDATE tbempleado SET  passwordempleado=pass WHERE idpersonaempleado = id$$
DELIMITER ;

/* login2 */
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login2`(IN `idpersona` VARCHAR(50))
    NO SQL
SELECT tbempleado.passwordempleado FROM tbempleado INNER JOIN tbpersona ON tbempleado.idpersonaempleado=tbpersona.idpersona WHERE tbpersona.idpersona=idpersona AND tbempleado.estadoempleado="activo"$$
DELIMITER ;