<?php 

require("EstadoTarea.php");

class Tarea {
    private $id;
    private $titulo;
    private $descripcion;    
    private $estado;
    private $usuario;

    private static function fromRowToTarea($row) {
        return new Tarea($row);
    }

    public static function getAllUserTareas($user) {
        $query = "SELECT * FROM tarea WHERE usuario_id = ?";
        $ps    = Config::$dbh->prepare($query);
        $user_id = $user->getId();
        $res   = $ps->execute(array(1));
        $result = array();
        if($res) {
            $result = $ps->fetchAll();
            $result = array_map([Tarea::class, 'fromRowToTarea'], $result);
        }

        return $result;        
    }

    public static function agregarTarea($titulo, $descripcion, $user_id, $estado_id) {
        $query = "INSERT INTO tarea (titulo, descripcion, usuario_id, tipo_id, estado_id, fecha_inicio) VALUES (?, ?, ?, ?, ?, ?)";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array(
                        $titulo,
                        $descripcion,
                        $user_id,
                        null,                        
                        $estado_id,
                        "2018-03-03"
        ));
      
    }

    function __construct($result_row) {
        $this->id          = $result_row["tarea_id"];
        $this->titulo      = $result_row["titulo"];
        $this->descripcion = $result_row["descripcion"];        
        $this->estado      = $result_row["estado_id"];
        $this->usuario     = $result_row["usuario_id"];        
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = descripcion;
    }
    
    public function getEstado() {
        return EstadoTarea::getById($this->estado);
    }
}

?>