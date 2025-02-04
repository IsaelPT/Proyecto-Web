<?php

require_once "app/models/Paciente.php";
require_once "app/models/Diagnostico.php";

class PacienteController
{
    private $paciente;
    private $diagnostico;


    public function __construct()
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
            $diagnostico = $this->diagnostico->obtener($_GET['id']);
        }

        include "app/views/src/pages/pacientes.php";
    }

    public function guardar(): void
    {
        $paciente = new Paciente();
        $diagnostico = new Diagnostico();

        // Paciente
        $paciente->setId(intval($_POST['id_paciente']));
        $paciente->setNombre($_POST['nombre']);
        $paciente->setPrimerApellido($_POST['apellido_1']);
        $paciente->setSegundoApellido($_POST['apellido_2']);
        $paciente->setSeguro(intval($_POST['seguro']));

        // Diagnostico
        $diagnostico->setDetalles($_POST['diagnostico']);
        $diagnostico->setID_Pac(intval($_POST['id_paciente']));
        echo $paciente->getId();
        
        if ($paciente->getId() > 0) {
            $this->paciente->actualizar($paciente);
            $this->diagnostico->actualizar($diagnostico);
        } else {
            $this->diagnostico->insertar($diagnostico);
            $idDiagnostico = $this->diagnostico->obtenerUltimoId();

            $paciente->setIdDiagnostico($idDiagnostico);
            $this->paciente->insertar($paciente);
        }

        header("Location: ?controller=Paciente");
    }

    public function eliminar(): void
    {
        $this->paciente->eliminarDiagnosticosDePaciente(id: $_GET["id"]);
        $this->paciente->eliminar(id: $_GET["id"]);
        header("Location: ?controller=Paciente");
    }
}