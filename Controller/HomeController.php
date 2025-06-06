<?php

class HomeController{

    static function index(){
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