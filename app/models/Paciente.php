<?php

class Paciente
{

    private $pdo;

    private $ID_Paciente;
    private $Nombre_Paciente;
    private $Apellido_Paciente;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::connect();
    }

    public function getID_Paciente()
    {
        return $this->ID_Paciente;
    }

    public function setID_Paciente(int $id)
    {
        $this->ID_Paciente = $id;
    }

    public function getNombre_Paciente()
    {
        return $this->Nombre_Paciente;
    }

    public function setNombre_Paciente(string $nombre)
    {
        $this->Nombre_Paciente = $nombre;
    }

    public function getApellido_Paciente()
    {
        return $this->Apellido_Paciente;
    }

    public function setApellido_Paciente(string $apellido)
    {
        $this->Apellido_Paciente = $apellido;
    }

    public function cantidad()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT SUM(ID_Paciente) AS Cant_Pacientes FROM PACIENTE;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT ID_Paciente, Nombre_Paciente, Apellido_Paciente, Detalles as Diagnostico
                                             FROM PACIENTE INNER JOIN DIAGNOSTICO on ID_Paciente = ID_Pac;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Paciente $obj)
    {
        try {
            $consulta = "INSERT INTO PACIENTE(ID_Paciente,Nombre_Paciente,Apellido_Paciente) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(array(
                $obj->getID_Paciente(),
                $obj->getNombre_Paciente(),
                $obj->getApellido_Paciente()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id)
    {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM PACIENTE WHERE ID_Paciente=?;");
            $consulta->execute(array($id));
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            $obj = new Paciente();
            $obj->setID_Paciente($resultado->ID_Paciente);
            $obj->setNombre_Paciente($resultado->Nombre_Paciente);
            $obj->setApellido_Paciente($resultado->Apellido_Paciente);
            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Paciente $obj)
    {
        try {
            $consulta = $this->pdo->prepare("UPDATE Paciente SET Nombre_Paciente=?, Apellido_Paciente=? WHERE ID_Paciente=?;");
            $consulta->execute(array($obj->getNombre_Paciente(), $obj->getApellido_Paciente(), $obj->getID_Paciente()));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
