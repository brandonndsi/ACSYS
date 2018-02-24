<?php

class businessJuntaDirectiva {

    private $dataJuntaDirectiva;

    public function businessJuntaDirectiva() {

        include_once '../../data/juntaDirectiva/dataJuntaDirectiva.php';
        $this->dataJuntaDirectiva = new dataJuntaDirectiva();
    }

    public function juntasDirectivasMostrar() {
        return $this->dataJuntaDirectiva->juntasDirectivasMostrar();
    }

    public function juntaDirectivaRegistrar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final) {

        return $this->dataJuntaDirectiva->juntaDirectivaRegistrar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final);
    }

    public function juntaDirectivaModificar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final, $id) {

        return $this->dataJuntaDirectiva->juntaDirectivaModificar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final, $id);
    }

}

?>
