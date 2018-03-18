<?php 
	class DistribuidorBusiness{

		private $Distribuidor;
    private $VentaDistribuidor;

		function DistribuidorBusiness(){
			include_once '../../data/distribuidor/DistribuidorData.php';
      include_once '../../data/ventas/dataVentaDistribuidor.php';
			$this->Distribuidor = new DistribuidorData();
      $this->VentaDistribuidor = new dataVentaDistribuidor();
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

      public function searchProduct($code){
      return $this->VentaDistribuidor->searchProduct($code);
    }

    public function procesarVenta($productos,$idCliente,$totalNeto,$totalBruto){
      return $this->VentaDistribuidor->procesarVenta($productos,$idCliente,$totalNeto,$totalBruto);
    }

	}
    /*
    $po = new DistribuidorBusiness();
    $d = $po->DistribuidorMostrar();
    print_r($d);*/
 ?>