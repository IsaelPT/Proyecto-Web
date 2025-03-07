<?php

require_once "app/models/Usuario.php";

class AuthController{

    private $usuario;

    public function __construct(){
        $this->usuario = new Usuario();
    }
    public function principal(){
        
        include "app/views/src/pages/login.php";

    }

    public function auntenticar_user(){
        
        $user = $_POST['usuario'];
        $pass = $_POST['pass'];
        session_start();
        $_SESSION['error'] = "";

        $usuario_bd = $this->usuario->verificar($user, $pass);
        
        if($usuario_bd){

            $_SESSION['user'] = $user;
            $_SESSION['rol'] = $usuario_bd->rol;

            header('Location: ?controller=Dashboard');
        } else {
            $_SESSION['error'] = $pass;
            header('Location: ?controller=Auth&&action=principal');
        }
    }

    public function isertar_usuario(){

        $user = new Usuario();
        $user->setUsername($_POST['usuario']);
        $user->setPassword($_POST['pass']);
        $user->setRol("user");
        session_start();
        $_SESSION['error'] = "";

        $existe = $this->usuario->existe($user->getUsername());

        if($existe->CantidadUser == 0){

            $this->usuario->insertar($user);

            $_SESSION['user'] = $user->getUsername();
            $_SESSION['rol'] = $user->getRol();

            header('Location: ?controller=Dashboard');
        }else{
            
            $_SESSION['error'] = "Ya existe usuario con ese nombre";
            header('Location: ?controller=Auth');
        }
    }

    
    public function cerrar_sesion(){
        session_destroy();

        header("Location: controller=Auth&&action=principal");
    }
}