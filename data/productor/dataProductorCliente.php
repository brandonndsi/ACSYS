<?php

class dataProductorCliente {

    private $conexion;

    function dataProductorCliente() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function imagenesProductorCliente($idproductorcliente){
        $con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL sacarimagenproductorcliente('$idproductorcliente
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
        $mostrarProductores = $con->query("CALL mostrarproductoresclientes()");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $modificarProductor = $con->query("CALL modificarproductorcliente('$id','$nombre','$cedula','$apellido1','$apellido2','$telefono','$direccion','$correo')");
        if($modificarProductor==1){
            return "true";

        }else{
            return "false";

        }

    }

    function productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $registrarProductor = $con->query("CALL registrarpersona('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo')");
        $con=$this->conexion->cerrarConexion();
        if($registrarProductor==1){

            $con=$this->conexion->crearConexion();
            $identificadorDeLaNuevaPersona=$con->query("CALL extraeridpersona($cedula);");
            $con=$this->conexion->cerrarConexion();
            $id="";/*variable a utilizar para poder transformar el dato*/
            while($result=$identificadorDeLaNuevaPersona->fetch_assoc()){
            $id=$result['idpersona'];  
            }
            /*variables a utilizar para guardar la ruta de las imagenes correctamente*/
            $cbo="../../image/productor/cliente/".$id."cbo.png";
            $sangrado="../../image/productor/cliente/".$id."sangrado.png";
            $escritura="../../image/productor/cliente/".$id."escritura.png";
            $luz="../../image/productor/cliente/".$id."luz.png";
            $agua="../../image/productor/cliente/".$id."agua.png";
            $solido="../../image/productor/cliente/".$id."solido.png";
            $plano="../../image/productor/cliente/".$id."plano.png";
            $docidentidad="../../image/productor/cliente/".$id."docidentidad.png";
        /*metodo de redireccionamiento de las imagenes quemadas por default a la carpeta de socio*/
        $con=$this->conexion->crearConexion(); 
        $registrarProductor = $con->query("CALL registrarproductorcliente('$cbo','$sangrado','$escritura','$luz','$agua','$solido','$plano','$docidentidad');");

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
        CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarproductorcliente`(IN `cbo` TEXT, IN `exasangrado` TEXT, IN `escritura` TEXT, IN `luz` TEXT, IN `agua` TEXT, IN `solido` TEXT, IN `plano` TEXT, IN `docidentidad` TEXT)
        BEGIN
        INSERT INTO tbproductorcliente(idpersonacliente,estadoproductorcliente,ahorroporlitroproductorcliente,
        imagencboproductorcliente, imagenexamensangradoproductorcliente, imagenescrituraproductorcliente, imagenreciboluzproductorcliente, imagenrecibaguaproductorcliente, imagenexamensolidoproductorcliente, imagenplanofincaproductorcliente, imagendocumentoidentidadproductorcliente)
        VALUES ((SELECT idpersona FROM tbpersona order by idpersona desc limit 1), "activo",0,cbo,exasangrado,escritura,luz,agua,solido,plano,docidentidad);
        END$$
        DELIMITER ;
         */

    }
    
    function productorEliminar($id){
        
        $con=$this->conexion->crearConexion();
        $eliminarProductor = $con->query("CALL eliminarproductorcliente('$id')");
        if($eliminarProductor==1){
            return "true";

        }else{
            return "falsee";


        }

    }

}
$prueva= new dataProductorCliente();
$cedula="77889966";
$nombre="iam";
$apellido1="salas";
$apellido2="salas";
$telefono="12345678";
$direccion="la virgen";
$correo="mmm@gmail.com";
$resultado=$prueva->productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
print_r($resultado);

?>
