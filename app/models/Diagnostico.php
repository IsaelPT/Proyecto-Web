<?php

class Diagnostico
{

    private $pdo;

    private $id_diagnostico;
    private $descripcion;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::connect();
    }

    public function getId_diagnostico()
    {
        return $this->id_diagnostico;
    }

    public function setId_diagnostico(int $id)
    {
        $this->id_diagnostico = $id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $detalles)
    {
        $this->descripcion = $detalles;
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

    public function insertar(Diagnostico $diagnostico)
    {
        try {
            $check = $this->pdo->prepare("SELECT COUNT(id_diagnostico) AS cantidad, id_diagnostico 
                                                FROM DIAGNOSTICO 
                                                WHERE descripcion=?;");
            $check->execute([$diagnostico->getDescripcion()]);
            $check_in = $check->fetch(PDO::FETCH_OBJ);
            $id_diagnostico = $check_in->id_diagnostico;

            if($check_in->cantidad == 0){
                $query = $this->pdo->prepare("INSERT INTO DIAGNOSTICO(id_diagnostico, descripcion)
                                                    VALUES(?,?);");
                $query->execute([$diagnostico->getId_diagnostico(),
                                         $diagnostico->getDescripcion()]);
                $id_diagnostico = $this->pdo->lastInsertId();
            }

            return $id_diagnostico;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Diagnostico
    {
        try {
            $q = "SELECT * FROM DIAGNOSTICO WHERE id_diagnostico=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [$id]
            );

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $diagnostico = new Diagnostico();
            $diagnostico->setId_diagnostico($resultado->id_diagnostico ?? 0);
            $diagnostico->setDescripcion($resultado->descripcion ?? "");

            return $diagnostico;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
