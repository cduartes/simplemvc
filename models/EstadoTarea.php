<?php

class EstadoTarea {

    private $id;
    private $nombre;

    public static function fromRowToEstado($row) {
        return new EstadoTarea($row["estado_id"], $row["nombre"]);
    }

    public static function getById($estado_id) {
        $query = "SELECT * FROM estado_tarea WHERE estado_id = ?";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array($estado_id));
        $result = null;
        if($res) {
            $result = $ps->fetch();
            $result = fromRowToEstado($result);
        }
        return $result;
    }

    public static function getAll() {
        $query = "SELECT * FROM estado_tarea";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute();
        $result = array();
        if($res) {
            $result = $ps->fetchAll();
            $result = array_map([EstadoTarea::class, 'fromRowToEstado'], $result);
        }

        return $result;
    }

    function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }
}

?>