<?php

require("models/Tarea.php");
require("views/Tareas.view.php");
require("views/DescripcionTarea.view.php");

class TareaController {

    public function listadoTareas() {
        $user = $_SESSION["user"];
        $tareas = Tarea::getAllUserTareas($user);        
        $estados = EstadoTarea::getAll();
        $tipos   = TipoTarea::getAll();

        $tareasViews = new TareasView();
        echo $tareasViews->render($tareas, $estados, $tipos);
    }
    
    public function agregarTarea($titulo, $desc, $tipo_id, $estado_id) {
        $user = $_SESSION["user"];
        Tarea::agregarTarea($titulo, $desc, $tipo_id, $user->getId(), $estado_id);        
        header('Location: ' . '/simplemvc/mainController.php/tareas');
    }
    public function actualizarTarea($tarea_id, $titulo, $desc, $tipo_id, $estado_id){
        $user = $_SESSION['user'];
        if($user->getRol() == 2){
            Tarea::actualizarTareaUsuario($tarea_id, $titulo, $desc, $tipo_id, $estado_id, $user->getId());
        }else if($user->getRol() == 1){
            Tarea::actualizarTareaAdmin($tarea_id, $titulo, $desc, $tipo_id, $estado_id);
        }
        header('Location: ' . '/simplemvc/mainController.php/tarea?id='.$tarea_id);
    }

    public function eliminarTarea($tarea_id){
        $user = $_SESSION['user'];
        if($user->getRol() == 2){
            Tarea::eliminarTareaUsuario($tarea_id,$user->getId());
        }else if($user->getRol() == 1){
            Tarea::eliminarTareaAdmin($tarea_id);
        }
        header('Location: ' . '/simplemvc/mainController.php/tareas');
    }

    public function visualizarTarea($tarea_id){
        $user = $_SESSION["user"];
        if($user->getRol() == 2){
            $tarea = Tarea::mostrarTareaUsuario($tarea_id,$user->getId());
        }else if($user->getRol() == 1){
            $tarea = Tarea::mostrarTareaAdmin($tarea_id);
        }
        $estados = EstadoTarea::getAll();
        $tipos   = TipoTarea::getAll();
        $tareaView = new TareaView();
        echo $tareaView->render($tarea, $estados, $tipos);
    }
}
?>