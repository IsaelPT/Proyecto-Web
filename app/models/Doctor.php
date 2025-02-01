<?php

class Doctor
{

    private $pdo;

    private $id_doctor;
    private $id_especilidad;
    private $nombre_doctor;
    private $primer_apellido_doctor;
    private $segundo_apellido_doctor;

    public function __CONSTRUCT()
    {
        $this->pdo = DataBase::connect();
    }

    public function getSegApellido_Doctor()
    {
        return $this->segundo_apellido_doctor;
    }

    public function setSegApellido_Doctor($SegApellido_Doctor)
    {
        $this->segundo_apellido_doctor = $SegApellido_Doctor;
    }

    public function getId_especilidad()
    {
        return $this->id_especilidad;
    }

    public function setId_especilidad($id_especilidad)
    {
        $this->id_especilidad = $id_especilidad;

        return $this;
    }

    public function getID_Doctor()
    {
        return $this->id_doctor;
    }

    public function setID_Doctor(int $id)
    {
        $this->id_doctor = $id;
    }

    public function getNombre_Doctor()
    {
        return $this->nombre_doctor;
    }

    public function setNombre_Doctor(string $nombre)
    {
        $this->nombre_doctor = $nombre;
    }

    public function getApellido_Doctor()
    {
        return $this->primer_apellido_doctor;
    }

    public function setApellido_Doctor(string $apellido)
    {
        $this->primer_apellido_doctor = $apellido;
    }

    public function listar()
    {
        try {
            $consulta = $this->pdo->prepare("SELECT d.id_doctor, nombre_doctor, primer_apellido_doctor, segundo_apellido_doctor, detalles
                                            FROM DOCTOR d INNER JOIN ESPECIALIDAD e ON d.id_especialidad = e.id_especialidad;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function cantidad()
    {
        try {
            $q = "SELECT COUNT(id_doctor) AS Cant_Doctores FROM DOCTOR;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar(Doctor $obj)
    {
        try {
            $consulta = "INSERT INTO DOCTOR(id_doctor,id_especialidad,nombre_doctor,primer_apellido_doctor,segundo_apellido_doctor) VALUES (?,?,?,?,?)";
            $this->pdo->prepare($consulta)->execute(
                [
                    $obj->getID_Doctor(),
                    $obj->getId_especilidad(),
                    $obj->getNombre_Doctor(),
                    $obj->getApellido_Doctor(),
                    $obj->getSegApellido_Doctor()
                ]
            );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Doctor
    {
        try {
            $q = "SELECT * FROM DOCTOR WHERE id_doctor=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute([$id]);

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $obj = new Doctor();
            $obj->setID_Doctor($resultado->id_doctor);
            $obj->setId_especilidad($resultado->id_especialidad);
            $obj->setNombre_Doctor($resultado->nombre_doctor);
            $obj->setApellido_Doctor($resultado->primer_apellido_doctor);
            $obj->setSegApellido_Doctor($resultado->segundo_apellido_doctor);

            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Doctor $obj): void
    {
        try {
            $q = "UPDATE DOCTOR SET id_especialidad=?, nombre_doctor=?, primer_apellido_doctor=?, segundo_apellido_doctor=? WHERE id_doctor=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getId_especilidad(),
                    $obj->getNombre_Doctor(),
                    $obj->getApellido_Doctor(),
                    $obj->getSegApellido_Doctor(),
                    $obj->getID_Doctor()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(int $id): void
    {
        try {
            $consulta = $this->pdo->prepare("DELETE FROM DOCTOR WHERE id_doctor=?");
            $consulta->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarConsultasDeDoctor(int $id_doctor): bool
    {
        $query = "DELETE FROM consulta WHERE id_doctor = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id_doctor]);
    }
}
