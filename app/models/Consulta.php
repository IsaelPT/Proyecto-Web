<?php

class Consulta{

    private $pdo;

    private $id_paciente;
    private $id_doctor;
    private $id_consulta;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    private function getId_consulta(){
        return $this->id_consulta;
    }

    private function setId_consulta($id_consulta){
        $this->id_consulta = $id_consulta;
    }

    public function getID_Pac(){
        return $this->id_paciente;
    }

    public function setID_Pac(int $id_pac){
        $this->id_paciente = $id_pac;
    }

    public function getID_Doc(){
        return $this->id_doctor;
    }

    public function setID_Doc(int $id_doc){
        $this->id_doctor = $id_doc;
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELECT c.fecha_consulta,
                                                           c.id_consulta,
                                                           c.id_doctor, 
                                                           c.id_paciente, 
                                                           nombre_doctor, 
                                                           primer_apellido_doctor, 
                                                           nombre_paciente, 
                                                           primer_apellido_paciente
                                                    FROM DOCTOR d INNER JOIN CONSULTA c ON d.id_doctor = c.id_doctor
                                                    INNER JOIN PACIENTE p ON c.id_paciente = p.id_paciente;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function cantidad()
    {
        try {
            $q = "SELECT COUNT(id_consulta) AS Cant_Consultas FROM CONSULTA;";
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
            $q = "INSERT INTO CONSULTA(id_consulta, id_paciente, id_doctor) VALUES (?,?,?);";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getId_consulta(),
                    $obj->getID_Pac(),
                    $obj->getID_Doc()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(int $id_consulta): void{
        try{
            $consulta = $this->pdo->prepare("DELETE FROM CONSULTA WHERE id_consulta=?");
            $consulta->execute([$id_consulta]);
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
