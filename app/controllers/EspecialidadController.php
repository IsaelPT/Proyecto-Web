<?php

require_once "app/models/Especializacion.php";

class EspecialidadController{

    private $especialidad;

    public function __construct(){
        $this->especialidad = new Especializacion();
    }

    public function principal(){
        include "app/views/src/pages/listado_especialidades.php";
    }

    public function form_especialidades(){
        $esp = new Especializacion();

        if(isset($_GET["id"])){
            $esp = $this->especialidad->obtener($_GET["id"]);
        }

        include "app/views/src/pages/especialidades.php";
    }

    public function guardar(){
        $esp = new Especializacion();

        $esp->setID_Especializacion(intval($_POST["id_especialidad"]));
        $esp->setDescripcion($_POST["detalles"]);

        $esp->getID_Especializacion() > 0 ?
        $this->especialidad->actualizar($esp):
        $this->especialidad->insertar($esp);

        header("location:?controller=Especialidad");
    }

    public function eliminar(){
        $this->especialidad->eliminar($_GET["id"]);
        header("location:?controller=Especialidad");
    }
}