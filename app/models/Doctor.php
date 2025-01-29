<?php

class Doctor{

    private $pdo;

    private $ID_Doctor;
    private $Nombre_Doctor;
    private $Apellido_Doctor;
    private $SegApellido_Doctor;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getSegApellido_Doctor(){
        return $this->SegApellido_Doctor;
    }

    public function setSegApellido_Doctor($SegApellido_Doctor){
        $this->SegApellido_Doctor = $SegApellido_Doctor;
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
            $consulta = $this->pdo->prepare("SELECT d.id_doctor, nombre_doctor, primer_apellido_doctor, segundo_apellido_doctor, detalles
                                            FROM DOCTOR d INNER JOIN ESPECIALIDAD e ON d.id_especialidad = e.id_especialidad;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function cantidad()
    {
        try {
            $q = "SELECT COUNT(id_doctor) AS Cant_Doctores FROM DOCTOR;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Doctor $obj)
    {
        try {
            $consulta = "INSERT INTO DOCTOR(ID_Doctor,Nombre_Doctor,Apellido_Doctor,SegApellido_Doctor) VALUES (?,?,?,?)";
            $this->pdo->prepare($consulta)->execute(
                [
                    $obj->getID_Doctor(),
                    $obj->getNombre_Doctor(),
                    $obj->getApellido_Doctor(),
                    $obj->getSegApellido_Doctor()
                ]
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Doctor
    {
        try {
            $q = "SELECT * FROM DOCTOR WHERE ID_Doctor=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute([$id]);

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $obj = new Doctor();
            $obj->setID_Doctor($resultado->ID_Doctor);
            $obj->setNombre_Doctor($resultado->Nombre_Doctor);
            $obj->setApellido_Doctor($resultado->Apellido_Doctor);
            $obj->setSegApellido_Doctor($resultado->SegApellido_Doctor);

            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Doctor $obj): void
    {
        try {
            $q = "UPDATE DOCTOR SET Nombre_Doctor=?, Apellido_Doctor=?, SegApellido_Doctor=? WHERE ID_Doctor=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getNombre_Doctor(),
                    $obj->getApellido_Doctor(),
                    $obj->getSegApellido_Doctor(),
                    $obj->getID_Doctor()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(int $id): void{
        try{
            $consulta = $this->pdo->prepare("DELETE FROM DOCTOR WHERE ID_Doctor=?");
            $consulta->execute([$id]);
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
