<?php

class CalendarioView {
    public function render($tareas) { ?>
    <html>
            <head>
                <title>Calendario / <?php echo $_SESSION["username"];?></title>
                <meta charset='utf-8' />
                <link href='/simplemvc/views/resources/fullcalendar.min.css' rel='stylesheet' />
                <link href='/simplemvc/views/resources/fullcalendar.print.min.css' rel='stylesheet' media='print' />
                <script src='/simplemvc/views/resources/lib/moment.min.js'></script>
                <script src='/simplemvc/views/resources/lib/jquery.min.js'></script>
                <script src='/simplemvc/views/resources/fullcalendar.js'></script>
                <script src='/simplemvc/views/resources/locale-all.js'></script>
                <script>
                    $(document).ready(function() {
                        $('#calendar').fullCalendar({
                        locale: "es",
                        editable: false,
                        weekNumbers: false,
                        eventLimit: true, // allow "more" link when too many events
                        events: [
                            <?php foreach($tareas as $tarea) { ?>
                                {
                                    title: '<?php echo $tarea->getTitulo(); ?>',
                                    start: '<?php echo $tarea->getFecha(); ?>',
                                    url: 'tarea?id='+<?php echo $tarea->getId(); ?>
                                },
                            <?php } ?>
                        ]
                        });

                    });

                </script>
                <style>
                    body {
                        margin: 40px 10px;
                        padding: 0;
                        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
                        font-size: 14px;
                    }

                    #calendar {
                        max-width: 900px;
                        margin: 0 auto;
                    }
                </style>
            </head>
            <body>   
                <a href="/simplemvc/mainController.php/logout">Cerrar Sesión</a>         
                <a href="/simplemvc/mainController.php/tareas">Volver</a>
                <h1>Calendario</h1>
                <div id='calendar'></div>
            </body>
        </html>

    <?php }
}
?>