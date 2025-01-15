<?php

require_once "app/models/Doctor.php";
require_once "app/models/Especializacion.php";

class DoctorController
{

    private $doctor;
    private $especializacion;

    public function __CONSTRUCT()
    {
        $this->doctor = new Doctor();
        $this->especializacion = new Especializacion();
    }

    public function doctores()
    {

        include "vista";
    }

    public function form_doctores()
    {

        $doc = new Doctor();
        $esp = new Especializacion();

        if (isset($_GET['id'])) {
            $doc = $this->doctor->obtener($_GET['id']);
            $esp = $this->especializacion->obtener($_GET['id']);
        }

        include "vista";
    }

    public function guardar()
    {

        $doc = new Doctor();
        $esp = new Especializacion();
        $doc->setID_Doctor($_POST['id']);
        $doc->setNombre_Doctor($_POST['nombre']);
        $doc->setApellido_Doctor($_POST['apellido']);
        $esp->setDescripcion($_POST['descripcion']);
        $esp->setID_Doc($_POST['id']);

        $doc->getID_Doctor() > 0 ? $this->doctor->actualizar($doc) : $this->doctor->insertar($doc);
        $doc->getID_Doctor() > 0 ? $this->especializacion->actualizar($esp) : $this->especializacion->insertar($esp);
    }
}
