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

    public function form_login(){

        include "app/views/src/pages/form_login.php";

    }

    public function auntenticar_user(){

        $user = $_POST['usuario'];
        $pas = $_POST['pass'];
        $eror = "";

        $existe = $this->usuario->verificar($user, $pas)->CantidadUser;

        if($existe == 1){

            session_start();

            $_SESSION['user'] = $user;
            $_SESSION['rol'] = $this->usuario->getRol();

            header( 'Location: ?controller=Dashboard');
        } else {
            $error = "Credenciales incorrectas";
        }
    }

    public function isertar_usuario(){

        $user = new Usuario();
        $user->setUsername($_POST['usuario']);
        $user->setPassword($_POST['pass']);
        $user->setRol("user");
        $error = "";

        $existe = $this->usuario->existe($user->getUsername())->CantidadUser;

        if($existe == 1){

            $this->usuario->insertar($user);

            session_start();
            $_SESSION['user'] = $user->getUsername();
            $_SESSION['rol'] = $user->getRol();

            header('Location: ?controller=Dashboard');
        }else{
            $error = "Ya existe usuario con ese nombre";
            header('Lacation: ?controller=Auth&&action=form_login');
        }
    }
}