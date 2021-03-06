<?php 

require("EstadoTarea.php");
require("TipoTarea.php");

class Tarea {
    private $id;
    private $titulo;
    private $descripcion;    
    private $fecha_inicio;
    private $estado;
    private $tipo;
    private $usuario;

    private static function fromRowToTarea($row) {
        return new Tarea($row);
    }

    public static function getAllUserTareas($user) {
        $query = "SELECT * FROM tarea WHERE usuario_id = ?";
        $ps    = Config::$dbh->prepare($query);
        $user_id = $user->getId();
        $res   = $ps->execute(array($user_id));
        $result = array();
        if($res) {
            $result = $ps->fetchAll();
            $result = array_map([Tarea::class, 'fromRowToTarea'], $result);
        }

        return $result;        
    }

    public static function getAllTareas() {
        $query = "SELECT * FROM tarea";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute();
        $result = array();
        if($res) {
            $result = $ps->fetchAll();
            $result = array_map([Tarea::class, 'fromRowToTarea'], $result);
        }

        return $result;    
    }

    public static function agregarTarea($titulo, $descripcion, $fecha_inicio, $tipo_id , $user_id, $estado_id) {
        $query = "INSERT INTO tarea (titulo, descripcion, usuario_id, tipo_id, estado_id, fecha_inicio) VALUES (?, ?, ?, ?, ?, ?)";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array(
                        $titulo,
                        $descripcion,
                        $user_id,
                        $tipo_id,                        
                        $estado_id,
                        $fecha_inicio,
        ));
      
    }

    public static function actualizarTareaUsuario($tarea_id, $titulo, $descripcion, $fecha_inicio, $tipo_id, $estado_id, $user_id){
        echo "<script>console.log( 'estado: ". $estado_id." +  user_id". $user_id ." ' );</script>";
        $query = "UPDATE tarea SET titulo = ?, descripcion = ?, estado_id = ?, tipo_id = ?, fecha_inicio = ? WHERE tarea_id = ? AND usuario_id = ?";
        echo "<script>console.log( 'actualizarq2' );</script>";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array(
                        $titulo,
                        $descripcion,
                        $estado_id,
                        $tipo_id,
                        $fecha_inicio,
                        $tarea_id,
                        $user_id
        ));
        //echo "<script>console.log( 'res " . $res ."' );</script>";
    }

    public static function actualizarTareaAdmin($tarea_id, $titulo, $descripcion, $fecha_inicio, $tipo_id, $estado_id){
        //echo "<script>console.log( 'estado: ". $estado_id." ' );</script>";
        $query = "UPDATE tarea SET titulo = ?, descripcion = ?, estado_id = ?, tipo_id = ?, fecha_inicio = ? WHERE tarea_id = ?";
       // echo "<script>console.log( 'actualizarq2' );</script>";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array(
                        $titulo,
                        $descripcion,
                        $estado_id,
                        $tipo_id,
                        $fecha_inicio,
                        $tarea_id
        ));
        echo "<script>console.log( 'res " . $res ."' );</script>";
    }

    function __construct($result_row) {
        $this->id           = $result_row["tarea_id"];
        $this->titulo       = $result_row["titulo"];
        $this->descripcion  = $result_row["descripcion"];        
        $this->fecha_inicio = $result_row["fecha_inicio"];
        $this->estado       = $result_row["estado_id"];
        $this->tipo         = $result_row["tipo_id"];
        $this->usuario      = $result_row["usuario_id"];
    }

    //firma eliminarTarea para usuarios con sesion iniciada
    public static function eliminarTareaUsuario($tarea_id, $user_id){
        $query = "DELETE FROM tarea WHERE tarea_id = ? AND usuario_id = ?";
        $ps = Config::$dbh->prepare($query);
        $res = $ps->execute(array(
                                $tarea_id,
                                $user_id
        ));
    }

    //firma eliminarTarea para admin con sesion iniciada
    public static function eliminarTareaAdmin($tarea_id){
        $query = "DELETE FROM tarea WHERE tarea_id = ?";
        $ps = Config::$dbh->prepare($query);
        $res = $ps->execute(array(
                                $tarea_id
        ));
    }

    public static function mostrarTareaUsuario($tarea_id, $user_id){
        $query = "SELECT * FROM tarea WHERE tarea_id = ? AND usuario_id = ?";
        $ps = Config::$dbh->prepare($query);
        $res = $ps->execute(array(
                                $tarea_id,
                                $user_id
        ));

        if($res){
            $result = new Tarea($ps->fetch());
        }
        return $result;
    }

    public static function mostrarTareaAdmin($tarea_id){
        $query = "SELECT * FROM tarea WHERE tarea_id = ?";
        $ps = Config::$dbh->prepare($query);
        $res = $ps->execute(array(
                                $tarea_id
        ));

        if($res){
            $result = new Tarea($ps->fetch());
        }
        return $result;
    }

    public static function contarTareasUsuario($user_id){
        $query = "SELECT COUNT(tarea_id) FROM tarea WHERE usuario_id = ?";
        $ps = Config::$dbh->prepare($query);
        $res = $ps->execute(array($user_id));
        $result = 0;
        if($res)
            $result = $ps->fetch()[0];
        return $result;
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

    public function getFecha() {
        return $this->fecha_inicio;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = descripcion;
    }
    
    public function getEstado() {
        return EstadoTarea::getById($this->estado);
    }

    public function getTipo() {
        return TipoTarea::getById($this->tipo);
    }
    public function getUsuarioId(){
        return $this->usuario;
    }

    public function getUsuario(){
        return Usuario::getById($this->usuario);
    }
}

?>