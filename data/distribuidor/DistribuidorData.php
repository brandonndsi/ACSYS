<?php 
	class DistribuidorData{
		private $conexion;
	function DistribuidorData(){
			include_once '../../data/conexion/conexion.php';
			$this->conexion = new conexion();
		}

		// mostrar todo
    function DistribuidorMostrar(){
    
        $con = $this->conexion->crearConexion();
        $mostrarProducto = $con->query("CALL mostrarDistribuidor();");
        $datos=array();
        $con = $this->conexion->cerrarConexion();
        while($result = $mostrarProducto->fetch_assoc()){
            array_push($datos,$result);  
        }
        return $datos;
    }
    function DistribuidorModificar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo,$id){
        $con=$this->conexion->crearConexion();
        $modificarDistribuidor = $con->query("CALL modificarDistribuidor('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo','$id')");
        $con = $this->conexion->cerrarConexion();
        if($modificarDistribuidor == 1){
            return "true";

        }else{
            return "false";

        }

    }

    function DistribuidorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $registrarDistribuidor = $con->query("CALL registrarpersona('$cedula',
            '$nombre','$apellido1','$apellido2','$telefono',
            '$direccion','$correo');");
        $con=$this->conexion->cerrarConexion();

        /*creamos la nueva conexion*/
        $con=$this->conexion->crearConexion();
        $estraerIdPersona=$con->query("CALL extraeridpersona('$cedula');");
        $con=$this->conexion->cerrarConexion();
        $idpersona;
         while($row = $estraerIdPersona->fetch_assoc()){
            $idpersona=$row['idpersona'];
        }
        /*ahora si geeramos el nuevo cliente mayorista*/
        $con=$this->conexion->crearConexion();
        $clienteMayorista=$con->query("CALL nuevoclientemayorista('$idpersona','Activo');");
        $con=$this->conexion->cerrarConexion();

        if($clienteMayorista == 1){
            return "true";

        }else{
            return "false";

        }

    }

    function DistribuidorEliminar($idpersona){
        
        $con=$this->conexion->crearConexion();
        $eliminarProductor = $con->query("CALL eliminarclientemayorista('$idpersona')");
        $con=$this->conexion->cerrarConexion();
        if($eliminarProductor == 1){
            return "true";

        }else{
            return "false";


        }

    }
        
	}
    /*
    $rrr = new DistribuidorData();
        $d=$rrr->DistribuidorRegistrar('fd','fd','fdf','fdf','d','3435','sss@gmail.com','5');
        print_r($d);*/
 ?>