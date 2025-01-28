<?php

require_once "app/models/Paciente.php";
require_once "app/models/Diagnostico.php";

class PacienteController
{
    private $paciente;
    private $diagnostico;


    public function _CONTRUCT(): void
    {
        $this->paciente = new Paciente();
        $this->diagnostico = new Diagnostico();
    }

    public function principal(): void
    {
        include "app/views/src/pages/listado_pacientes.php";
    }

    public function form_pacientes(): void
    {
        $paciente = new Paciente();
        $diagnostico = new Diagnostico();

        if (isset($_GET['id'])) {
            $paciente = $this->paciente->obtener($_GET['id']);
            $diagnost = $this->diagnostico->obtener($_GET['id']);
        }

        include "app/views/src/pages/pacientes.php";
    }

    public function guardar(): void
    {
        $paciente = new Paciente;
        $diagnost = new Diagnostico();

        $paciente->setID_Paciente($_POST['id']);
        $paciente->setNombre_Paciente($_POST['nombre']);
        $paciente->setApellido_Paciente($_POST['apellido']);

        $diagnost->setDetalles($_POST['detalles']);
        $diagnost->setID_Pac($_POST['id']);

        $paciente->getID_Paciente() > 0 ? $this->paciente->actualizar($paciente) : $this->paciente->insertar($paciente);
        $paciente->getID_Paciente() > 0 ? $this->diagnostico->actualizar($diagnost) : $this->diagnostico->insertar($diagnost);
    }
}