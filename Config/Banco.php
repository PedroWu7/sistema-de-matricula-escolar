<?php

class Banco {
    public static function Conn(){
        $conn = new mysqli("localhost", "root", "", "sistema_escolar", "3307");
        return $conn;
    }
}

?>