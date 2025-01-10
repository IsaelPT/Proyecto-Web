<?php

class Doctor{

    private $pdo;

    private $ID_Doctor;
    private $Nombre_Doctor;
    private $Apellido_Doctor;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getID_Doctor(){
        return $this->ID_Doctor;
    }

    public function setID_Doctor(int $id){
        $this->ID_Doctor = $id;
    }

    public function getNombre_Doctor(){
        return $this->Nombre_Doctor;
    }

    public function setNombre_Doctor(string $nombre){
        $this->Nombre_Doctor = $nombre;
    }

    public function getApellido_Doctor(){
        return $this->Apellido_Doctor;
    }

    public function setApellido_Doctor(string $apellido){
        $this->Apellido_Doctor = $apellido;
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELEC * FROM DOCTOR;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Doctor $obj){
        try{
            $consulta = "INSERT INTO DOCTOR(ID_Doctor,Nombre_Doctor,Apellido_Doctor) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(array($obj->getID_Doctor(),
                                                          $obj->getNombre_Doctor(),
                                                          $obj->getApellido_Doctor()));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}