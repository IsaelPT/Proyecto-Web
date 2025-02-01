<?php

require_once "app/models/Doctor.php";
require_once "app/models/Especializacion.php";

class DoctorController
{
    private $doctor;
    private $especializacion;

    public function __construct()
    {
        $this->doctor = new Doctor();
        $this->especializacion = new Especializacion();
    }

    public function principal(): void
    {
        include "app/views/src/pages/listado_doctores.php";
    }

    public function form_doctores(): void
    {
        $doc = new Doctor();
        $esp = new Especializacion();

        if (isset($_GET['id'])) {
            $doc = $this->doctor->obtener($_GET['id']);
            $esp = $this->especializacion->obtener($_GET['id']);
        }

        include "app/views/src/pages/doctores.php";
    }

    public function guardar(): void
    {

        $doc = new Doctor();

        $doc->setID_Doctor(intval($_POST['id_doctor']));
        $doc->setNombre_Doctor($_POST['nombre_doctor']);
        $doc->setApellido_Doctor($_POST['primer_apellido_doctor']);
        $doc->setSegApellido_Doctor($_POST['segundo_apellido_doctor']);
        $doc->setId_especilidad(intval($_POST['id_especialidad']));

        $doc->getID_Doctor() > 0 ?
            $this->doctor->actualizar($doc) :
            $this->doctor->insertar($doc);

        header("location:?controller=Doctor");
    }

    public function eliminar(): void
    {
        $this->doctor->eliminarConsultasDeDoctor($_GET["id"]);
        $this->doctor->eliminar($_GET["id"]);
        header("location:?controller=Doctor");
    }
}
