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

    public function getIdDiagnosticoPaciente(): int
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
                query: "SELECT p.id_diagnostico, p.id_paciente, p.nombre_paciente, p.primer_apellido_paciente, p.segundo_apellido_paciente, p.numero_seguro, d.descripcion FROM PACIENTE p INNER JOIN DIAGNOSTICO d ON p.id_diagnostico = d.id_diagnostico;"
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

    /**
     * Insertar en la base de datos un Paciente con su diagnóstico. El Paciente tiene una llave foránea que hace referencia a la tabla Diagnóstico, de modo que si se crea un paciente que tiene un diagnóstico, y este ya está presente la base de datos, lo que se haga es referencia a ese diagnóstico existente, no crear uno nuevo.
     * @param Paciente $paciente
     * @return void
     */
    public function insertar(Paciente $paciente): void
    {
        try {
            $check = $this->checkExistenciaDiagn($paciente);
            if ($check == null) {
                throw new Exception("ERROR: El paciente no tiene asociado un ID de diagnóstico válido.");
            }
            $this->pdo->prepare(
                query:
                "
                    INSERT INTO PACIENTE(
                        id_paciente,
                        id_diagnostico,
                        nombre_paciente,
                        primer_apellido_paciente,
                        segundo_apellido_paciente,
                        numero_seguro
                    ) VALUES (?,?,?,?,?,?)
                    "
            )->execute(
                    [
                        $paciente->getId(),
                        $paciente->getIdDiagnosticoPaciente(),
                        $paciente->getNombre(),
                        $paciente->getPrimerApellido(),
                        $paciente->getSegundoApellido(),
                        $paciente->getSeguro()
                    ]
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene la cantidad de diagnósticos específicos que tiene un paciente determinado. Si se obtiene 0, no existen diagnósticos, si es más de 1, es que este diagnóstico ya está en la base de datos. Se entiende de que habrá 1 solo Diagnóstico por Paciente, por la naturaleza de la Base de Datos. Si el paciente no tiene un ID de diagnóstico definido por la razón que sea, se devuelve null.
     * @param Paciente $paciente
     * @return int
     */
    public function checkExistenciaDiagn(Paciente $paciente): ?int
    {
        $idDiagnosticoPaciente = $paciente->getIdDiagnosticoPaciente();
        if ($idDiagnosticoPaciente) {
            $consulta = $this->pdo->prepare(
                query: "SELECT COUNT(*) AS x FROM DIAGNOSTICO WHERE id_diagnostico=?"
            );
            $consulta->execute(
                [
                    $idDiagnosticoPaciente
                ]
            );
            return (int) $consulta->fetchColumn();
        }
        return null;
    }

    public function obtener(int $id): ?Paciente
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

            if (!$resultado) {
                return null;
            }

            $paciente = new Paciente();
            $paciente->setId(id: $resultado->id_paciente);
            $paciente->setNombre(nombre: $resultado->nombre_paciente ?? "");
            $paciente->setPrimerApellido(primerApellido: $resultado->primer_apellido_paciente ?? "");
            $paciente->setSegundoApellido(segundoApellido: $resultado->segundo_apellido_paciente ?? "");
            $paciente->setSeguro(seguro: $resultado->numero_seguro ?? "");

            return $paciente;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Paciente $paciente): void
    {
        try {
            $this->pdo->prepare(
                query: "UPDATE PACIENTE SET id_diagnostico=?, nombre_paciente=?, primer_apellido_paciente=?, segundo_apellido_paciente=?, numero_seguro=? WHERE id_paciente=?;"
            )->execute(
                    params: [
                        $paciente->getIdDiagnosticoPaciente(),
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
