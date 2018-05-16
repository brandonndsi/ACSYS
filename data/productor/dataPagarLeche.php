<?php 
    class dataPagarLeche{

        private $conexion;
        private $lista;
        private $precioLeche;
        private $montoAhorroTotalColones;
        private $montoAhorro;
        function dataPagarLeche(){

            include '../../data/conexion/conexion.php';
            $this->conexion = new conexion();
            $this->lista=array();
            $this->precioLeche=$this->conexion->crearConexion()->query("SELECT preciolitroleche FROM tbpreciolitroleche WHERE estadopreciolitroleche='activo'")->fetch_assoc()['preciolitroleche'];
        }

        function pagarLecheMostrar(){
           
            $this->retornarLitrosTotalesSocio();
            $this->retornarLitrosTotalesCliente();
            return json_encode($this->lista);
        }


        function retornarLitrosTotalesSocio(){

            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $fecha=date('Y-m-d');
            $mostrar=$con->query("CALL mostrarproductores()");
            while($row=$mostrar->fetch_assoc()){
                $idpersona=$row['idpersona'];
                $con1=$this->conexion->crearConexion();
                $con1->set_charset("UTF8");
                $mostrarLitros=$con1->query("SELECT pesoturno FROM tbpesalechediario WHERE idpersonalechediario='$idpersona' AND estadopesalechediario='activo' AND fechaentregalechediario!='$fecha' ");
                $totalPagar=0;
                $totalLitros=0;

                while($row2=$mostrarLitros->fetch_assoc()){

                    $totalPagar+=($this->precioLeche*$row2['pesoturno']);
                    $totalLitros+=($row2['pesoturno']);

                }
                if($totalLitros>0){
                    $newRow= array('tipo'=>"socio",'documentoidentidad' => $row['documentoidentidadpersona'],'nombre' =>$row['nombrepersona'],'apellido1'=>$row['apellido1persona'],'apellido2' =>$row['apellido2persona'],'id' =>$row['idpersona'],'total' => $totalPagar,'litros' =>$totalLitros);
                    array_push($this->lista,$newRow);
                }
            }
        } 

        function retornarLitrosTotalesCliente(){

            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $fecha=date('Y-m-d');
            $mostrar=$con->query("CALL mostrarproductoresclientes()");
            while($row=$mostrar->fetch_assoc()){
                $idpersona=$row['idpersona'];
                $con1=$this->conexion->crearConexion();
                $con1->set_charset("UTF8");
                $mostrarLitros=$con1->query("SELECT pesoturno FROM tbpesalechediario WHERE idpersonalechediario='$idpersona' AND estadopesalechediario='activo' AND fechaentregalechediario!='$fecha' ");
                $totalPagar=0;
                $totalLitros=0;
                while($row2=$mostrarLitros->fetch_assoc()){
                    $totalPagar+=($this->precioLeche*$row2['pesoturno']);
                    $totalLitros+=($row2['pesoturno']);

                }
                if($totalLitros>0){
                    $newRow= array('tipo'=>"cliente",'documentoidentidad' => $row['documentoidentidadpersona'],'nombre' =>$row['nombrepersona'],'apellido1'=>$row['apellido1persona'],'apellido2' =>$row['apellido2persona'],'id' =>$row['idpersona'],'total' => $totalPagar,'litros' =>$totalLitros);
                    array_push($this->lista,$newRow);
                }
            }
        }


        function pagarLitrosTotales($id,$tipo,$cantidadlitroscompramateriaprima){
            
            
            $fecha=date('Y-m-d');
            $precioLeche = $this->precioLeche;
            $totalPagarLitros=$this->precioLeche*$cantidadlitroscompramateriaprima;
            $con1=$this->conexion->crearConexion();
            $con1->set_charset("UTF8");
            
            $pagar=$con1->query("CALL compramateriaprima('$id','$cantidadlitroscompramateriaprima','$precioLeche','$totalPagarLitros','$fecha')");

            $respuestaDataAhorro=$this->registrarAhorroTotal($id,$tipo,$cantidadlitroscompramateriaprima,$fecha);
            $montoTotalPagar=(double)$totalPagarLitros-(double)$this->montoAhorroTotalColones;
            $json=array('precioleche'=>$precioLeche,'fecha'=>$fecha,'totallitros'=>$cantidadlitroscompramateriaprima,'montototalcolonesahorro'=>$this->montoAhorroTotalColones,'montototalpagarlitros'=>$montoTotalPagar,'montoahorro'=>$this->montoAhorro,'id'=>$id);
            if($pagar == 1 && $respuestaDataAhorro== true){
                echo json_encode($json);
            }else{
                echo $pagar;
            }
        }


        function registrarAhorroTotal($id,$tipo,$litrosEntregados,$fecha){
            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $this->montoAhorro=0;
            if($tipo=="cliente"){

                $this->montoAhorro=$this->montoAhorroCliente($id);
            }else{

                $this->montoAhorro=$this->montoAhorroSocio($id);
            }
            $this->montoAhorroTotalColones=(double)$this->montoAhorro*(double)$litrosEntregados;
            $registrar=$con->query("CALL registrarAhorroTotalSemanal('$id','$this->montoAhorro','$litrosEntregados','$fecha')");
            if($registrar==1){
                return true;

            }else{

                return false;
            }

        }

           function montoAhorroCliente($id){
            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $monto=$con->query("CALL retornarMontoAhorroCliente('$id')");
            $montoTotal=$monto->fetch_assoc();
            return $montoTotal['ahorroporlitroproductorcliente'];
        }

        function montoAhorroSocio($id){

            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");

            $monto=$con->query("CALL retornarMontoAhorroSocio('$id')");
            $montoTotal=$monto->fetch_assoc();
            return $montoTotal['ahorroporlitroproductorsocio'];
        }




    }

?>