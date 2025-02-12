INSERT INTO tbpersona(documentoidentidadpersona,nombrepersona, apellido1persona,apellido2persona,telefonopersona,direccionpersona,correopersona) VALUES (cedula,nombre,apellido1,apellido2,telefono,direccion,correo);

INSERT INTO tbproductorsocio(idpersonasocio,estadoproductorsocio,ahorroporlitroproductorsocio) VALUES (SELECT idpersona FROM tbpersona order by idpersona desc limit 1, "activo",0);

DELIMITER $$
CREATE PROCEDURE mostrarproductoresclientes()
BEGIN
SELECT tbpersona.idpersona,tbpersona.documentoidentidadpersona,tbpersona.nombrepersona,tbpersona.apellido1persona, tbpersona.apellido2persona,tbpersona.telefonopersona,tbpersona.direccionpersona,tbpersona.correopersona FROM tbproductorcliente INNER JOIN tbpersona ON tbproductorcliente.idpersonacliente=tbpersona.idpersona WHERE tbproductorcliente.estadoproductorcliente="activo";
END$$
DELIMITER $$



DELIMITER $$
CREATE PROCEDURE eliminarproductorsocio(id INT)
BEGIN
UPDATE tbproductorsocio SET estadoproductorsocio="inactivo" WHERE idpersonasocio=id;
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE eliminarproductorcliente(id INT)
BEGIN
UPDATE tbproductorcliente SET estadoproductorcliente="inactivo" WHERE idpersonacliente=id;
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE registrarproductorcliente()
BEGIN
BEGIN INSERT INTO tbproductorcliente(idpersonacliente,estadoproductorcliente,ahorroporlitroproductorcliente) VALUES ((SELECT idpersona FROM tbpersona order by idpersona desc limit 1), "activo",0);
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE mostrarproductolacteo()
BEGIN
SELECT  tbproductoslacteos.codigoproductoslacteos,tbproductoslacteos.nombreproductolacteo,tbproductoslacteos.preciounitarioproductolacteo,tbproductoslacteos.cantidadinventarioproductolacteo,tbunidades.unidad FROM tbproductoslacteos INNER JOIN tbunidades ON tbproductoslacteos.unidadproductoslacteos=tbunidades.idunidad WHERE tbproductoslacteos.estadoproductoslacteos="activo";
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE modificarproductolacteo(codigo varchar(50),nombre text,precio double,cantidad double,unidad int)
BEGIN
UPDATE tbproductoslacteos SET nombreproductolacteo=nombre,preciounitarioproductolacteo=precio,cantidadinventarioproductolacteo=cantidad,unidadproductoslacteos=unidad WHERE codigoproductoslacteos=codigo;
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE mostrarunidades()
BEGIN
SELECT  tbunidades.unidad FROM tbunidades;
END$$
DELIMITER $$



DELIMITER $$
CREATE PROCEDURE eliminarproductolacteo(codigo INT)
BEGIN
UPDATE tbproductoslacteos SET estadoproductoslacteos="inactivo" WHERE codigoproductoslacteos=codigo;
END$$
DELIMITER $$




DELIMITER $$
CREATE PROCEDURE registrarproductolacteo(codigo varchar(50),nombre text,precio double,cantidad double,unidad int )
BEGIN
INSERT INTO tbproductoslacteos (codigoproductoslacteos,nombreproductolacteo,preciounitarioproductolacteo,cantidadinventarioproductolacteo,estadoproductoslacteos,unidadproductoslacteos)
VALUES (codigo,nombre,precio,cantidad,"activo",unidad);
END$$
DELIMITER $$




