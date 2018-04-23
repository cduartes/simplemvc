<?php

require("Config.php");

/***********************************************/
// Conexion base de datos SQLite3
// Se almacena como "singleton" en el
// atributo estático Config::$dbh

$dir = 'mysql:host=localhost;dbname=simplemvc';
$usuario = "root";
$password = "";
Config::$dbh = new PDO($dir, $usuario, $password) or die ("Error en conexion a la base de datos");


/***********************************************************************/
// Magia negra para obtener el path específico para la aplicación
// Por ejemplo para la URL "http://localhost/todolisto_mvc/mainController.php/tareas"
// Se procesa y se obtiene el path "/tareas" el cual se usa en el ruteo

$baseURL = dirname($_SERVER["REQUEST_URI"]);
$url = $_SERVER["REQUEST_URI"];
$origPath = substr($url, strlen($baseURL));
//echo "<script>console.log( 'url: " . $url . "' );";
//echo "console.log( 'origPath: " . $origPath . "' );</script>";
$pathArray = explode("?",$origPath);
$path = $pathArray[0];
//echo "<script>console.log( 'path: " . $path . "' );</script>";



/****************************************************/
// Funciones auxiliares para restringir acceso
// a usuarios logeados, y a usuarios administradores

function require_login() {
    return isset($_SESSION["username"]) or die("Requiere usuario autentificado");
}

function require_admin_login() {
    /* POR IMPLEMENTAR */
}


/*******************************************************/
// Mapeo de URL a acciones específicas de controladores
// Esto se conoce como "routing" o ruteo

require("controllers/LoginController.php");
require("controllers/TareaController.php");

session_start();
$controller = null;

switch($path) {

    case '/index':
        $controller = new LoginController();
        $controller->loginScreen();
        break;

    case '/login':
        $user     = $_POST["user"];
        $password = $_POST["password"];
        $controller = new LoginController();
        $controller->login($user, $password);
        break;

    case '/logout':
        require_login();
        $controller = new LoginController();
        $controller->logout();
        break;  
    
    case '/tareas':
        require_login();
        $controller = new TareaController();
        $controller->listadoTareas();
        break;
    
    case '/nuevaTarea':
        require_login();
        $controller = new TareaController();        
        $titulo    = $_POST["titulo"];
        $desc      = $_POST["descripcion"];
        $estado_id = $_POST["estado_id"];
        $tipo_id   = $_POST["tipo_id"];
        $controller->agregarTarea($titulo, $desc, $tipo_id, $estado_id);
        break;

    case '/borrarTarea':
        require_login();
        $controller = new TareaController();
        $id_tarea = $_GET["id"];
        $controller->eliminarTarea($id_tarea);
        break;

    case '/tarea':
        require_login();
        $controller = new TareaController();
        $id_tarea = $_GET["id"];
        if(isset($_POST['hidden'])){
            $titulo    = $_POST["titulo"];
            $desc      = $_POST["descripcion"];
            $estado_id = $_POST["estado_id"];
            $tipo_id = $_POST["tipo_id"];
            $fecha_inicio = null;
            $id_tarea = base64_decode($_POST["hidden"]); //tenía pensado otra cosa, pero no me funciono! :(
            $controller->actualizarTarea($id_tarea, $titulo, $desc, $tipo_id, $estado_id);
        }
        $controller->visualizarTarea($id_tarea);
        break;
    
    /*
    case '/tarea':        
        break;
    */

    /*
    case 'calendario':        
        break;
    */  

    default:
        header('HTTP/1.1 404 Not Found');        
}

?>


