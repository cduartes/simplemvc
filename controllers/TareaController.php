<?php

require("models/Tarea.php");
require("views/Tareas.view.php");

class TareaController {

    public function listadoTareas() {
        $user = $_SESSION["user"];        
        $tareas = Tarea::getAllUserTareas($user);        
        $estados = EstadoTarea::getAll();

        $tareasViews = new TareasView();
        echo $tareasViews->render($tareas, $estados);
    }
    
    public function agregarTarea($titulo, $desc, $estado_id) {
        $user = $_SESSION["user"];
        Tarea::agregarTarea($titulo, $desc, $user->getId(), $estado_id);        
        header('Location: ' . '/simplemvc/mainController.php/tareas');
    }

    public function eliminarTarea($tarea_id){
        $user = $_SESSION['user'];
        echo "<script>console.log( 'rol: " . $user->getRol() . "' );</script>";
        if($user->getRol() == 2){
            Tarea::eliminarTareaUsuario($tarea_id,$user->getId());
        }else if($user->getRol() == 1){
            Tarea::eliminarTareaAdmin($tarea_id);
        }
        header('Location: ' . '/simplemvc/mainController.php/tareas');
    }
}
?>