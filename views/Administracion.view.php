<?php

class AdministracionView {

    public function render($usuarios, $tareas) { ?>
        <html>
            <head>
                <title>Todo Listo! / <?php echo $_SESSION["username"];?></title>
                
            </head>
            <body>   
                <a href="/simplemvc/mainController.php/logout">Cerrar Sesión</a>
                <h1>Todo Listo!</h1>
                <h2>Tareas por usuario</h2>

                    <table border=1>
                        <tr>
                            <th>Id</th>
                            <th>Nombre de usuario</th>
                            <th>Tareas</th>
                        </tr>
                        <?php foreach($usuarios as $usuario) {?>
                        <tr>
                            <td>
                                <?php echo $usuario->getId(); ?>
                            </td>
                            <td><?php echo $usuario->getNombre(); ?></td>
                            <td>
                                <?php echo $tareas[$usuario->getId()]; ?></td>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>

            </body>
        </html>

    <?php }
}
?>