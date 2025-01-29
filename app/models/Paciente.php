<?php

class Paciente{

    private $pdo;


    private $ID_Paciente;
    private $Nombre_Paciente;
    private $Apellido_Paciente;
    private $Seguro;

    public function __CONSTRUCT(){
        $this->pdo = DataBase::connect();
    }

    public function getID_Paciente(){
        return $this->ID_Paciente;
    }
    public function setID_Paciente(int $id){
        $this->ID_Paciente = $id;
    }

    public function getNombre_Paciente(){
        return $this->Nombre_Paciente;
    }

    public function setNombre_Paciente(string $nombre){
        $this->Nombre_Paciente = $nombre;
    }

    public function getApellido_Paciente(){
        return $this->Apellido_Paciente;
    }

    public function setApellido_Paciente(string $apellido){
        $this->Apellido_Paciente = $apellido;
    }

    public function listar(){
        try{
            $consulta = $this->pdo->prepare("SELECT * FROM PACIENTE;");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function cantidad(){
        try{
            $consulta = $this->pdo->prepare("SELECT COUNT(id_paciente) AS Cant_Pacientes FROM PACIENTE");
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function insertar(Paciente $obj)
    {
        try {
            $consulta = "INSERT INTO PACIENTE(ID_Paciente,Nombre_Paciente,Apellido_Paciente) VALUES (?,?,?)";
            $this->pdo->prepare($consulta)->execute(
                [
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
            $consulta = $this->pdo->prepare("SELECT * FROM PACIENTE WHERE ID_Paciente=?;");
            $consulta->execute([$id]);

            $resultado = $consulta->fetch(PDO::FETCH_OBJ);

            $obj = new Paciente();
            $obj->setID_Paciente($resultado->ID_Paciente);
            $obj->setNombre_Paciente($resultado->Nombre_Paciente);
            $obj->setApellido_Paciente($resultado->Apellido_Paciente);

            return $obj;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizar(Paciente $obj): void
    {
        try {
            $q = "UPDATE PACIENTE SET Nombre_Paciente=?, Apellido_Paciente=? WHERE ID_Paciente=?;";
            $consulta = $this->pdo->prepare($q);
            $consulta->execute(
                [
                    $obj->getNombre_Paciente(),
                    $obj->getApellido_Paciente(),
                    $obj->getID_Paciente()
                ]
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Get the value of Seguro
     */ 
    public function getSeguro()
    {
        return $this->Seguro;
    }

    /**
     * Set the value of Seguro
     *
     * @return  self
     */ 
    public function setSeguro($Seguro)
    {
        $this->Seguro = $Seguro;

        return $this;
    }
}
