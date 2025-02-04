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

    public function obtenerUltimoId(): int
    {
        return $this->pdo->lastInsertId();
    }

    public function listar()
    {
        try {
            $consulta = $this->pdo->prepare("SELEC * FROM DIAGNOSTICO;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Diagnostico $diagnostico): void
    {
        try {
            $check = "SELECT COUNT(*) FROM DIAGNOSTICO WHERE descripcion = ?";
            $consulta = $this->pdo->prepare($check);
            $consulta->execute([$diagnostico->getDetalles()]);
            $count = $consulta->fetchColumn();

            // Aquí verificando que este diagnóstico no esté en la base de datos.
            if ($count == 0) {
                $q = "INSERT INTO DIAGNOSTICO(id_diagnostico, descripcion) VALUES (?,?)";
                $consulta = $this->pdo->prepare($q);
                $consulta->execute(
                    [
                        $diagnostico->getID_Pac(),
                        $diagnostico->getDetalles()
                    ]
                );
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): ?Diagnostico
    {
        try {
            $q = "SELECT * FROM DIAGNOSTICO WHERE id_diagnostico=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [$id]
            );

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            if (!$resultado) {
                return null;
            }

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
                    $diagnostico->getID_Pac()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
