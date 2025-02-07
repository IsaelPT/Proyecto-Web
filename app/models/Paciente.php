<?php

class Paciente
{
    private $pdo;
    private $id_paciente;
    private $id_diagnostico;
    private $nombre_paciente;
    private $primer_apellido_paciente;
    private $segundo_apellido_paciente;
    private $numero_seguro;

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
        return $this->nombre_paciente ?? "";
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre_paciente = $nombre;
    }

    public function getPrimerApellido(): string
    {
        return $this->primer_apellido_paciente ?? "";
    }

    public function setPrimerApellido(string $primerApellido): void
    {
        $this->primer_apellido_paciente = $primerApellido;
    }

    public function getSegundoApellido(): string
    {
        return $this->segundo_apellido_paciente ?? "";
    }

    public function setSegundoApellido($segundoApellido): void
    {
        $this->segundo_apellido_paciente = $segundoApellido;
    }

    public function getSeguro(): int
    {
        return $this->numero_seguro ?? 0;
    }

    public function setSeguro($seguro): void
    {
        $this->numero_seguro = $seguro;
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
            $consulta = $this->pdo->prepare("INSERT 
                                                    INTO PACIENTE(id_paciente,id_diagnostico,nombre_paciente,primer_apellido_paciente,segundo_apellido_paciente,numero_seguro)
                                                    VALUES(?,?,?,?,?,?);");
            $consulta->execute([$paciente->getId(),
                                        $paciente->getIdDiagnosticoPaciente(),
                                        $paciente->getNombre(),
                                        $paciente->getPrimerApellido(),
                                        $paciente->getSegundoApellido(),
                                        $paciente->getSeguro()]);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Obtiene la cantidad de diagnósticos específicos que tiene un paciente determinado. Si se obtiene 0, no existen diagnósticos, si es más de 1, es que este diagnóstico ya está en la base de datos. Se entiende de que habrá 1 solo Diagnóstico por Paciente, por la naturaleza de la Base de Datos. Si el paciente no tiene un ID de diagnóstico definido por la razón que sea, se devuelve null.
     * @param Paciente $paciente
     * @return int
     */

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
            $consulta = $this->pdo->prepare("DELETE FROM PACIENTE WHERE id_paciente=?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
}
