<?php

require_once "app/models/Doctor.php";
require_once "app/models/Paciente.php";
require_once "app/models/Consulta.php";

class DashboardController
{
    private $doctor;
    private $paciente;
    private $consulta;

    public function __construct()
    {
        $this->doctor = new Doctor();
        $this->paciente = new Paciente();
        $this->consulta = new Consulta();
    }

    public function principal(): void
    {
        include "app/views/src/pages/dahsboard.php";
    }
}
