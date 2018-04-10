<?php

class Usuario {

    private $id;
    private $nombre;
    private $email;
    private $rol;

    function __construct($result_row) {
        $this->id     = $result_row["usuario_id"];
        $this->nombre = $result_row["nombre"];
        $this->email  = $result_row["email"];
        $this->rol    = $result_row["rol_id"];        
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRol() {
        return $this->nombre;
    }

    public static function findByUsername($username) {
        $query = "SELECT * FROM usuario WHERE nombre = ?";
        $ps    = Config::$dbh->prepare($query);
        $res   = $ps->execute(array($username));        
        
        $result = null;
        if($res) {
            $userRow = $ps->fetch();
            if($userRow) {
                $result = new Usuario($userRow);
            }
        } 

        return $result;
    }
}

?>