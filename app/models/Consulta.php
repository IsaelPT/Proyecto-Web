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
            $consulta = $this->pdo->prepare("SELECT ID_Doc, ID_Pac,Nombre_Doctor, Apellido_Doctor, Nombre_Paciente, Apellido_Paciente
                                                    FROM DOCTOR d INNER JOIN CONSULTA c ON d.ID_Doctor = c.ID_Doc
                                                    INNER JOIN PACIENTE p ON c.ID_Pac = p.ID_Paciente;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function cantidad()
    {
        try {
            $q = "SELECT COUNT(ID_Doc) AS Cant_Consultas FROM CONSULTA;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Consulta $obj): void
    {
        try {
            $q = "INSERT INTO CONSULTA(ID_Pac, ID_Doc) VALUES (?,?);";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getID_Pac(),
                    $obj->getID_Doc()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(int $id_doc, int $id_pac): void{
        try{
            $consulta = $this->pdo->prepare("DELETE FROM CONSULTA WHERE ID_Doc=? AND ID_Pac=?");
            $consulta->execute([$id_doc, $id_pac]);
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
