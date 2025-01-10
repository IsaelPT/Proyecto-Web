<?php

class Consulta{

    private $pdo;

    private $ID_Pac;
    private $ID_Doc;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getID_Pac(){
        return $this->ID_Pac;
    }

    public function setID_Pac(int $id_pac){
        $this->ID_Pac = $id_pac;
    }

    public function getID_Doc(){
        return $this->ID_Doc;
    }

    public function setID_Doc(int $id_doc){
        $this->ID_Doc = $id_doc;
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELEC * FROM CONSULTA;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Consulta $obj){
        try{
            $consulta = "INSERT INTO CONSULTA(ID_Pac,ID_Doc) VALUES (?,?)";
            $this->pdo->prepare($consulta)->execute(array($obj->getID_Pac(), $obj->getID_Doc()));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}