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
UPDATE tbproductoslacteos SET cantidadinventarioproductolacteo = cantidadinventarioproductolacteo - cantidad WHERE nombreproductolacteo = nombre AND estadoproductoslacteos = "activo"$$
DELIMITER ;

/* obtiene la cantidad del producto*/
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtenercantidadproducto`(IN `id` INT(30))
    NO SQL
SELECT cantidadinventarioproductolacteo FROM tbproductoslacteos WHERE codigoproductoslacteos = id$$
DELIMITER ;