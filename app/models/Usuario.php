<?php

require_once "app/models/DataBase.php";

class Usuario{

    private $pdo;
    private $id_usuario;
    private $username;
    private $password;
    private $rol;

    public function __construct(){
        $this->pdo = DataBase::connect();
    }

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    public function verificar($username, $pass){
        try{

            $consulta = $this->pdo->prepare("SELECT password, rol 
                                                    FROM USUARIO u
                                                    WHERE u.username=?;");
            $consulta->execute([$username]);

            $usuario = $consulta->fetch(PDO::FETCH_OBJ);

            if($usuario && password_verify($pass, $usuario->password)){
                return $usuario;
            }else{
                return false;
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function existe($username){

        try{
            $consulta = $this->pdo->prepare("SELECT COUNT(u.id_usuario) as CantidadUser 
                                                    FROM USUARIO u
                                                    WHERE u.username=?;");
            $consulta->execute([$username]);
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insertar($user){

        try{
            $consulta = $this->pdo->prepare("INSERT INTO USUARIO(username, password, rol)
                                            VALUES(?,?,?);");
            $consulta->execute([$user->getUsername(),
                password_hash($user->getPassword(), PASSWORD_DEFAULT),
                                        $user->getRol()]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}