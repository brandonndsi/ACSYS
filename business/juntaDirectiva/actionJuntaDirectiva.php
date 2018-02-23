<?php

include './businessJuntaDirectiva.php';

$businessJuntaDirectiva = new businessJuntaDirectiva();

$action = $_POST['action'];

if ($action == "consultarjuntas") {

    echo $businessJuntaDirectiva->juntasDirectivasMostrar();
} else if ($action == "registrarjunta") {

    $presidente = htmlentities($_POST['presidente']);
    $vicepresidente = htmlentities($_POST['vicepresidente']);
    $secretario = htmlentities($_POST['secretario']);
    $tesorero = htmlentities($_POST['tesorero']);
    $fiscal = htmlentities($_POST['fiscal']);
    $vocal1 = htmlentities($_POST['vocal1']);
    $vocal2 = htmlentities($_POST['vocal2']);
    $inicio = htmlentities($_POST['inicio']);
    $final = htmlentities($_POST['final']);

    if (empty($presidente) || empty($vicepresidente) || empty($secretario) || empty($tesorero) ||
            empty($fiscal) || empty($vocal1) || empty($vocal2) || empty($inicio) || empty($final)) {
        echo("false");
    } else {
        echo $businessJuntaDirectiva->juntaDirectivaRegistrar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final);
    }
} else if ($action == "modificarjunta") {
    
    $presidente = htmlentities($_POST['presidente']);
    $vicepresidente = htmlentities($_POST['vicepresidente']);
    $secretario = htmlentities($_POST['secretario']);
    $tesorero = htmlentities($_POST['tesorero']);
    $fiscal = htmlentities($_POST['fiscal']);
    $vocal1 = htmlentities($_POST['vocal1']);
    $vocal2 = htmlentities($_POST['vocal2']);
    $inicio = htmlentities($_POST['inicio']);
    $final = htmlentities($_POST['final']);
    $id = htmlentities($_POST['id']);

    if (empty($presidente) || empty($vicepresidente) || empty($secretario) || empty($tesorero) ||
            empty($fiscal) || empty($vocal1) || empty($vocal2) || empty($inicio) || empty($final) || empty($id)) {
        echo("false");
    } else {
        echo $businessJuntaDirectiva->juntaDirectivaModificar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final, $id);
    }
}
?>
