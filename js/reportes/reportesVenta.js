/*Variables glovales las cuales contendran los datos de los dos input iniciales a buscar.*/
var fechainicial;
var fechaFinal;
var totalAPagar;
var NombreCliente;

$(document).ready(function () {
    CargarTablaPrincipal();            
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
	 * [buscarPeticion Lo que hace es traer los datos a buscar en la base de datos y los restorna  en la tabla.]
	 * @return {[type]} [Actualiza la tabla inicial con los valores de la base de datos]
	 */
	function buscarPeticion(){
		 $.post('../../business/reportes/reportesAccion.php', {
              action : 'ventabuscar' ,
              fechai : fechainicial,
              fechaf : fechaFinal
        }, function(responseText) {
      		json = JSON.parse(responseText);
      		CargarNuevosDatosALaTablaInicial(json);
      		});
	}
	/**
	 * [CargarNuevosDatosALaTablaInicial Comnezamos a recorrer los datos de la busqueda y incorporarlos a la tabla principal]
	 * @param {[array objeto ]} json [resive todos los datos de la busqueda en la base de datos]
	 */
	function CargarNuevosDatosALaTablaInicial(json){
		    html = "";
        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].numerofactura+"</td>";
          html+="<td>"+json[i].fechaventa+"</td>";
          html+="<td>"+json[i].horaventa+"</td>";
          html+="<td>"+json[i].totalbrutoventa+"</td>";
          html+="<td>"+json[i].totalnetoventa+"</td>";
          html+="<td>"+json[i].tipoventa+"</td>";
          idv=json[i].idventa;
          numfactura=json[i].numerofactura;
          idpersona=json[i].idpersonaventa;
          tipov=json[i].tipoventa;
          tol=json[i].totalnetoventa;
          html+='<td><a href="javascript:modalVer('+numfactura+','+tol+','+idv+','+idpersona+',/'+tipov+'/)"><span class="glyphicon glyphicon-eye-open"></span></a></td>';
          html+='<td><a href="javascript:mostrarImprimir('+idv+','+numfactura+','+idpersona+')"><span class="glyphicon glyphicon-file"></span></a></td>';
          html+="</tr>";
        }
        destruirTablaPrincipal();
        $("#datos").html(html);
        CargarTablaPrincipal();
	}
  /**
   * [destruirTablaPrincipal lo que hace es destruir todos los atrinutos que se le dieron a la tabla principal]
   * @return {[type]} [la vuelve a su estado original]
   */
  function destruirTablaPrincipal(){
    $('#listaVentas').dataTable().fnDestroy();
  }
  /**
   * [mostrarImprimir la factura total con los datos]
   * @param  {[type]} idv        [description]
   * @param  {[type]} numfactura [description]
   * @param  {[type]} idpersona  [description]
   * @return {[type]}            [description]
   */
	function mostrarImprimir(idv,numfactura,idpersona){
		alert("idventa ="+idv+" numero factura="+numfactura+" idpersona = "+idpersona);
	}
  /**
   * [modalVer Lo que hace es poder visualizar la lista de los articulos que se compraron en la factura]
   * @param  {[type]} idv [description]
   * @return {[type]}     [description]
   */
	function modalVer(numFactura,tol,idv,idpersona,tipov){

          buscarNombredelClienteDeLaFactura(idpersona);
        $("#Re_recibo").val(numFactura);

    if(tipov=="/Veterinaria/"){

        $("#Re_tipoVenta").val("Veterinario");
             buscardetallesVeterinario(tol,idv,idpersona);
                abrirModalDetalles();

    }else if(tipov=="/Distribuidor/"){

      $("#Re_tipoVenta").val("Distribuidor");
          alert("Distribuidor");
             alert(" no es veterinaria id persona = "+idv+"id persona="+idpersona+"tipo="+tipov);
              abrirModalDetalles();

    }else{
     $("#Re_tipoVenta").val("Distribuidor");
       alert("Distribuidor");
          alert(" no es veterinaria id persona = "+idv+"id persona="+idpersona+"tipo="+tipov);
            abrirModalDetalles();
        }
	}
  /**
   * [buscarNombredelClienteDeLaFactura buca el nombre del cliente en la base de datos y la retorna]
   * @param  {[type]} idpersona [id del vendedor de la factura]
   * @return {[type]}           [retorna el nombre completo del usuario o el vendedor]
   */
  function buscarNombredelClienteDeLaFactura(idpersona){
        $.post('../../business/reportes/reportesAccion.php', {
              action : 'ventaNombre' ,
              id : idpersona
        }, function(responseText) {
          $("#Re_cliente").val(responseText);
          });
  
  }
  /*Es traer los datos de la base de datos los detalles de la venta veterinaria que se hizo para poder llenar los datos de ver*/
  function buscardetallesVeterinario(tol,idv,idpersona){
    //alert(idv+", "+idpersona);
          totalAPagar=tol;
        $.post('../../business/reportes/reportesAccion.php', {
              action : 'buscarDetalleVeterinario' ,
              venta : idv
        }, function(responseText) {
          json = JSON.parse(responseText);
            console.log(json);
            llenarTablaDeVerDeTallesFactura(json);
          });
  }
  /**
   * [llenarTablaDeVerDeTallesFactura lo que hace es llenar los datos de veterinario en el buscador]
   * @param  {[type]} json [Resibe el json de los datos que se mandaron por el post del servidor]
   * @return {[type]}      [Genera lo que es una tabla la cual luego sobre escribe la que tiene el modal de ver detalles]
   */
  function llenarTablaDeVerDeTallesFactura(json){
          html = "";
        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].codigoproductoveterinario+"</td>";
          html+="<td>"+json[i].nombreproductoveterinario+"</td>";
          html+="<td>"+json[i].preciounitariodetalleventa+"</td>";
          html+="<td>"+json[i].cantidaddetalleventa+"</td>";
          html+="<tr>";
        }
          html+="<tr>";
          html+="<td colspan='3'><b>TOTA:</b></td>";
          html+="<td>"+totalAPagar+"</td>";
          html+="<tr>";
          llenarLaListaDeArticulosYaFinalesParaVerDetalles(html);
          //$("#Re_ventaProductos").html(html);///modificar los datos para poder metre los datos.

  }
  /**
   * [Manda todo el array a el modal de la busqueda de datalles finales]
   * @param  {[type]} html [Es un array con todos los detalles de la base de datos]
   * @return {[type]}      [Sobre escribe los datos de la factura en el modal para visualuzar despues.]
   */
  function llenarLaListaDeArticulosYaFinalesParaVerDetalles(html){
          $("#Re_ventaProductos").html(html);
  }
/**
 * [le da la funcionalidad al btn del modal de ver detalles de factura]
 * @param  {accion} evt){        le da la funcionalidad del modal para que se oculte.        
 * @return {[modal]}        [modal lo esconde]
 */
$('#facCancelar').on("click", function(evt){
    document.getElementById("contenedorImagen").style.transform="translateY(-150%)";
    window.location.href = '../../view/reportes/ventas.php';
  });
/**
 * [abrirModalDetalles se encarga de darles las funcionalidades del modal]
 * @return {[modal]} [habre el modal de los datos de la factura]
 */
  function abrirModalDetalles(){
    $('#modalRecibo').modal();
  }