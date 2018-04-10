<?php

class LoginView {

    public function render() { ?>
        <html>
            <head>            
                <title>Todo Listo!</title>
            </head>
            <body>
            <a href="/simplemvc/mainController.php/logout">Cerrar Sesión</a>
            <?php echo $_SESSION["username"] ?? "Usuario no registrado"; ?>
                <h1>Todo Listo!</h1>
                <form method="POST" action="/simplemvc/mainController.php/login">
                    <input type="text" name="user" placeholder="Usuario" />
                    <input type="text" name="password" placeholder="Contraseña" />
                    <input type="submit" value="Ingresar!" />
                </form>
            </body>
        </html>
    <?php }
}
?>