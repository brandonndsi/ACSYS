<?php

class dataProductorSocio {

    private $conexion;

    function dataProductorSocio() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   function imagenesProductorSocio($idproductorcliente){
        $con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL sacarimagenproductorsocio('$idproductorcliente
            ');");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        return $datos; 
    }
    // mostrar todo
    function productoresMostrar() {
        $con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL mostrarproductores()");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $modificarProductor = $con->query("CALL modificarproductores('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo','$id')");
        if($modificarProductor==1){
            return "true";

        }else{
            return "false";

        }

    }

    function productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $registrarProductor = $con->query("CALL registrarpersona('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo')");
        if($registrarProductor==1){
              $con=$this->conexion->crearConexion();
            $identificadorDeLaNuevaPersona=$con->query("CALL extraeridpersona($cedula);");
            $con=$this->conexion->cerrarConexion();
            $id="";/*variable a utilizar para poder transformar el dato*/
            while($result=$identificadorDeLaNuevaPersona->fetch_assoc()){
            $id=$result['idpersona'];  
            }
            /*variables a utilizar para guardar la ruta de las imagenes correctamente*/
            $cbo="../../image/productor/socio/".$id."cbo.png";
            $sangrado="../../image/productor/socio/".$id."sangrado.png";
            $escritura="../../image/productor/socio/".$id."escritura.png";
            $luz="../../image/productor/socio/".$id."luz.png";
            $agua="../../image/productor/socio/".$id."agua.png";
            $solido="../../image/productor/socio/".$id."solido.png";
            $plano="../../image/productor/socio/".$id."plano.png";
            $docidentidad="../../image/productor/socio/".$id."docidentidad.png";
        /*metodo de redireccionamiento de las imagenes quemadas por default a la carpeta de socio*/
        $con=$this->conexion->crearConexion();
            $registrarProductor = $con->query("CALL registrarproductorsocio('$cbo','$sangrado','$escritura','$luz','$agua','$solido','$plano','$docidentidad');");

        /*Metodo de la leche que crea la imagen y la manda a guardar en la carpeta.*/
        $fuente = @imagecreatefrompng("../../image/da.png");//Creo la nueva instancia de la imagen 
        $imgAncho = imagesx ($fuente);/*obtengo el ancho de la imagen original*/
        $imgAlto =imagesy($fuente);/*obtengo el largo de la imagen original*/
        $imagen = ImageCreate($imgAncho,$imgAlto);/*creamos la imagen copia para el brauser*/
        ImageCopyResized($imagen,$fuente,0,0,0,0,100,100,$imgAncho,$imgAlto);/*hacemos la sobre escritura del original a la imagen del brauser con las dimenciones de 100 100*/
        imagepng($imagen,$cbo);/*mandamos a guardar la imagen en el url del brouser a guardar a la ruta de la carpeta*/
        imagepng($imagen,$sangrado);
        imagepng($imagen,$escritura);
        imagepng($imagen,$luz);
        imagepng($imagen,$agua);
        imagepng($imagen,$solido);
        imagepng($imagen,$plano);
        imagepng($imagen,$docidentidad);
        $con=$this->conexion->cerrarConexion();/*cerramos la puta conexion*/
            return "true";

        }else{
            return "false";

        }
        /*
        DELIMITER $$
        CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarproductorsocio`(IN `cbo` TEXT, IN `exasangrado` TEXT, IN `escritura` TEXT, IN `luz` TEXT, IN `agua` TEXT, IN `solido` TEXT, IN `plano` TEXT, IN `docidentidad` TEXT)
        NO SQL
        INSERT INTO tbproductorsocio(
        idpersonasocio,
        estadoproductorsocio,
        ahorroporlitroproductorsocio,
        imagencboproductorsocio,
        imagenexamensangradoproductorsocio, imagenescrituraproductorsocio, imagenreciboluzproductorsocio,
        imagenrecibaguaproductorsocio,
        imagenexamensolidoproductorsocio, imagenplanofincaproductorsocio,
        imagendocumentoidentidadproductorsocio)
        VALUES ((SELECT idpersona FROM tbpersona order by idpersona DESC limit 1),
        "activo",0,cbo,exasangrado,escritura,luz,agua,solido,plano,docidentidad)$$
        DELIMITER ;
         */
    }

    function productorEliminar($id){
        
        $con=$this->conexion->crearConexion();
        $eliminarProductor = $con->query("CALL eliminarproductorsocio('$id')");
        if($eliminarProductor==1){
            return "true";

        }else{
            return "false";


        }

    }

}
/*$prueva= new dataProductorSocio();
$cedula="98754625";
$nombre="bboooo";
$apellido1="salas";
$apellido2="salas";
$telefono="12345678";
$direccion="la virgen";
$correo="mmm@gmail.com";
$resultado=$prueva->productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
print_r($resultado);*/
?>
