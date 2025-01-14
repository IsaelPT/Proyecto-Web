<?php

require_once "app/models/Doctor.php";
require_once "app/models/Paciente.php";
require_once "app/models/Diagnostico.php";

class DashboardController{

    private $doctor;
    private $paciente;
    private $diagnostico;

    public function __CONSTRUCT(){
        $this->doctor = new Doctor();
        $this->paciente = new Paciente();
        $this->diagnostico = new Diagnostico();
    }

    public function principal(){

        include "vista";

    }
}