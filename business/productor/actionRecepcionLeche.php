<? php 

	include 'businessRecepcionLeche.php';
	$businessRecepcionLeche = new businessRecepcionLeche();
	if($action=="registrarLeche") {
		$cliente=$_POST['cliente'] ;
      	$fecha=$_POST['fecha'] ;
      	$tarde=$_POST['tarde'];
      	$manana=$_POST['manana'];
              
      	if(empty($tarde)||empty($manana)){
            echo("false");
        }
        echo $businessRecepcionLeche->registrarLeche($cliente,$fecha,$tarde,$manana);
    }



?>