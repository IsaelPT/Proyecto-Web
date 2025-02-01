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
        $paciente->setId(id: intval(value: $_POST['id_paciente']) ?: 0);
        $paciente->setNombre(nombre: $_POST['nombre'] ?? "");
        $paciente->setPrimerApellido(primerApellido: $_POST['apellido_1'] ?? "");
        $paciente->setSegundoApellido(segundoApellido: $_POST['apellido_2'] ?? "");
        $paciente->setSeguro(seguro: intval(value: $_POST['seguro'] ?: 0));

        // Diagnostico
        $diagnostico->setDetalles(detalles: $_POST['diagnostico'] ?? "");
        $diagnostico->setID_Pac(id: intval(value: $_POST['id_paciente']) ?: 0);

        if ($paciente->getId() > 0) {
            $this->paciente->actualizar(paciente: $paciente);
            $this->diagnostico->actualizar(diagnostico: $diagnostico);
        } else {
            $this->diagnostico->insertar(diagnostico: $diagnostico);
            $idDiagnostico = $this->diagnostico->obtenerUltimoId();

            $paciente->setIdDiagnostico(id: $idDiagnostico);
            $this->paciente->insertar(paciente: $paciente);
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