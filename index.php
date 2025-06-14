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
        "recuperar-senha" => UsuarioController::recuperarSenha(),

        "logout" => HomeController::logout(),
        "excluir" => HomeController::excluir($url),        
        "gerenciar" => HomeController::gerenciar($url),
        "ver" => HomeController::ver($url[2]),
        "meus-cursos" => HomeController::meusCursos(),
        "sobre" => HomeController::sobre(),
        "sair" => HomeController::sair($url),


        "adicionar" => CursoController::adicionar(),
        "atualizar" => CursoController::atualizar($url[2]),
        "participar" => CursoController::participar($url[2]),


        default => HomeController::index()
    }
?>