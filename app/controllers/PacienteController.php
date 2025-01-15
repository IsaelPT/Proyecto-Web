<?php

require_once "app/models/Paciente.php";
require_once "app/models/Diagnostico.php";

class PacienteController{

    private $paciente;
    private $diagnostico;

    public function _CONTRUCT(){
        $paciente = new Paciente();
        $diagnostico = new Diagnostico();
    }

    public function pacientes(){

        include "vista";
    }

    public function form_pacientes(){

        $pac = new Paciente();
        $diag = new Diagnostico();

        if(isset($_GET['id'])){
            $pac = $this->paciente->obtener($_GET['id']);
            $diag = $this->diagnostico->obtener($_GET['id']);
        }

        include "vista";
    }

    public function guardar(){

        $pac = new Paciente;
        $diag = new Diagnostico();
        $pac->setID_Paciente($_POST['id']);
        $pac->setNombre_Paciente($_POST['nombre']);
        $pac->setApellido_Paciente($_POST['apellido']);
        $diag->setDetalles($_POST['detalles']);
        $diag->setID_Pac($_POST['id']);

        $pac->getID_Paciente() > 0 ? $this->paciente->actualizar($pac) : $this->paciente->insertar($pac);
        $pac->getID_Paciente() > 0 ? $this->diagnostico->actualizar($diag) : $this->diagnostico->insertar($diag);
    }
}