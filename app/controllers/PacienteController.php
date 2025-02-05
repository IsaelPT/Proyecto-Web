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

        // Datos Paciente...
        $paciente_id = intval($_POST['id_paciente']);
        $paciente_id_diagnostico = intval($_POST['id_diagnostico']);
        $paciente_nombre = $_POST['nombre'];
        $paciente_apellido1 = $_POST['apellido_1'];
        $paciente_apellido2 = $_POST['apellido_2'];
        $paciente_seguro = intval($_POST['seguro']);
        // Datos Diagnóstico...
        $diagnostico_detalles = $_POST['diagnostico'];
        $diagnostico_id_paciente = intval($_POST['id_diagnostico']);

        // Rellenar datos de paciente
        $paciente->setId($paciente_id);
        $paciente->setIdDiagnostico($paciente_id_diagnostico);
        $paciente->setNombre($paciente_nombre);
        $paciente->setPrimerApellido($paciente_apellido1);
        $paciente->setSegundoApellido($paciente_apellido2);
        $paciente->setSeguro($paciente_seguro);
        // Rellenar datos de diagnostico
        $diagnostico->setDetalles($diagnostico_detalles);
        $diagnostico->setID_Pac($diagnostico_id_paciente);

        // De estar el Paciente en la base de datos, se procede a insertarlo Insertarlo, en caso contrario se Actualiza.
        if ($paciente_id > 0) {
            $idDiagnostico = $this->diagnostico->insertar($diagnostico);

            // Si existe ya un diagnóstico, se toma ese id.
            if ($idDiagnostico > 0) {
                $paciente->setIdDiagnostico($idDiagnostico);
            } else {
                // Se obtiene el último ID de la tabla diagnóstico y se le especifica al paciente ese ID de diag.
                $idDiagnostico = $diagnostico->obtenerUltimoId();
                $paciente->setIdDiagnostico($idDiagnostico);
            }
            $this->paciente->actualizar($paciente);
        } else {
            $idDiagnostico = $this->diagnostico->insertar($diagnostico);

            if ($idDiagnostico > 0) {
                $paciente->setIdDiagnostico($idDiagnostico);
            } else {
                $idDiagnostico = $diagnostico->obtenerUltimoId();
                $paciente->setIdDiagnostico($idDiagnostico);
            }

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
