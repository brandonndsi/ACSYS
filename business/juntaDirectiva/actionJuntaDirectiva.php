<?php

include './businessJuntaDirectiva.php';

$businessJuntaDirectiva = new businessJuntaDirectiva();

$action = $_POST['action'];

if ($action == "consultarjuntas") {
    echo $businessJuntaDirectiva->juntasDirectivasMostrar();
} else if ($action == "registrarjunta") {

} else if ($action == "modificarjunta") {

} else if ($action == "eliminarjunta") {

}
?>
