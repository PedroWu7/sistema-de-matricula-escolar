<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $pagina = $_GET['p'] ?? "";

    $url = explode('/', $pagina);

    require_once "Controller/HomeController.php";
    require_once "Controller/UsuarioController.php";
    require_once "Controller/CursoController.php";
    require_once "Controller/ComentarioController.php";


    match($url[0]){
        "cadastrar" => UsuarioController::cadastrar(),
        "login" => UsuarioController::login(),
        "logout" => HomeController::logout(),
        "atualizar" => CursoController::atualizar($url[2]),
        "excluir" => HomeController::excluir($url),
        "adicionar" => CursoController::adicionar(),
        "participar" => CursoController::participar($url[2]),
        "gerenciar" => HomeController::gerenciar($url),
        "ver" => HomeController::ver($url[2]),
        "meus-cursos" => HomeController::meusCursos(),
        "recuperar-senha" => UsuarioController::recuperarSenha(),
        "sobre" => HomeController::sobre(),
        "sair" => HomeController::sair($url),
        default => HomeController::index()
    }
?>