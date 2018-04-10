# Taller: Todo Listo! y MVC a mano

En este taller se agregarán funcionalidades a la aplicación Todo Listo! dada una implementación base hecha en PHP. 

El código inicial está estructurado según el diseño sugerido por el patrón de diseño MVC. El código inicial debe ser descargado desde el Aula Virtual.

Respecto a los controladores:

  * Se tiene el controlador principal `mainController.php` que traduce las URLs en rutas internas de la aplicación
  * Se tiene el controlador `LoginController.php` que se encarga de hacer login y logout
  * Se tiene el controlador `TareaController.php` que se encarga de mostrar el listado de tareas asociadas a un usuario, y de recibir los parámetros de creación de una nueva tarea

Respecto a los modelos se provee una base de datos `TODOLISTO.sql`, lista para ser importada en MySQL,  para soportar los modelos de la aplicación, en base a esto:

  * Se tienen las clases `Usuario`, `Tarea`, `Rol`, y `EstadoTarea`  
  * El `mainController.php` se conecta a la base de datos, y almacena el _handle_ en una propiedad estática de la clase `Config`
  * Las clases mencionadas hacen uso de la conexión a la base de datos para buscar y crear según corresponda. Estudie bien la implementación de `Usuario` y `Tarea` para ayudarse en los puntos a desarrollar.

Respecto a las vistas:

  * Se proveen dos vistas: `Login.view.php` y `Tareas.view.php`.
  * Para efectos de programación, todas las vistas deben ser definidas de manera similar a las ya existentes. Es decir, una vista es una clase que tiene el método `render`, aunque cada clase puede recibir una cantidad distinta de parámetros en este método.

Respecto a los datos iniciales en la base de datos:

  * Hay 2 usuarios ya creados: `Juanin`, que es un usuario normal, y `admin` que, sorprendentemente, es un administrador.
  * Hay estados  de tarea ya definidos. Estos valores pueden cambiar, en general al agregar nuevos valores de manera externa a la aplicación.
  * Hay roles de usuario ya definidos, y no se deben considerar roles adicionales.

## Sobre la entrega

La entrega se divide en una entrega parcial y una entrega final. Las fechas son las siguientes:

  * _Entrega parcial_: Miércoles 11 de Abril de 2018, hasta las 23:55hrs. Consiste en los puntos 1, 2 y 3 de la especificación.
  * _Entrega final_: Martes 24 de Abril de 2018, hasta las 08:00hrs

Las entregas se deben realizar mediante Aula Virtual. Cada entrega debe consistir en una carpeta comprimida con todos los archivos necesarios para la 
correcta ejecución y revisión del taller. *** Además es obligatorio incluir un archivo README.md con todas las instrucciones de instalación, ejecución, u otras que sean necesarias. ***

## Sobre la evaluación

La nota del taller consiste en 30% la entrega parcial ya 70% la entrega final.

## Especificaciones

Todas las modificaciones al sistema deben hacerse respetando el diseño MVC. Si es necesario crear o modificar vistas, modelos, o controladores para conformarse a este patrón entonces deberá hacerlo.

*** Si su aplicación _"funciona"_ pero no sigue el diseño requerido, tendra una penalización en su nota. ***

1. (0.5 puntos) Modifique la aplicación para que se puedan eliminar tareas desde el listado de tareas del usuario, en base a la URL `/todolisto_mvc/borrarTarea?id=X`

2. (0.5 punto) Modifique la aplicación para que se pueda ver el detalle de una tarea seleccionada en el listado, en base a la URL `/todolisto_mvc/tarea?id=X`

3. (1 punto) Modifique la aplicación para que dentro del detalle de la tarea se puedan actualizar sus atributos---excepto el `id`. 

4. (1 punto) Agregue el modelo `TipoTarea` como un nuevo atributo de las tareas. La base de datos provista ya tiene la tabla, pero sin datos iniciales. Actualice la creación y modificación de tareas para manejar este nuevo atributo.

4. (1 puntos) Implemente la vista tipo calendario, similar al mockup que se muestra en las diapositivas vistas en clases.

5. (2 puntos) Implemente una vista para usuarios administradores, donde puedan ver la cantidad de tareas asociadas a cada usuario normal. Pruebe agregando un nuevo usuario normal y luego agregando tareas para ver si lo que ve el administrador está correcto.