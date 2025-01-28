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
        $esp = new Especializacion();

        $doc->setID_Doctor(intval($_POST['id']));
        $doc->setNombre_Doctor($_POST['nombre']);
        $doc->setApellido_Doctor($_POST['primer_apellido']);
        $doc->setSegApellido_Doctor($_POST['segundo_apellido']);
        $esp->setDescripcion($_POST['descripcion']);
        $esp->setID_Doc(intval($_POST['id']));

        // $doc->getID_Doctor() > 0 ?
        //     $this->doctor->actualizar($doc) :
        //     $this->doctor->insertar($doc);
        if($doc->getID_Doctor() > 0) {
            $this->doctor->actualizar($doc);
        }else{
            $id = $this->doctor->insertar($doc);
            $esp->setID_Doc($id);
        }

        $doc->getID_Doctor() > 0 ?
            $this->especializacion->actualizar($esp) :
            $this->especializacion->insertar($esp);

        header("location:?controller=Doctor");
    }

    public function eliminar(): void{
        $this->doctor->eliminar($_GET["id"]);
        header("location:?controller=Doctor");
    }
}
