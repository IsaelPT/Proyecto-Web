<?php

require_once "app/models/Usuario.php";

class UsuarioController{
    private $usuario;

    public function __construct(){
        $this->usuario = new Usuario();
    }

    public function principal(){
        include "app/views/src/pages/listado_usuarios.php";
    }

    public function form_usuarios(){
        $user = new Usuario();

        if(isset($_GET['id'])){
            $user = $this->usuario->obtener($_GET['id']);
        }

        include "app/views/src/pages/usuarios.php";
    }

    public function guardar(){
        $user = new Usuario();
        $user->setUsername($_POST['nombre_usuario']);
        $user->setId_usuario($_POST['id_usuario']);
        $user->setRol($_POST['rol_usuario']);

        $user->getId_usuario() > 0 ? 
            $this->usuario->actualizar($user):
            $this->usuario->insertar($user);

        header("Location: ?controller=Usuario");
    }

    public function eliminar(){
        $this->usuario->eliminar($_GET['id']);
        header("Location: ?controller=Usuario");
    }
}