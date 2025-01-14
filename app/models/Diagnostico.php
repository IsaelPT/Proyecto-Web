<?php

class Diagnostico
{

    private $pdo;

    private $Codigo;
    private $ID_Pac;
    private $Detalles;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::connect();
    }

    public function getCodigo()
    {
        return $this->Codigo;
    }

    public function setCodigo(string $codigo)
    {
        $this->Codigo = $codigo;
    }

    public function getID_Pac()
    {
        return $this->ID_Pac;
    }

    public function setID_Pac(int $id)
    {
        $this->ID_Pac = $id;
    }

    public function getDetalles()
    {
        return $this->Detalles;
    }

    public function setDetalles(string $detalles)
    {
        $this->Detalles = $detalles;
    }

    public function cantidad()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT SUM(Codigo) AS Cant_Diagnosticos FROM DIAGNOSTICO;");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function listar()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT * FROM DIAGNOSTICO;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Diagnostico $obj)
    {
        try {
            $consulta = "INSERT INTO DIAGNOSTICO(Codigo,ID_Paciente,Detalles) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(array(
                $obj->getCodigo(),
                $obj->getID_Pac(),
                $obj->getDetalles()
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
