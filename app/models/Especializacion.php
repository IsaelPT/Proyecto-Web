<?php

class Especializacion{

    private $pdo;

    private $id_especialidad;
    private $detalles;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getID_Especializacion(){
        return $this->id_especialidad;
    }

    public function setID_Especializacion(int $id){
        $this->id_especialidad = $id;
    }

    public function getDescripcion(){
        return $this->detalles;
    }

    public function setDescripcion(string $descripcion){
        $this->detalles = $descripcion;
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELECT * FROM ESPECIALIDAD;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function cantidad()
    {
        try {
            $q = "SELECT COUNT(id_especialidad) AS Cant_Especialidades FROM ESPECIALIDAD;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }


    public function insertar(Especializacion $obj): void
    {
        try {
            $q = "INSERT INTO ESPECIALIDAD(id_especialidad,detalles) VALUES (?,?)";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getID_Especializacion(),
                    $obj->getDescripcion()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener(int $id): Especializacion
    {
        try {
            $q = "SELECT * FROM ESPECIALIDAD WHERE id_especialidad=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute([$id]);

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $obj = new Especializacion();
            $obj->setID_Especializacion($resultado->id_especialidad);
            $obj->setDescripcion($resultado->detalles);

            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Especializacion $obj): void
    {
        try {
            $q = "UPDATE ESPECIALIDAD SET detalles=? WHERE id_especialidad=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute([
                $obj->getDescripcion(),
                $obj->getID_Especializacion()
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminar(int $id): void{
        try{
            $consulta = $this->pdo->prepare("DELETE FROM ESPECIALIDAD WHERE id_especialidad=?");
            $consulta->execute([$id]);
        }catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
