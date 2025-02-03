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

    public function getId(): ?int
    {
        return $this->id_paciente;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getPrimerApellido(): ?string
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido(string $primerApellido): void
    {
        $this->primerApellido = $primerApellido;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido($segundoApellido): void
    {
        $this->segundoApellido = $segundoApellido;
    }

    public function getSeguro(): ?int
    {
        return $this->seguro;
    }

    public function setSeguro($seguro): void
    {
        $this->seguro = $seguro;
    }

    public function getDiagnosticoPaciente(): string
    {
        try {
            $consulta = $this->pdo->prepare(
                "SELECT d.descripcion FROM DIAGNOSTICO d INNER JOIN PACIENTE p ON d.id_diagnostico = p.id_diagnostico WHERE p.id_paciente=?;"
            );
            $id = $this->getId();
            $consulta->execute([$id]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            if ($resultado && $resultado->descripcion) {
                return $resultado->descripcion;
            } else {
                return "";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
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
            $consulta = $this->pdo->prepare("SELECT COUNT(*) FROM DIAGNOSTICO WHERE id_diagnostico = ?");
            $consulta->execute([$paciente->getIdDiagnostico()]);
            $exists = $consulta->fetchColumn();

            if (!$exists) {
                $this->pdo->prepare("INSERT INTO DIAGNOSTICO(id_diagnostico, descripcion) VALUES (?, 'Descripción no disponible');")
                    ->execute([$paciente->getIdDiagnostico()]);
            }

            $this->pdo->prepare(
                "INSERT INTO PACIENTE(id_paciente,nombre_paciente,primer_apellido_paciente, segundo_apellido_paciente, numero_seguro, id_diagnostico) VALUES (?,?,?,?,?,?);"
            )->execute([
                        $paciente->getId(),
                        $paciente->getNombre(),
                        $paciente->getPrimerApellido(),
                        $paciente->getSegundoApellido(),
                        $paciente->getSeguro(),
                        $paciente->getIdDiagnostico()
                    ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Paciente
    {
        try {
            $query = "SELECT id_paciente, nombre_paciente, primer_apellido_paciente, segundo_apellido_paciente, numero_seguro FROM PACIENTE WHERE id_paciente=?;";
            $consulta = $this->pdo->prepare($query);
            $consulta->execute([$id]);

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $paciente = new Paciente();
            $paciente->setId($resultado->id_paciente);
            $paciente->setNombre($resultado->nombre_paciente);
            $paciente->setPrimerApellido($resultado->primer_apellido_paciente);
            $paciente->setSegundoApellido($resultado->segundo_apellido_paciente);
            $paciente->setSeguro($resultado->numero_seguro);

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
                "DELETE FROM consulta WHERE id_paciente=?;"
            )->execute([$id]);

            $consulta = $this->pdo->prepare(
                "SELECT id_diagnostico FROM PACIENTE WHERE id_paciente=?;"
            );
            $consulta->execute([$id]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            $id_diagnostico = $resultado->id_diagnostico;

            $this->pdo->prepare(
                "DELETE FROM PACIENTE WHERE id_paciente=?;"
            )->execute([$id]);

            $this->pdo->prepare(
                "DELETE FROM DIAGNOSTICO WHERE id_diagnostico=?;"
            )->execute([$id_diagnostico]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarDiagnosticosDePaciente(int $id): bool
    {
        try {
            // Delete from consulta table
            $this->pdo->prepare(
                "DELETE FROM consulta WHERE id_paciente=?;"
            )->execute([$id]);

            // Get the diagnostic ID associated with the patient
            $consulta = $this->pdo->prepare(
                "SELECT id_diagnostico FROM PACIENTE WHERE id_paciente=?;"
            );
            $consulta->execute([$id]);
            $resultado = $consulta->fetch(PDO::FETCH_OBJ);
            $id_diagnostico = $resultado->id_diagnostico;

            // Delete from PACIENTE table
            $this->pdo->prepare(
                "DELETE FROM PACIENTE WHERE id_paciente=?;"
            )->execute([$id]);

            // Delete from DIAGNOSTICO table
            $stmt = $this->pdo->prepare(
                "DELETE FROM DIAGNOSTICO WHERE id_diagnostico=?;"
            );
            return $stmt->execute([$id_diagnostico]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
