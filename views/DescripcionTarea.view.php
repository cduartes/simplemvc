<?php

class TareaView {

    public function render($tarea, $estados) { ?>
        <html>
            <head>
                <title>Todo Listo! / <?php echo $_SESSION["username"];?></title>
            </head>
            <body>   
                <a href="/simplemvc/mainController.php/logout">Cerrar Sesión</a>         
                <a href="/simplemvc/mainController.php/tareas">Volver</a>
                <h1>Todo Listo!</h1>
                <h2>Descripción de tarea</h2>
                    <table>
                        <tr>
                            <th>Titulo</th>
                            <th>Descripcion</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <a>
                                    <?php echo $tarea->getTitulo(); ?>
                                </a>
                            </td>
                            <td><?php echo $tarea->getDescripcion(); ?></td>
                            <td>
                                <a href="<?php echo "/simplemvc/mainController.php/borrarTarea?id=" . $tarea->getId(); ?>">
                                    Borrar
                                </a>
                            </td>
                        </tr>
                    </table>
            </body>
        </html>

    <?php }
}
?>