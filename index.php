<?php
require_once "app/controllers/DashboardController.php";
require_once "app/controllers/ConsultaController.php";
require_once "app/controllers/DoctorController.php";
require_once "app/controllers/PacienteController.php";
require_once "app/controllers/EspecialidadController.php";
require_once "app/controllers/AuthController.php";
require_once "app/models/DataBase.php";

//Verificar si un usuario esta autenticado
session_start();
$autenticado = isset($_SESSION['user']);

//Si no esta autenticado y no esta intentando acceder al login, redirigir al login
if(!$autenticado && ($_GET['controller'] !== 'Auth')){
    header('Location: ?controller=Auth&&action=principal');
    exit();
}

// Si es una solicitud GET, obtener el controlador y la acción de $_GET
$controller = isset($_GET['controller']) ? $_GET['controller'] : "Dashboard"; // Controlador predeterminado
$action = isset($_GET['action']) ? $_GET['action'] : 'principal'; // Acción predeterminada


$controllerPath = ucfirst($controller) . "Controller";
// $a = new $controllerPath;
// call_user_func(array($a,$action));

if (class_exists($controllerPath)) {
    $instanceController = new $controllerPath;
    if (method_exists($controllerPath, $action)) {
        $instanceController->$action();
    } else {
        echo "La acción $action no existe en el controlador $controller.";
    }
} else {
    echo "El controlador $controller no existe.";
}