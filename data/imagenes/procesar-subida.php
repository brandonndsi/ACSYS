<?php
	if(isset($_POST['nombre']) && !empty($_POST['nombre'])){
	$imagenes=$_FILES['imagenes'];
	$nom=$_POST['nombre'];
	$ruta_provisional=$imagenes["tmp_name"];
	$src="../../image/distribuidor/david.jpg";
	if ( ! @move_uploaded_file($ruta_provisional, $nom) ) {
		echo "Error: No se ha podido mover el fichero enviado a la carpeta de destino";
		@unlink(ini_get('upload_tmp_dir').$_FILES['imagenes']['tmp_name']);
		exit;
	}
	echo "Fichero subido correctamente a: ".$nom;
}/*else{
	echo "El nombre no existe";
}*/

if(isset($_POST['accion'])){
	if($_POST['accion']=="imagenesproductorcliente"){
	
	//echo "id es igual a ".$id;
	llenarDatosImagenes();
//imagenesProductorSocio($idproductorcliente);
}
}
function llenarDatosImagenes(){

include_once '../productor/dataProductorCliente.php';
$id=$_POST['id'];
$dato= new dataProductorCliente();
$ing=$dato->imagenesProductorSocio($id);
foreach ($ing as $row) {	
echo '<div id="contentImagen">';
echo '<h2>CBO</h2>';
echo '<input type="hidden" value="'.$row['imagencboproductorcliente'].'" id="imagenCBO">';
echo '<a href="javascript:abrirCBO();"><img src="'.$row['imagencboproductorcliente'].'" /></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Sangrado</h2>';
echo '<input type="hidden" value="'.$row['imagenexamensangradoproductorcliente'].'" id="imagenSangrado">';
echo '<a href="javascript:abrirSangrado();"><img src="'.$row['imagenexamensangradoproductorcliente'].'"/></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Escritura</h2>';
echo '<input type="hidden" value="'.$row['imagenescrituraproductorcliente'].'" id="imagenEscritura">';
echo '<a href="javascript:abrirEscritura();"><img src="'.$row['imagenescrituraproductorcliente'].'"/></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Luz</h2>';
echo '<input type="hidden" value="'.$row['imagenreciboluzproductorcliente'].'" id="imagenLuz">';
echo '<a href="javascript:abrirLuz();"><img src="'.$row['imagenreciboluzproductorcliente'].'"/></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Agua</h2>';
echo '<input type="hidden" value="'.$row['imagenrecibaguaproductorcliente'].'" id="imagenAgua">';
echo '<a href="javascript:abrirAgua();"><img src="'.$row['imagenrecibaguaproductorcliente'].'"/></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Solido</h2>';
echo '<input type="hidden" value="'.$row['imagenexamensolidoproductorcliente'].'" id="imagenSolido">';
echo '<a href="javascript:abrirSolido();"><img src="'.$row['imagenexamensolidoproductorcliente'].'"/></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Plano</h2>';
echo '<input type="hidden" value="'.$row['imagenplanofincaproductorcliente'].'" id="imagenPlano">';
echo '<a href="javascript:abrirPlano();"><img src="'.$row['imagenplanofincaproductorcliente'].'"/></a>';
echo '</div>';
echo '<div id="contentImagen">';
echo '<h2>Cedula</h2>';
echo '<input type="hidden" value="'.$row['imagendocumentoidentidadproductorcliente'].'" id="imagenCedula">';
echo '<a href="javascript:abrirCedula();"><img src="'.$row['imagendocumentoidentidadproductorcliente'].'"/></a>';
echo '</div>';
}

}
?>