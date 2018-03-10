<?php
	class conexion{
		private $user;
		private $pass;
		private $server;
		private $db;
		private  $link;
		function __construct(){
			$hostName = gethostname();
      switch ($hostName) {
          case "nana":
              $this->server = "localhost";
              $this->user = "root";
              $this->pass = "";
              $this->db = "dbacsys1";
              break;
          case "PC": //laptop's PC
				$this->server = "localhost";
				$this->user = "root";
				$this->pass = "";
				$this->db = "dbacsys1";
                break;
          default: //Hosting
			  $this->server = "localhost";
              $this->user = "root";
              $this->pass = "";
              $this->db = "dbacsys1";
              break;
      }
			date_default_timezone_set("America/Costa_Rica");
		}

		function crearConexion(){
			
				
			$this->link =mysqli_connect($this->server,$this->user,$this->pass,$this->db);
			
			
			return $this->link;
		}
		function cerrarConexion(){
			mysqli_close ($this->link);
		}
	}
?>
