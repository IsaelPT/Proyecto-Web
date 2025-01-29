<?php

require_once "app/models/Doctor.php";
require_once "app/models/Paciente.php";
require_once "app/models/Consulta.php";
require_once "app/models/Especializacion.php";

class DashboardController
{
    private $doctor;
    private $paciente;
    private $consulta;
    private $especialidad;

    public function __construct()
    {
        $this->doctor = new Doctor();
        $this->paciente = new Paciente();
        $this->consulta = new Consulta();
        $this->especialidad = new Especializacion();
    }

    public function principal(): void
    {
        include "app/views/src/pages/dahsboard.php";
    }
}
