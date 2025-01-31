<?php

class Paciente
{
    private $pdo;


    private $ID_Paciente;
    private $Nombre_Paciente;
    private $Apellido_Paciente;
    private $Seguro;

    public function __construct()
    {
        $this->pdo = DataBase::connect();
    }

    public function getID_Paciente(): int
    {
        return $this->ID_Paciente;
    }
    public function setID_Paciente(int $id): void
    {
        $this->ID_Paciente = $id;
    }

    public function getNombre_Paciente(): string
    {
        return $this->Nombre_Paciente;
    }

    public function setNombre_Paciente(string $nombre): void
    {
        $this->Nombre_Paciente = $nombre;
    }

    public function getApellido_Paciente(): string
    {
        return $this->Apellido_Paciente;
    }

    public function setApellido_Paciente(string $apellido): void
    {
        $this->Apellido_Paciente = $apellido;
    }

    public function listar(): array
    {
        try {
            $consulta = $this->pdo->prepare(
                query: "SELECT * FROM PACIENTE;"
            );
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function cantidad()
    {
        try {
            $consulta = $this->pdo->prepare(
                query: "SELECT COUNT(ID_Paciente) AS Cant_Pacientes FROM PACIENTE"
            );
            $consulta->execute();
            return $consulta->fetch(
                mode: PDO::FETCH_OBJ
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Paciente $obj)
    {
        try {
            $this->pdo->prepare(
                query: "INSERT INTO PACIENTE(ID_Paciente,Nombre_Paciente,Apellido_Paciente) VALUES (?,?,?);"
            )->execute(
                    params: [
                        $obj->getID_Paciente(),
                        $obj->getNombre_Paciente(),
                        $obj->getApellido_Paciente()
                    ]
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Paciente
    {
        try {
            $consulta = $this->pdo->prepare(
                query:
                "SELECT * FROM PACIENTE WHERE ID_Paciente=?;"
            );
            $consulta->execute(
                params: [
                    $id
                ]
            );

            $resultado = $consulta->fetch(mode: PDO::FETCH_OBJ);

            $obj = new Paciente();
            $obj->setID_Paciente(id: $resultado->ID_Paciente);
            $obj->setNombre_Paciente(nombre: $resultado->Nombre_Paciente);
            $obj->setApellido_Paciente(apellido: $resultado->Apellido_Paciente);

            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Paciente $obj): void
    {
        try {
            $this->pdo->prepare(
                query:
                "UPDATE PACIENTE SET Nombre_Paciente=?, Apellido_Paciente=? WHERE ID_Paciente=?;"
            )->execute(
                    params: [
                        $obj->getNombre_Paciente(),
                        $obj->getApellido_Paciente(),
                        $obj->getID_Paciente()
                    ]
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getSeguro()
    {
        return $this->Seguro;
    }

    public function setSeguro($Seguro)
    {
        $this->Seguro = $Seguro;

        return $this;
    }
}
