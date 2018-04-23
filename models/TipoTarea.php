<?php

class TipoTarea {
    private $id;
    private $nombre;

    public static function fromRowToTipoTarea($row) {
        return new TipoTarea($row["tipo_id"],$row["nombre"]);
    }

    public static function getById($tipo_id) {
        $query = "SELECT * FROM tipo_tarea WHERE tipo_id = ?";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array($tipo_id));
        $result= null;
        if($res){
            $result = $ps->fetch();
            $result = new TipoTarea($result[0],$result[1]);
        }

        return $result;
    }

    public static function getAll() {
        $query = "SELECT * FROM tipo_tarea";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute();
        $result = array();
        if($res) {
            $result = $ps->fetchAll();
            $result = array_map([TipoTarea::class, 'fromRowToTipoTarea'], $result);
        }

        return $result;
    }

    function __construct($id, $nombre) {
        $this->id     = $id;
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