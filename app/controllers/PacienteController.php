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

        if (isset($_GET['id']) and isset($_GET['id_diagnostico'])) {
            $paciente = $this->paciente->obtener($_GET['id']);
            $diagnostico = $this->diagnostico->obtener($_GET['id_diagnostico']);
        }

        include "app/views/src/pages/pacientes.php";
    }

    public function guardar(): void
    {
        $paciente = new Paciente();
        $diagnostico = new Diagnostico();

        $paciente->setId(intval($_POST['id_paciente']));
        $paciente->setNombre(trim($_POST['nombre']));
        $paciente->setPrimerApellido(trim($_POST['apellido_1']));
        $paciente->setSegundoApellido(trim($_POST['apellido_2']));
        $paciente->setSeguro(trim($_POST['seguro']));

        $diagnostico->setDescripcion(trim($_POST['diagnostico']));

        if($paciente->getId() > 0) {
            $id = $this->diagnostico->insertar($diagnostico);
            $paciente->setIdDiagnostico($id);
            $this->paciente->actualizar($paciente);
        }else{
            $id = $this->diagnostico->insertar($diagnostico);
            $paciente->setIdDiagnostico($id);
            $this->paciente->insertar($paciente);
        }

        header("Location: ?controller=Paciente");
    }

    public function eliminar(): void
    {
        $this->paciente->eliminar(id: $_GET["id"]);
        header("Location: ?controller=Paciente");
    }
}
