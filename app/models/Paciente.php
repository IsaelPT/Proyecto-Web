<?php

class Paciente
{
    private $pdo;
    private $id_paciente;
    private $id_diagnostico;
    private $nombre;
    private $primerApellido;
    private $segundoApellido;
    private $seguro;

    public function __construct()
    {
        $this->pdo = DataBase::connect();
    }

    public function getId(): int
    {
        return $this->id_paciente ?? 0;
    }
    public function setId(int $id): void
    {
        $this->id_paciente = $id;
    }

    public function setIdDiagnostico(int $id): void
    {
        $this->id_diagnostico = $id;
    }

    public function getIdDiagnostico(): int
    {
        return $this->id_diagnostico;
    }

    public function getNombre(): string
    {
        return $this->nombre ?? "";
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPrimerApellido(): string
    {
        return $this->primerApellido ?? "";
    }

    public function setPrimerApellido(string $primerApellido): void
    {
        $this->primerApellido = $primerApellido;
    }

    public function getSegundoApellido(): string
    {
        return $this->segundoApellido ?? "";
    }

    public function setSegundoApellido($segundoApellido): void
    {
        $this->segundoApellido = $segundoApellido;
    }

    public function getSeguro(): int
    {
        return $this->seguro ?? 0;
    }

    public function getDiagnosticoPaciente(): string
    {
        try {
            $consulta = $this->pdo->prepare(
                query: "SELECT d.descripcion FROM DIAGNOSTICO d INNER JOIN PACIENTE p ON d.id_diagnostico = p.id_diagnostico WHERE p.id_paciente=?;"
            );
            $consulta->execute(
                params: [
                    $this->getId()
                ]
            );

            return $consulta->fetch(
                mode: PDO::FETCH_OBJ
            )->descripcion ?? "";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function setSeguro($seguro): void
    {
        $this->seguro = $seguro;
    }

    public function listar(): array
    {
        try {
            $consulta = $this->pdo->prepare(
                query: "SELECT p.id_paciente, p.nombre_paciente, p.primer_apellido_paciente, p.segundo_apellido_paciente, p.numero_seguro, d.descripcion FROM PACIENTE p INNER JOIN DIAGNOSTICO d ON p.id_diagnostico = d.id_diagnostico;"
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
                query: "SELECT COUNT(id_paciente) AS Cant_Pacientes FROM PACIENTE"
            );
            $consulta->execute();
            return $consulta->fetch(
                mode: PDO::FETCH_OBJ
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Paciente $paciente): void
    {
        try {
            $this->pdo->prepare(
                query: "INSERT INTO PACIENTE(id_paciente,nombre_paciente,primer_apellido_paciente, segundo_apellido_paciente, numero_seguro, id_diagnostico) VALUES (?,?,?,?,?,?);"
            )->execute(
                    params: [
                        $paciente->getId(),
                        $paciente->getNombre(),
                        $paciente->getPrimerApellido(),
                        $paciente->getSegundoApellido(),
                        $paciente->getSeguro(),
                        $paciente->getIdDiagnostico()
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
                query: "SELECT * FROM PACIENTE WHERE id_paciente=?;"
            );
            $consulta->execute(
                params: [
                    $id
                ]
            );

            $resultado = $consulta->fetch(mode: PDO::FETCH_OBJ);

            $paciente = new Paciente();
            $paciente->setId(id: $resultado->id_paciente);
            $paciente->setNombre(nombre: $resultado->nombre);
            $paciente->setPrimerApellido(primerApellido: $resultado->primerApellido);
            $paciente->setSegundoApellido(segundoApellido: $resultado->segundoApellido);

            return $paciente;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Paciente $paciente): void
    {
        try {
            $this->pdo->prepare(
                query:
                "UPDATE PACIENTE SET nombre_paciente=?, primer_apellido_paciente=?, segundo_apellido_paciente=?, numero_seguro=? WHERE id_paciente=?;"
            )->execute(
                    params: [
                        $paciente->getNombre(),
                        $paciente->getPrimerApellido(),
                        $paciente->getSegundoApellido(),
                        $paciente->getSeguro(),
                        $paciente->getId()
                    ]
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(int $id): void
    {
        try {
            $this->pdo->prepare(
                query: "DELETE FROM PACIENTE WHERE id_paciente=?;"
            )->execute(
                    params: [
                        $id
                    ]
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarDiagnosticosDePaciente(int $id): bool
    {
        $query = "DELETE FROM PACIENTE WHERE id_paciente = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }
}
