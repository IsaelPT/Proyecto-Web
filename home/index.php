<?php
require_once '../config/bootstrap.php'; // Carga la configuración de la aplicación

// Determinar el controlador y la acción usando POST o GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si hay una solicitud POST, obtener el controlador y la acción de $_POST
    $controller = isset($_POST['controller']) ? $_POST['controller'] : 'Auth'; // Controlador predeterminado
    $action = isset($_POST['action']) ? $_POST['action'] : 'login'; // Acción predeterminada
} else {
    // Si es una solicitud GET, obtener el controlador y la acción de $_GET
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'Auth'; // Controlador predeterminado
    $action = isset($_GET['action']) ? $_GET['action'] : 'login'; // Acción predeterminada
}

// Convertir el nombre del controlador en una clase
$controllerClass = 'App\\Controllers\\' . ucfirst($controller) . 'Controller';

if (class_exists($controllerClass)) {
    $controllerInstance = new $controllerClass($entityManager);
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action(); // Llama a la acción del controlador
    } else {
        echo "Acción '$action' no encontrada en el controlador '$controllerClass'.";
    }
} else {
    echo "Controlador '$controllerClass' no encontrado.";
}
?>