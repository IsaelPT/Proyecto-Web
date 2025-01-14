<?php

class Paciente{

    private $pdo;

    private $ID_Paciente;
    private $Nombre_Paciente;
    private $Apellido_Paciente;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getID_Paciente(){
        return $this->ID_Paciente;
    }

    public function setID_Paciente(int $id){
        $this->ID_Paciente = $id;
    }

    public function getNombre_Paciente(){
        return $this->Nombre_Paciente;
    }

    public function setNombre_Paciente(string $nombre){
        $this->Nombre_Paciente = $nombre;
    }

    public function getApellido_Paciente(){
        return $this->Apellido_Paciente;
    }

    public function setApellido_Paciente(string $apellido){
        $this->Apellido_Paciente = $apellido;
    }

    public function cantidad(){
        try{
            $consulta = $this->pdo->prepare("SELECT SUM(ID_Paciente) AS Cant_Pacientes FROM PACIENTE;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        }catch(Excption $e){
            die($e->getMessage());
        }
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELECT * FROM PACIENTE;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Paciente $obj){
        try{
            $consulta = "INSERT INTO PACIENTE(ID_Paciente,Nombre_Paciente,Apellido_Paciente) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(array($obj->getID_Paciente(),
                                                          $obj->getNombre_Paciente(),
                                                          $obj->getApellido_Paciente()));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}