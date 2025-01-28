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
            $consulta = $this->pdo->prepare("SELECT * FROM ESPECIALIZACION;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Especializacion $obj): void
    {
        try {
            $q = "INSERT INTO ESPECIALIZACION(ID_Especializacion,Descripcion,ID_Doc) VALUES (?,?,?)";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getID_Especializacion(),
                    $obj->getDescripcion(),
                    $obj->getID_Doc()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Especializacion
    {
        try {
            $q = "SELECT * FROM ESPECIALIZACION WHERE ID_Doc=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute([$id]);

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $obj = new Especializacion();
            $obj->setID_Doc($resultado->ID_Doc);
            $obj->setID_Especializacion($resultado->ID_Especializacion);
            $obj->setDescripcion($resultado->Descripcion);

            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Especializacion $obj): void
    {
        try {
            $q = "UPDATE ESPECIALIZACION SET Descripcion=? WHERE ID_Doc=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute([
                $obj->getDescripcion(),
                $obj->getID_DOc()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
