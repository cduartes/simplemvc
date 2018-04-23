<?php

class TareaView {

    public function render($tarea, $estados, $tipos) { ?>
        <html>
            <head>
                <title>Todo Listo! / <?php echo $_SESSION["username"];?></title>
            </head>
            <body>   
                <a href="/simplemvc/mainController.php/logout">Cerrar Sesión</a>         
                <a href="/simplemvc/mainController.php/tareas">Volver</a>
                <h1>Todo Listo!</h1>
                <h2>Descripción de tarea</h2>
                <form method="POST" action="/simplemvc/mainController.php/tarea?id="<?php echo $tarea->getId(); ?>>
                    <table>
                        <tr>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <input type="hidden" name="hidden" value="<?php echo base64_encode($tarea->getId()); ?>" />
                        <tr>
                            <td><input type="text" name="titulo" placeholder="Titulo" value="<?php echo $tarea->getTitulo(); ?>" /></td>
                            <td><input type="text" name="descripcion" placeholder="Descripcion" value="<?php echo $tarea->getDescripcion(); ?>" /></td>
                            <td>
                                <select name="estado_id">
                                <option disabled>Estado Tarea</option>
                                <?php
                                foreach($estados as $estado) {
                                    if($tarea->getEstado()->getId() == $estado->getId()){
                                        echo '<option selected="selected" value="'.$estado->getId().'">'.$estado->getNombre().'</option>';
                                    }else{
                                        echo '<option value="'.$estado->getId().'">'.$estado->getNombre().'</option>';
                                    }
                                }
                                ?>
                                </select>
                            </td>
                            <td>
                                <select name="tipo_id">
                                <option disabled>Tipo Tarea</option>
                                <?php
                                foreach($tipos as $tipo) {
                                    if($tarea->getTipo()->getId() == $tipo->getId()){
                                        echo '<option selected="selected" value="'.$tipo->getId().'">'.$tipo->getNombre().'</option>';
                                    }else{
                                        echo '<option value="'.$tipo->getId().'">'.$tipo->getNombre().'</option>';
                                    }
                                }
                                ?>
                                </select>
                            </td>
                            <td><input type="submit" value="Actualizar tarea!" /></td>
                            <td>
                                <a href="<?php echo "/simplemvc/mainController.php/borrarTarea?id=" . $tarea->getId(); ?>">
                                    Borrar
                                </a>
                            </td>
                        </tr>
                    </table>
                    </form>
            </body>
        </html>

    <?php }
}
?>