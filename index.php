<?php
require_once "app/controllers/AuthController.php";
require_once "app/models/DataBase.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si hay una solicitud POST, obtener el controlador y la acción de $_POST
    $controller = isset($_POST['controller']) ? $_POST['controller'] : "Auth"; // Controlador predeterminado
    $action = isset($_POST['action']) ? $_POST['action'] : 'login'; // Acción predeterminada
} else {
    // Si es una solicitud GET, obtener el controlador y la acción de $_GET
    $controller = isset($_GET['controller']) ? $_GET['controller'] : "Auth"; // Controlador predeterminado
    $action = isset($_GET['action']) ? $_GET['action'] : 'login'; // Acción predeterminada
}

$controllerPath = ucfirst($controller). "Controller";
// $a = new $controllerPath;
// call_user_func(array($a,$action));

if(class_exists($controllerPath)){
    $instanceController = new $controllerPath;
    if(method_exists($controllerPath,$action)){
        $instanceController->$action();
    }else{
        echo "La acción $action no existe en el controlador $controller";
    }
}else{
    echo "El controlador $controller no existe";
}