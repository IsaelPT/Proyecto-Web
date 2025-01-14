<?php

require_once "app/models/Doctor.php";

class DoctorController
{

    private $doctor;

    public function __CONSTRUCT()
    {
        $this->doctor = new Doctor();
    }

    public function doctores()
    {

        include "vista";
    }

    public function form_doctores()
    {

        $doc = new Doctor();

        if (isset($_GET['id'])) {
            $doc = $this->doctor->obtener($_GET['id']);
        }

        include "vista";
    }

    public function guardar()
    {

        $doc = new Doctor();
        $doc->setID_Doctor($_POST['id']);
        $doc->setNombre_Doctor($_POST['nombre']);
        $doc->setApellido_Doctor($_POST['apellido']);

        $doc->getID_Doctor() > 0 ? $this->doctor->actualizar($doc) : $this->doctor->insertar($doc);
    }
}
