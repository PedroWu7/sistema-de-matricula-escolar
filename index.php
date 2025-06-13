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
        "excluir" => CursoController::excluir($url[2]),
        "excluir-comentario" => ComentarioController::excluirComentario($url[1]),
        "adicionar" => CursoController::adicionar(),
        "participar" => CursoController::participar($url[2]),
        "gerenciar" => HomeController::gerenciar(),
        "ver" => HomeController::ver($url[2]),
        "meus-cursos" => HomeController::meusCursos(),
        "recuperar-senha" => UsuarioController::recuperarSenha(),
        "aluno-listar" => AlunoController::listar(),
        "aluno-cadastrar" => AlunoController::cadastrar(),
        "aluno-editar" => AlunoController::editar($url[2]),
        "aluno-excluir" => AlunoController::excluir($url[2]),
        "sobre" => HomeController::sobre(),
        default => HomeController::index()
    }


?>