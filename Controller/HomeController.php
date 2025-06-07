<?php

class HomeController{

    static function index(){
        if (!isset($_SESSION["usuario"])) {
            $_SESSION["usuario"] = "Guest";
            $_SESSION["nivel_acesso"] = "visitante";
        }
        include __DIR__ . "/../View/index.php";
    }

    static function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("location: index");  
        exit;

    }
}



?>