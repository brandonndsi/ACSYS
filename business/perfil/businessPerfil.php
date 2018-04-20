<?php

class businessPerfil {

    private $dataPerfil;

    public function businessPerfil() {

        include_once '../../data/perfil/dataPerfil.php';
        $this->dataPerfil = new dataPerfil();
    }

    public function perfilModificar($id, $passwordfinal,$password) {

        return $this->dataPerfil->perfilModificar($id, $passwordfinal,$password);
    }


}

?>