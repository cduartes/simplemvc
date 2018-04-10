<?php 

class Rol {
    private $nombre;

    function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }
}

?>