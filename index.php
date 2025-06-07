<?php 

    $pagina = $_GET['p'] ?? null;

    $url = explode('/', $pagina);

    require_once "Controller/HomeController.php";
    require_once "Controller/UsuarioController.php";
    require_once "Controller/CursoController.php";

    match($url[0]){
        "cadastrar" => UsuarioController::cadastrar(),
        "login" => UsuarioController::login(),
        "logout" => HomeController::logout(),
        "atualizar" => CursoController::atualizar($url[2]),
        "excluir" => CursoController::excluir($url[2]),
        "adicionar" => CursoController::adicionar(),
        "participar" => CursoController::participar($url[2]),
        "gerenciar" => HomeController::gerenciar(),
        default => HomeController::index()
    }


?>