<?php

require_once "app/models/Consulta.php";
require_once "app/models/Paciente.php";
require_once "app/models/Doctor.php";

class ConsultaController{

    private $consulta;
    private $paciente;
    private $doctor;
    private $diagnostico;

    public function __construct(){
        $this->consulta = new Consulta();
        $this->paciente = new Paciente();
        $this->doctor = new Doctor();
    }

    public function principal(){

        include "app/views/src/pages/listadoConsult.php";
    }

    public function form_consulta(){

        include "app/views/src/pages/addConsult.php";
    }

    public function guardar(){
        $cons = new Consulta();

        $cons->setID_Pac($_POST['id_pac']);
        $cons->setID_Doc($_POST['id_doc']);


        $this->consulta->insertar($cons);

        header("location:?controller=Consulta");
        
    }

    public function eliminar(){
        $this->consulta->eliminar($_GET["id_doc"], $_GET["id_pac"]);
        header("location:?controller=Consulta");
        
    }
}