DELIMITER $$
CREATE PROCEDURE mostrarproductoveterinario()
BEGIN
SELECT  tbproductosveterinarios.codigoproductoveterinario,tbproductosveterinarios.nombreproductoveterinario,tbproductosveterinarios.descripcionproductoveterinario,tbproductosveterinarios.precioproductoveterinario,tbproductosveterinarios.dosisproductoveterinario,tbproductosveterinarios.diasretencionlecheproductoveterinario, tbviaaplicacion.nombreviaaplicacion, tbfuncion.nombrefuncion FROM tbproductosveterinarios INNER JOIN tbviaaplicacion ON tbproductosveterinarios.viaaplicacionveterinarios=tbviaaplicacion.idviaaplicacion INNER JOIN tbfuncion ON tbproductosveterinarios.funcionveterinarios=tbfuncion.idfuncion WHERE tbproductosveterinarios.estadoproductoveterinario="activo";
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE eliminarproductoveterinario(codigo INT)
BEGIN
UPDATE tbproductosveterinarios SET estadoproductoveterinario="inactivo" WHERE codigoproductoveterinario=codigo;
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE registrarproductoveterinario(codigo varchar(50),nombre text,descripcion text,dosis text,dias int,via int,funcion int,precio double )
BEGIN
INSERT INTO tbproductosveterinarios (codigoproductoveterinario,nombreproductoveterinario,descripcionproductoveterinario,dosisproductoveterinario,diasretencionlecheproductoveterinario,viaaplicacionveterinarios,funcionveterinarios,precioproductoveterinario,estadoproductoveterinario)
VALUES (codigo,nombre,descripcion,dosis,dias,funcion,precio,"activo");
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE modificarproductoveterinario(codigo varchar(50),nombre text,descripcion text,dosis text,dias int,via int,funcion int,precio double )
BEGIN
UPDATE tbproductosveterinarios SET
nombreproductoveterinario=nombre,descripcionproductoveterinario=descripcion,dosisproductoveterinario=dosis,diasretencionlecheproductoveterinario=dia,viaaplicacionveterinarios=via,funcionveterinarios=funcion,precioproductoveterinario=precio WHERE codigoproductoveterinario=codigo;
END$$
DELIMITER $$



DELIMITER $$
CREATE PROCEDURE mostrarfunciones()
BEGIN
SELECT  tbfuncion.nombrefuncion FROM tbfuncion;
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE mostrarvias()
BEGIN
SELECT  tbviaaplicacion.nombreviaaplicacion FROM tbviaaplicacion;
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE registrarLecheDiaria(cliente int,fecha date,turno text,peso double)
BEGIN
INSERT INTO tbpesalechediario (idpersonalechediario,fechaentregalechediario,turnopesolechediario,pesoturno, estadopesalechediario)
VALUES (cliente,fecha,turno,peso,"activo");
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE ` verificarturno`(IN `fecha` DATE, IN `turno` TEXT)
SELECT tbpesalechediario.turnopesolechediario, tbpesalechediario.fechaentregalechediario FROM tbpesalechediario WHERE tbpesalechediario.fechaentregalechediario=fecha AND tbpesalechediario.turnopesolechediario=turno AND tbpesalechediario.idpersonalechediario=cliente
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE consultarRecepcion(fecha date)
BEGIN
SELECT tbpersona.idpesona,tbpesalechediario.idpesalechediario, tbpesalechediario.fechaentregalechediario,tbpesalechediario.turnopesolechediario,tbpesalechediario.pesoturno ,tbpersona.nombrepersona, tbpersona.apellido1persona, tbpersona.apellido2persona FROM tbpesalechediario INNER JOIN tbpersona ON tbpesalechediario.idpersonalechediario=tbpersona.idpersona WHERE tbpesalechediario.estadopesalechediario="activo" AND tbpesalechediario.fechaentregalechediario=fecha ORDER BY tbpesalechediario.idpersonalechediario DESC;
END$$
DELIMITER $$




