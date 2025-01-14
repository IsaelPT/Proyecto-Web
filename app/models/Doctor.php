<?php

class Doctor
{

    private $pdo;

    private $ID_Doctor;
    private $Nombre_Doctor;
    private $Apellido_Doctor;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::connect();
    }

    public function getID_Doctor()
    {
        return $this->ID_Doctor;
    }

    public function setID_Doctor(int $id)
    {
        $this->ID_Doctor = $id;
    }

    public function getNombre_Doctor()
    {
        return $this->Nombre_Doctor;
    }

    public function setNombre_Doctor(string $nombre)
    {
        $this->Nombre_Doctor = $nombre;
    }

    public function getApellido_Doctor()
    {
        return $this->Apellido_Doctor;
    }

    public function setApellido_Doctor(string $apellido)
    {
        $this->Apellido_Doctor = $apellido;
    }

    public function cantidad()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT COUNT(ID_Doctor) AS Cant_Doctores FROM DOCTOR;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT ID_Doctor, Nombre_Doctor, Apellido_Doctor, Descripcion FROM DOCTOR
                                            INNER JOIN ESPECIALIZACION ON ID_Doctor = ID_Doc;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Doctor $obj)
    {
        try {
            $consulta = "INSERT INTO DOCTOR(ID_Doctor,Nombre_Doctor,Apellido_Doctor) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(array(
                $obj->getID_Doctor(),
                $obj->getNombre_Doctor(),
                $obj->getApellido_Doctor()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id)
    {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM DOCTOR WHERE ID_Doctor=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            $obj = new Doctor();
            $obj->setID_Doctor($resultado->ID_Doctor);
            $obj->setNombre_Doctor($resultado->Nombre_Doctor);
            $obj->setApellido_Doctor($resultado->Apellido_Doctor);
            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Doctor $obj)
    {
        try {
            $consulta = $this->pdo->prepare("UPDATE DOCTOR SET Nombre_Doctor=?, Apellido_Doctor=? WHERE ID_Doctor=?;");
            $consulta->execute(array($obj->getNombre_Doctor(), $obj->getApellido_Doctor(), $obj->getID_Doctor()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
