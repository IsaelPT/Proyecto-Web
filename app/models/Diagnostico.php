<?php

class Diagnostico
{

    private $pdo;

    private $Codigo;
    private $idDiagnostico;
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

    public function getIdDiagn()
    {
        return $this->idDiagnostico;
    }

    public function setID_Pac(int $id)
    {
        $this->idDiagnostico = $id;
    }

    public function getDetalles()
    {
        return $this->Detalles;
    }

    public function setDetalles(string $detalles)
    {
        $this->Detalles = $detalles;
    }

    public function obtenerUltimoId(): int
    {
        return (int) $this->pdo->lastInsertId(); // Casteado a int para estar seguros...
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
            $check = "SELECT COUNT(*), id_diagnostico FROM DIAGNOSTICO WHERE descripcion = ?";
            $consulta_id = $this->pdo->prepare($check);
            $consulta_id->execute([$diagnostico->getDetalles()]);
            $resul = $consulta_id->fetch(PDO::FETCH_OBJ);
            $count = $consulta_id->fetchColumn();

            // Aquí verificando que este diagnóstico no esté en la base de datos.
            if ($count == 0) {
                $q = "INSERT INTO DIAGNOSTICO(id_diagnostico, descripcion) VALUES (?,?)";
                $consulta = $this->pdo->prepare($q);
                $consulta->execute(
                    [
                        $diagnostico->getIdDiagn(),
                        $diagnostico->getDetalles()
                    ]
                );
            }
            return $resul->id_diagnostico;
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
            $diagnostico->setID_Pac($resultado->idPaciente ?? 0);
            $diagnostico->setDetalles($resultado->detalles ?? "");
            $diagnostico->setCodigo($resultado->codigo ?? "");

            return $diagnostico;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Diagnostico $diagnostico): void
    {
        try {
            $q = "UPDATE DIAGNOSTICO SET descripcion=? WHERE id_diagnostico=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $diagnostico->getDetalles(),
                    $diagnostico->getIdDiagn()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