DELIMITER $$
CREATE PROCEDURE modificarAhorroCliente(id INT, ahorro DOUBLE)
BEGIN
UPDATE tbproductorcliente  SET ahorroporlitroproductorcliente=ahorro WHERE idpersonacliente=id AND estadoproductorcliente="activo";
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE modificarAhorroSocio(id INT, ahorro DOUBLE)
BEGIN
UPDATE tbproductorsocio  SET ahorroporlitroproductorsocio=ahorro WHERE idpersonasocio=id AND estadoproductorsocio="activo";
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE retornarMontoAhorroSocio(id INT)
BEGIN
SELECT tbproductorsocio.ahorroporlitroproductorsocio FROM tbproductorsocio WHERE idpersonasocio=id AND estadoproductorsocio="activo";
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE retornarMontoAhorroCliente(id INT)
BEGIN
SELECT tbproductorcliente.ahorroporlitroproductorcliente FROM tbproductorcliente WHERE idpersonacliente=id AND estadoproductorcliente="activo";
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE registrarAhorroTotalSemanal(id INT,montoAhorro DOUBLE,litrosEntregados DOUBLE,fecha DATE)
BEGIN
INSERT INTO tbahorrosemanal(idpersonaahorro,montoahorrosemanalporlitro,litrosentregadosahorrosemanal,fechaentregapago,estadoahorrosemanal) VALUES(id,montoAhorro,litrosEntregados,fecha,"activo");
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE searchproductveterinario(codigo TEXT)
BEGIN
  SELECT nombreproductoveterinario,precioproductoveterinario FROM tbproductosveterinarios WHERE codigoproductoveterinario=codigo LIMIT 1;
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE registrarVenta(idCliente INT,facturaVenta INT,fecha DATE,hora TIME,totalBruto DOUBLE,totalNeto DOUBLE,tipoVenta TEXT)
BEGIN
    INSERT INTO tbventa(numerofactura,fechaventa,horaventa,totalbrutoventa,totalnetoventa,tipoventa,idpersonaventa) VALUES(facturaVenta,fecha,hora,totalBruto,totalNeto,tipoVenta,idCliente);
    UPDATE tbfacturero SET ultimafactura=facturaVenta+1;
    SELECT idventa FROM tbventa ORDER BY idventa DESC limit 1;
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE registrarVentaPorCobrar(idCliente INT,idVenta INT,totalVenta DOUBLE)
BEGIN
  INSERT INTO tbventaporcobrar(idventa,idpersona,saldoactualventaporcobrar,estadoventaporcobrar) VALUES(idVenta,idCliente,totalVenta,"activo");
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE registrarDetalleVentaVeterinaria(preciounitariodetalleventa DOUBLE,cantidaddetalleventa INT,subtotaldetalleventa DOUBLE,codigoproductoslacteos VARCHAR(50),idVenta INT)
BEGIN
  INSERT INTO tbdetalleventaveterinaria(preciounitariodetalleventa,cantidaddetalleventa,subtotaldetalleventa,idproductoveterinario,idventa) VALUES(preciounitariodetalleventa,cantidaddetalleventa ,subtotaldetalleventa,(SELECT idproductoveterinario FROM tbproductosveterinarios WHERE codigoproductoveterinario=codigoproductoslacteos),idVenta);
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE  pagarAhorro(idProductor INT)
BEGIN
	UPDATE tbahorrosemanal SET estadoahorrosemanal='pagado' WHERE idpersonaahorro=idProductor AND estadoahorrosemanal='activo';
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE  compraMateriaPrima(idProductor INT,cantidadlitroscompramateriaprima DOUBLE,montopagolitro DOUBLE,totalpagarlitros DOUBLE,fechacompramateriaprima DATE)
BEGIN
	INSERT INTO  tbcompramateriaprima(idpersona,cantidadlitroscompramateriaprima,montopagolitro,totalpagarlitros,fechacompramateriaprima) VALUES(idProductor,cantidadlitroscompramateriaprima,montopagolitro,totalpagarlitros,fechacompramateriaprima);
	UPDATE tbpesalechediario SET estadopesalechediario='inactivo' WHERE idpersonalechediario=idProductor AND fechaentregalechediario!=fechacompramateriaprima AND estadopesalechediario='activo';
END$$
DELIMITER $$



