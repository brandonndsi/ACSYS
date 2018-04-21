<?php

include './businesPrecioLeche.php';

$businesPrecioLeche = new businesPrecioLeche();

$action = $_POST['action'];

if ($action == "verprecioleche") {
    echo $businesPrecioLeche->verPrecio();
} else if ($action == "modificarprecio") {

    $id = htmlentities($_POST['id']);
    $precio = htmlentities($_POST['precio']);

    if ($precio > 0 || !empty($id) || !empty($precio)) {
        echo $businesPrecioLeche->actualizarPrecio($id, $precio);
    } else {
        echo("false");
    }
}
?>