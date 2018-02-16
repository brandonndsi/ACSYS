<?php 
	class DistribuidorBusiness{

		private $Distribuidor;

		function DistribuidorBusiness(){
			include_once '../../data/distribuidor/DistribuidorData.php';
			$this->Distribuidor = new DistribuidorData();
		}

		function DistribuidorMostrar(){
            $dato=$this->Distribuidor->DistribuidorMostrar();
           return $dato; 
    	}

    	public function DistribuidorModificar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo,$id){
            

    		return $this->Distribuidor->DistribuidorModificar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo,$id);
    	}

     	public function DistribuidorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    		return $this->Distribuidor->DistribuidorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
    	}

    	public function DistribuidorEliminar($idpersona){

        	return $this->Distribuidor->DistribuidorEliminar($idpersona);
    	}

	}
    /*
    $po = new DistribuidorBusiness();
    $d = $po->DistribuidorMostrar();
    print_r($d);*/
 ?>