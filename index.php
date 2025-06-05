<?php 

$pagina = $_GET['p'] ?? null;

    $url = explode('/', $pagina);

    require_once "Controller/HomeController.php";
    require_once "Controller/UsuarioController.php";

    match($url[0]){
        "cadastrar" => UsuarioController::cadastrar(),
        "login" => UsuarioController::login(),
    }


?>