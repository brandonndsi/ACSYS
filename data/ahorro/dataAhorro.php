<?php 

    class dataAhorro{

        private $conexion;
        private $lista;

        function dataAhorro(){

            include '../../data/conexion/conexion.php';
            $this->conexion = new conexion();
            $this->lista=array();
        }

        function ahorroMontoMostrar(){
            
            $this->retornarSocio();
            $this->retornarCliente();
            return json_encode($this->lista);
        }


        function retornarCliente(){
            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $mostrar= $con->query("CALL mostrarproductoresclientes()");
            while($row=$mostrar->fetch_assoc()){
                $newRow= array('tipo'=>"cliente",'documentoidentidad' => $row['documentoidentidadpersona'],'nombre' =>$row['nombrepersona'],'apellido1'=>$row['apellido1persona'],'apellido2' =>$row['apellido2persona'],'id' =>$row['idpersona'],'ahorro' => $row['ahorroporlitroproductorcliente'] );
                array_push($this->lista,$newRow);
            }

            
        }

        function retornarSocio(){
            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $mostrar=$con->query("CALL mostrarproductores()");
            while($row=$mostrar->fetch_assoc()){
                $newRow= array('tipo'=> "socio",'documentoidentidad' => $row['documentoidentidadpersona'],'nombre' =>$row['nombrepersona'],'apellido1'=>$row['apellido1persona'],'apellido2' =>$row['apellido2persona'],'id' =>$row['idpersona'],'ahorro' => $row['ahorroporlitroproductorsocio'] );
                array_push($this->lista,$newRow);
            }

        }

        function ahorroMontoModificar($id,$ahorro,$tipo){
            
            if($tipo=="cliente"){
                 return $this->ahorroModificarCliente($id,$ahorro);

            }else{
                
                return $this->ahorroModificarSocio($id,$ahorro);
            }
           

        }

        function ahorroModificarCliente($id,$ahorro){
            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $modificar=$con->query("CALL modificarAhorroCliente('$id','$ahorro')");
             if($modificar==1){
                $respuesta="true";

            }else{
                $respuesta="false";

            }
            return $respuesta;
        }

        function ahorroModificarSocio($id,$ahorro){
            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $modificar=$con->query("CALL modificarAhorroSocio('$id','$ahorro')");
             if($modificar==1){
                $respuesta="true";

            }else{
                $respuesta="false";

            }
            return $respuesta;

        }

    }




?>