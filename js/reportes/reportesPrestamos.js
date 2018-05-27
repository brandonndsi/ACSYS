/*Variables glovales las cuales contendran los datos de los dos input iniciales a buscar.*/
var fechainicial;
var fechaFinal;

$(document).ready(function () {
    CargarTablaPrincipal(); 
    temporalErrorBusqueda();           
});

	/**
	 * [CargarTablaPrincipal Loque hace es darles los valores del datablable a la table normal del principal]
	 */
	function CargarTablaPrincipal(){
		$('#listaVentas').DataTable({
                    "bDeferRender": true,
                    "sordering": true,
                    "responsive": true,
                    "sPaginationType": "full_numbers",
                    "oLanguage": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": 'Mostrar _MENU_ Registros por pagina',
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Por favor espere - cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
	}
	/**
	 * [buscarDatos Lo que hace es poder capturar los valores de los input ingresados por el usaurio]
	 * @return {[type]} [procesa la informacion a las variables globales las cuales contienen la informacion]
	 */
	function buscarDatos(){
		fechainicial=document.getElementById("fechainicial").value;
		fechaFinal=document.getElementById("fechafinal").value;
		validarLasFechas();
	}
	/**
	 * [validarLasFechas Lo que hace es verificar que la fecha inicial sea igual o menor a la final para lo de la busqueda]
	 * @return {[type]} [modal o el contenido a buscar en la base de datos si esat bien]
	 */
	function validarLasFechas(){
			informacion="";
		if(fechainicial<=fechaFinal){
			buscarPeticion();
      //alert(fechainicial);
		}else{
			informacion="la fecha inicial no debe ser menor a la fecha final.";
			modalRespuestas(informacion);
		}
	}

	/**
	 * [modalRespuestas lo que hace es poder imprimir solo el mensaje de confirmacion de los datos de la validacion]
	 * @param  {[type]} respuesta [Es el dato a mostrar en el modal]
	 * @return {[type]}           [retorna el modal con el contenido enviado como parametro]
	 */
	function modalRespuestas(respuesta){
       dato="<h4>"+respuesta+"</h4>";
             
          $("#mensaje").html(dato);
          $("#modalRespuesta").modal();
	}
	/**
   * [destruirTablaPrincipal lo que hace es destruir todos los atrinutos que se le dieron a la tabla principal]
   * @return {[type]} [la vuelve a su estado original]
   */
  function destruirTablaPrincipal(){
    $('#listaVentas').dataTable().fnDestroy();
  }
  /**
   * [retorna un mensaje en el data table inicial]
   * @return {[type]} [retorna un simple mensaje inicial]
   */
  function temporalErrorBusqueda(){
  	html="<td colspan='8' align='center'>Seleccione la fecha para la busqueda</th>";
  	$("#datos").html(html);
  }

  	/**
	 * [buscarPeticion Lo que hace es traer los datos a buscar en la base de datos y los restorna  en la tabla.]
	 * @return {[type]} [Actualiza la tabla inicial con los valores de la base de datos]
	 */
	function buscarPeticion(){
		 $.post('../../business/reportes/reportesAccion.php', {
              action : 'ventaPrestamos' ,
              fechai : fechainicial,
              fechaf : fechaFinal
        }, function(responseText) {
      		json = JSON.parse(responseText);
      		//console.log(json);
      		CargarNuevosDatosALaTablaInicial(json);
      		});
	}
	/**
	 * [CargarNuevosDatosALaTablaInicial Comnezamos a recorrer los datos de la busqueda y incorporarlos a la tabla principal]
	 * @param {[array objeto ]} json [resive todos los datos de la busqueda en la base de datos]
	 * 
	 */
	function CargarNuevosDatosALaTablaInicial(json){
		    html = "";
        var listaTodo = [];
        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</td>";
          html+="<td>"+json[i].cantidadsolicitud+"</td>";
          html+="<td>"+json[i].tipopagoprestamo+"</td>";
          html+="<td>"+json[i].plazo+"</td>";
          html+="<td>"+json[i].porcentaje+"</td>";
          html+="<td>"+json[i].fecha+"</td>";
          html+="<td>"+json[i].estado+"</td>";
          prestamo = "'"+json[i].idsolicitud+","+json[i].nombrepersona+ "," +json[i].apellido1persona+ "," +json[i].apellido2persona+ "," +json[i].cantidadsolicitud+ "," +
                        json[i].tipopagoprestamo + "," +json[i].plazo+ ","+json[i].porcentaje+","+
                        json[i].fecha+","+json[i].estado+"'";
          html+='<td><a href="javascript:mostrarImprimir('+prestamo+')"><span class="glyphicon glyphicon-file"></span></a></td>';
          html+="</tr>";
          listaTodo.push({"nombre":json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona,"cantidad":json[i].cantidadsolicitud,"plazo":json[i].plazo,"porcentage":json[i].porcentaje,"estado":json[i].estado,"fecha":json[i].fecha});
          localStorage.setItem("listaTodo", JSON.stringify(listaTodo)); 

        }
        destruirTablaPrincipal();
        $("#datos").html(html);
        CargarTablaPrincipal();
	}

	function mostrarImprimir(prestamo){
string = prestamo.split(",");   
nombreCliente=string[1]+" "+string[2]+" "+string[3];
fecha=string[8];
interes=string[7];
plazo=string[6];
modoPlazo=string[5];
montoSolicitado=string[4];
cuota=string[4]/string[6];

tol=(parseFloat(string[4])+parseFloat(string[4])*(parseFloat(string[7])/100))/parseFloat(string[6]);
tot=string[4];
total =0;
total = tot+tol;
     
    window.open("http://asoprolesa-saucetico/view/facturas/imprimirReporteDePrestamos.php?nombreCliente="+nombreCliente+"&&fecha="+fecha+"&&interes="+interes+"&&plazo="+plazo+"&&modoPlazo="+modoPlazo+"&&montoSolicitado="+montoSolicitado+"&&cuota="+cuota+"&&total="+total, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
		//console.log(cuota);
    //parseFloat(string[4])+parseFloat(string[4])*(parseFloat(string[7])/100))/parseFloat(string[6]);
    //parseFLoat(string[4])+(parseFloat(string[4])*(parseFloat(string[4])/100))/parseFloat(string[7]);
	}

  function imprimirTodo(){
  if (localStorage.getItem("listaTodo") === null) {
  swal({
                    title: "Reportes.",
                    text: "La lista de reportes esta vacía",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }

                    },
                    dangerMode: true
                });

}else{
  window.open("http://asoprolesa-saucetico/view/facturas/imprimirPDFReportePrestamos.php?lista="+localStorage.getItem("listaTodo")+"&tipo=Solicitud Adelanto", "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
  localStorage.removeItem("listaTodo");
  window.location.href = '../../view/reportes/prestamos.php';
}
}

