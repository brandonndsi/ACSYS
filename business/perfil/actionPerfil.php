<?php

include './businessPerfil.php';

$businessPerfil = new businessPerfil();

$action = $_POST['action'];

if ($action == "modificarperfil") {

    $id = htmlentities($_POST['id']);
    $password = htmlentities($_POST['password']);
    $password2 = htmlentities($_POST['password2']);
    $password3 = htmlentities($_POST['password3']);

    if (empty($id) || empty($password) || empty($password2) || empty($password3)) {
        echo("false");
    } else {
        if (strlen($password2) >= 4 && strlen($password3) >= 4 && $password2 == $password3) {
            $passwordfinal = $password2;
            echo $businessPerfil->perfilModificar($id, $passwordfinal,$password);
        } else {
            echo("false");
        }
    }
}
?>