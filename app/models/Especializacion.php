<?php

class Especializacion{

    private $pdo;

    private $ID_Especializacion;
    private $Descripcion;
    private $ID_Doc;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getID_Especializacion(){
        return $this->ID_Especializacion;
    }

    public function setID_Especializacion(int $id){
        $this->ID_Especializacion = $id;
    }

    public function getDescripcion(){
        return $this->Descripcion;
    }

    public function setDescripcion(string $descripcion){
        $this->Descripcion = $descripcion;
    }

    public function getID_Doc(){
        return $this->ID_Doc;
    }

    public function setID_Doc(int $id_doc){
        $this->ID_Doc = $id_doc;
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELEC * FROM ESPECIALIZACION;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Especializacion $obj){
        try{
            $consulta = "INSERT INTO ESPECIALIZACION(ID_Especializacion,Descripcion,ID_Doc) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(array($obj->getID_Especializacion(),
                                                          $obj->getDescripcion(),
                                                          $obj->getID_Doc()));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}