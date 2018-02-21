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

    public function juntaDirectivaRegistrar() {

        return $this->dataJuntaDirectiva->juntaDirectivaRegistrar();
    }

    public function juntaDirectivaModificar() {

        return $this->dataJuntaDirectiva->juntaDirectivaModificar();
    }

    public function juntaDirectivaEliminar($id) {

        return $this->dataJuntaDirectiva->juntaDirectivaEliminar($id);
    }

}

?>
