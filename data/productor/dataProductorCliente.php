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
        if($registrarProductor==1){
                /*variables a utilizar para guardar la ruta de las imagenes correctamente*/
            $identificadorDeLaNuevaPersona=$con->query("CALL extraeridpersona($cedula);");
            $cbo=$identificadorDeLaNuevaPersona."cbo.png";
            $sangrado=$identificadorDeLaNuevaPersona."sangrado.png";
            $escritura=$identificadorDeLaNuevaPersona."escritura.png";
            $luz=$identificadorDeLaNuevaPersona."luz.png";
            $agua=$identificadorDeLaNuevaPersona."agua.png";
            $solido=$identificadorDeLaNuevaPersona."solido.png";
            $plano=$identificadorDeLaNuevaPersona."plano.png";
            $docidentidad=$identificadorDeLaNuevaPersona."docidentidad.png";
        /*metodo de redireccionamiento de las imagenes quemadas por default a la carpeta de socio*/
                    sobreEscribirImagen($cbo);
                    sobreEscribirImagen($sangrado);
                    sobreEscribirImagen($escritura);
                    sobreEscribirImagen($luz);
                    sobreEscribirImagen($agua);
                    sobreEscribirImagen($solido);
                    sobreEscribirImagen($plano);
                    sobreEscribirImagen($docidentidad);
        /*metodo que crea el socio final ya con las imagenes quemadas*/
            $registrarProductor = $con->query("CALL registrarproductorcliente($cbo,$sangrado,$escritura,$luz,$agua,$solido,$plano,$docidentidad)");

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
    /*La function que le da la magia de crear una imagen y guardarla en la carpeta destino*/
    function sobreEscribirImagen($ruta){
        $fuente = @imagecreatefrompng("../../image/productor/cliente/blanco.jpg");
        $imgAncho = imagesx ($fuente);
        $imgAlto =imagesy($fuente);
        $imagen = ImageCreate($imgAncho,$imgAlto);

        ImageCopyResized($imagen,$fuente,0,0,0,0,$imgAncho,$imgAlto,$imgAncho,$imgAlto);

        Header("Content-type: image/png");
        imagepng($imagen,"../../image/productor/cliente/".$ruta);
        imagedestroy($imagen);/*buffer encargado de limpiar el cache de la imagen despues de guardarla*/

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

?>
