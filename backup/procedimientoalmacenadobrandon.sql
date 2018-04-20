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
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarempleado`(IN `clave` TEXT, IN `tipo` TEXT, IN `manipulacion` TEXT, IN `identidad` TEXT)
    NO SQL
INSERT INTO tbempleado(idpersonaempleado,passwordempleado,tipoempleado,   imagentitulomanipulacionalimentosempleado, imagendocumentoidentidadempleado,estadoempleado) VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1),clave,tipo,manipulacion,identidad,"activo")$$
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

/* obtiene producto lacteo buscado*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchproductlacteo`(IN `codigo` TEXT)
    NO SQL
    DETERMINISTIC
BEGIN
  SELECT nombreproductolacteo,preciounitarioproductolacteo
  FROM tbproductoslacteos
  WHERE codigoproductoslacteos=codigo LIMIT 1;
END$$
DELIMITER ;

/* muestra los procesos*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarProcesos`()
    NO SQL
BEGIN
SELECT * FROM tbproceso WHERE estadoproceso = "activo";
END$$
DELIMITER ;

/* registra un proceso*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarProceso`(IN `nombre` TEXT, IN `cantidad` DOUBLE, IN `porcentaje` DOUBLE, IN `entera` DOUBLE, IN `descremada` DOUBLE, IN `cuajo` DOUBLE, IN `cloruro` DOUBLE, IN `sal` DOUBLE, IN `cultivo` TEXT, IN `estabilizador` DOUBLE, IN `colorante` DOUBLE, IN `crema1` DOUBLE, IN `leche1` DOUBLE, IN `crema2` DOUBLE, IN `leche2` DOUBLE, IN `hora` TIME, IN `fecha` DATE)
    NO SQL
INSERT INTO tbproceso( productoproceso, cantidadproceso, porcentajegrasalecheproceso, lecheenteraproceso, lechedescremadaproceso, cuajoproceso, clorurdecalcioproceso, salproceso, cultivocodigoproceso, estabilizadorcodigo, colorateproceso, cremaproceso1, lecheproceso1, cremaproceso2, lecheproceso2, horaproceso, fechaproceso, estadoproceso) VALUES(nombre,cantidad,porcentaje,entera,descremada,cuajo,cloruro,sal,cultivo,estabilizador,colorante,crema1,leche1,crema2,leche2,hora,fecha,"activo")$$
DELIMITER ;

/* modifica un proceso*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificarproceso`(IN `nombre` TEXT, IN `cantidad` DOUBLE, IN `porcentaje` DOUBLE, IN `entera` DOUBLE, IN `descremada` DOUBLE, IN `cuajo` DOUBLE, IN `cloruro` DOUBLE, IN `sal` DOUBLE, IN `cultivo` TEXT, IN `estabilizador` DOUBLE, IN `colorante` DOUBLE, IN `crema1` DOUBLE, IN `leche1` DOUBLE, IN `crema2` DOUBLE, IN `leche2` DOUBLE, IN `hora` TIME, IN `fecha` DATE, IN `id` INT(30))
    NO SQL
UPDATE tbproceso SET productoproceso= nombre,cantidadproceso=cantidad,porcentajegrasalecheproceso=porcentaje,lecheenteraproceso=entera,lechedescremadaproceso=descremada,cuajoproceso=cuajo,clorurdecalcioproceso=cloruro,salproceso=sal,cultivocodigoproceso=cultivo,estabilizadorcodigo=estabilizador,colorateproceso=colorante,cremaproceso1=crema1,lecheproceso1=leche1,cremaproceso2=crema2,lecheproceso2=leche2,horaproceso=hora,fechaproceso=fecha WHERE idproceso = id$$
DELIMITER ;

/* elimina un proceso*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarproceso`(IN `id` INT(30))
    NO SQL
BEGIN
UPDATE tbproceso set estadoproceso='inactivo' WHERE idproceso=id AND estadoproceso='activo';
END$$
DELIMITER ;

/* suma la cantidad de un proceso al stock del producto*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sumastockproceso`(IN `cantidad` DOUBLE, IN `nombre` TEXT)
    NO SQL
UPDATE tbproductoslacteos SET cantidadinventarioproductolacteo = cantidadinventarioproductolacteo + cantidad WHERE nombreproductolacteo = nombre AND estadoproductoslacteos = "activo"$$
DELIMITER ;

/* resta la cantidad de un proceso al stock del producto*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `restastockproceso`(IN `cantidad` DOUBLE, IN `nombre` TEXT)
    NO SQL
UPDATE tbproductoslacteos SET cantidadinventarioproductolacteo = cantidadinventarioproductolacteo - cantidad WHERE nombreproductolacteo = nombre AND cantidadinventarioproductolacteo >= cantidad AND estadoproductoslacteos = "activo"$$
DELIMITER ;


/* muestra el precio de leche actual*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `verPrecioLeche`()
    NO SQL
SELECT * FROM `tbpreciolitroleche` WHERE estadopreciolitroleche = "activo"$$
DELIMITER ;

/* actualiza el precio de leche actual*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarPrecioLeche`(IN `precio` DOUBLE, IN `fecha` DATE, IN `id` INT)
    NO SQL
UPDATE tbpreciolitroleche SET preciolitroleche= precio ,fechainicio= fecha WHERE idpreciolitroleche = id AND estadopreciolitroleche = "activo"$$
DELIMITER ;

/* obtiene la lista de procesos entre un rango*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sacarReportesProcesos`(IN `inicio` DATE, IN `final` DATE)
    NO SQL
BEGIN
SELECT * FROM `tbproceso` 
WHERE fechaproceso>=inicio AND fechaproceso <=final;
END$$
DELIMITER ;

/* muestra una persona*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mostrarPersona`(IN `id` INT(30))
    NO SQL
SELECT `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona`, `direccionpersona`, `correopersona` FROM `tbpersona` WHERE idpersona= id$$
DELIMITER ;