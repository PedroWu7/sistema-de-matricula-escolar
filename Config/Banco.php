<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }


class Banco {
    public static function Conn(){
        $conn = new mysqli("localhost", "root", "", "sistema_escolar", "3307");
        return $conn;
    }
}

?>