DELIMITER $$
CREATE PROCEDURE  verReporteAhorro(fechaInicio DATE, fechaFinal DATE)
BEGIN
	SELECT tbahorrosemanal.idahorro, tbahorrosemanal.montoahorrosemanalporlitro,tbahorrosemanal.litrosentregadosahorrosemanal,tbahorrosemanal.fechaentregapago,tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona FROM tbahorrosemanal INNER JOIN tbpersona ON tbahorrosemanal.idpersonaahorro=tbpersona.idpersona WHERE tbahorrosemanal.fechaentregapago BETWEEN fechaInicio AND fechaFinal;
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE  registrarSolicitudPrestamo(idPersona INT,interes INT, montoPrestamo DOUBLE,plazo INT, modoPlazo INT,fecha DATE)
BEGIN
  INSERT INTO tbsolicitudprestamo(idpersona,idinteres,cantidadsolicitud,plazo,idmodoplazo,estado,fecha) VALUES(idPersona,interes,montoPrestamo,plazo,modoPlazo,"Solicitud",fecha);
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE  obtenerPrestamosActivos(idPersona INT)
BEGIN
  SELECT tbprestamos.idprestamo,tbprestamos.fechaprestamo,tbprestamos.montototalprestamo,tbprestamos.montocuota,tbprestamosporcobrar.saldoactualprestamoporcobrar,tbprestamosporcobrar.idprestamoporcobrar FROM tbprestamos INNER JOIN tbprestamosporcobrar ON tbprestamos.idprestamo=tbprestamosporcobrar.idprestamo  WHERE tbprestamosporcobrar.estadoprestamoporcobrar="activo" AND tbprestamos.idpersonaprestamo=idPersona;
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE  registrarPagoCuota(idPrestamoCobrar INT,saldoActual DOUBLE,nuevoSaldo DOUBLE,cuota DOUBLE,fecha DATE,hora TIME,estado TEXT)
BEGIN
  UPDATE  tbprestamosporcobrar SET saldoactualprestamoporcobrar=nuevoSaldo, estadoprestamoporcobrar=estado WHERE idprestamoporcobrar=idPrestamoCobrar;
  INSERT INTO tbpagoprestamo(idprestamoporcobrar,saldoanteriorpagopretsamo,saldoactualpagoprestamo,montocuotapagoprestamo,fechapagoprestamo,horapagoprestamo) VALUES(idPrestamoCobrar,saldoActual,nuevoSaldo,cuota,fecha,hora);
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE  mostrarSolicitudes()
BEGIN
      SELECT tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona,tbsolicitudprestamo.idsolicitud,tbsolicitudprestamo.plazo,tbperiodopagoprestamo.tipopagoprestamo,tbsolicitudprestamo.cantidadsolicitud,tbinteresprestamo.porcentaje,tbsolicitudprestamo.fecha FROM tbsolicitudprestamo INNER JOIN tbpersona ON tbsolicitudprestamo.idpersona=tbpersona.idpersona INNER JOIN tbperiodopagoprestamo ON tbperiodopagoprestamo.idperiodopagoprestamo=tbsolicitudprestamo.idmodoplazo INNER JOIN tbinteresprestamo ON tbinteresprestamo.idinteres= tbsolicitudprestamo.idinteres WHERE tbsolicitudprestamo.estado="Solicitud";
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE  aprobarSolicitud(idsolicitud INT, idpersonaprestamo INT,tasainteres DOUBLE,montototalprestamo DOUBLE, montocuota DOUBLE, fechaprestamo DATE)
BEGIN
  INSERT INTO  tbprestamos(idpersonaprestamo,tasainteres,montototalprestamo,montocuota,fechaprestamo) VALUES(idpersonaprestamo,tasainteres,montototalprestamo,montocuota,fechaprestamo);
  INSERT INTO  tbprestamosporcobrar(idprestamo,saldoactualprestamoporcobrar,estadoprestamoporcobrar) VALUES((SELECT idprestamo FROM tbprestamos ORDER BY idprestamo DESC LIMIT 1),montototalprestamo,"activo");
  UPDATE tbsolicitudprestamo SET estado='Aprobado' WHERE tbsolicitudprestamo.idsolicitud=idsolicitud AND estado="Solicitud";  
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE  rechazarSolicitud(idsolicitud INT)
BEGIN
  UPDATE tbsolicitudprestamo SET estado='Rechazado' WHERE tbsolicitudprestamo.idsolicitud=idsolicitud AND estado="Solicitud";
END$$
DELIMITER $$


DELIMITER $$
CREATE PROCEDURE  verReportePagoLeche(fechaInicio DATE, fechaFinal DATE)
BEGIN
  SELECT tbcompramateriaprima.idcompramateriaprima, tbcompramateriaprima.cantidadlitroscompramateriaprima,tbcompramateriaprima.montopagolitro,tbcompramateriaprima.totalpagarlitros,tbcompramateriaprima.fechacompramateriaprima,tbpersona.nombrepersona,tbpersona.apellido1persona,tbpersona.apellido2persona FROM tbcompramateriaprima INNER JOIN tbpersona ON tbcompramateriaprima.idpersona=tbpersona.idpersona WHERE tbcompramateriaprima.fechacompramateriaprima BETWEEN fechaInicio AND fechaFinal;
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE  verReportePagoPrestramo(fechaInicio DATE, fechaFinal DATE, idPrestamo INT)
BEGIN
  SELECT  tbpagoprestamo.idpagoprestamo,tbpagoprestamo.saldoanteriorpagopretsamo,tbpagoprestamo.saldoactualpagoprestamo,tbpagoprestamo.montocuotapagoprestamo,tbpagoprestamo.fechapagoprestamo,tbpagoprestamo.horapagoprestamo FROM tbprestamosporcobrar INNER JOIN tbpagoprestamo ON tbpagoprestamo.idprestamoporcobrar=tbprestamosporcobrar.idprestamoporcobrar WHERE tbpagoprestamo.fechapagoprestamo BETWEEN fechaInicio AND fechaFinal AND tbprestamosporcobrar.idprestamo=idPrestamo;
END$$
DELIMITER $$



DELIMITER $$
CREATE PROCEDURE  consultarVentasPorCobrarCliente(idCliente INT)
BEGIN
  SELECT idventaporcobrar,numerofactura, fechaventa, totalbrutoventa, tipoventa FROM tbventaporcobrar INNER JOIN tbventa ON tbventaporcobrar.idventa = tbventa.idventa WHERE estadoventaporcobrar='activo' AND idpersona=idCliente; 
END$$
DELIMITER $$

DELIMITER $$
CREATE PROCEDURE  pagarVenta(idVentaPorCobrar INT,fecha DATE, hora TIME)
BEGIN
  UPDATE tbventaporcobrar SET estadoventaporcobrar = 'inactivo' WHERE idventaporcobrar=idVentaPorCobrar;
  INSERT INTO tbpagoventa(idventaporcobrar,fechapagoventa,horapagoventa) VALUES(idVentaPorCobrar,fecha,hora);

END$$
DELIMITER $$













Pruebas

INSERT INTO `tbpersona` (`idpersona`, `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona`, `direccionpersona`, `correopersona`) VALUES (NULL, '305020820', 'Kervin', 'Araya', 'Romero', '84528925', 'El Sauce', 'kervin@gmail.com');

registrarproductoveterinario("3456789","lolita","sirve para curar","2cc","2","2","3","400")

modificarproductoveterinario('$codigo','$nombre','$descripcion','$precio','$dosis','$dias','$via','$funcion')
CALL  modificarproductoveterinario("344567","acetaminofen","sirve para el dolor de cabeza","20 cc",7,2,2,2000);
UPDATE tbpersona SET documentoidentidadpersona=cedula, nombrepersona=nombre,apellido1persona=apellido1,apellido2persona=apellido2,telefonopersona=telefono,direccionpersona=direccion,correopersona=correo WHERE idpersona=id
