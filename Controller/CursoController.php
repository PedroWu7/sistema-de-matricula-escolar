<?php
    require_once __DIR__ . "/../Model/Curso.php";
    require_once __DIR__ . "/UsuarioController.php";
    require_once __DIR__ . "/../Utils/csrf.php";
    
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    class CursoController {

        static function adicionar(){

            

            if($_SESSION["nivel_acesso"] !== "administrador"){
                $_SESSION["mensagem_alerta"] = "Você não tem acesso a essa página.";
                header("Location: ./../");
                return;
            }

            include __DIR__ . "/../View/adicionar_curso.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
                    $_SESSION["mensagem_alerta"] = "Erro de segurança: token inválido.";
                    header("Location: ./../");
                    exit;
                }

                Curso::adicionar(
                    $_POST["criarNome"], 
                    $_POST["criarImagem"], 
                    $_POST["criarDescricao"], 
                    $_POST["addProfessor"]
                );

            }

        }

        static function atualizar($id){
            if($_SESSION["nivel_acesso"] !== "administrador"){
                $_SESSION["mensagem_alerta"] = "Você não tem acesso a essa página.";
                header("Location: ./../");
                return;
            }
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);

            if (isset($url[2])) {  
                $id = $url[2];
                if(Curso::existe($id)[0]){
                    $curso = Curso::existe($id)[1];
                } else {
                    echo "ID não encontrado.";
                    exit;
                }
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Validação CSRF
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    die('Erro: token CSRF inválido.');
                }
                $id = intval($_POST["id"]);
                $nome = $_POST["nome"];
                $imagem = $_POST["imagem"];
                $descricao = $_POST["descricao"];
                $professor = $_POST["professor"];
                Curso::atualizar($nome, $imagem, $descricao, $professor, $id);
                $_SESSION["mensagem_alerta"] = "Curso atualizado com sucesso!";
                header("location: ../../index");
            }
            
            include __DIR__ . "/../View/atualizar_curso.php";
        } 

        static function excluir($id){
            if($_SESSION["nivel_acesso"] !== "administrador"){
                $_SESSION["mensagem_alerta"] = "Você não tem acesso a essa página.";
                header("Location: ./../");
                return;
            }

            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);

            if (isset($url[2])) {
                $id = intval($url[2]);
                if(Curso::existe($id)[0]){
                    Curso::excluir($id);
                } else {
                    echo "ID não encontrado.";
                    exit;
                }
            }

            $url_anterior = $_SERVER['HTTP_REFERER'] ?? 'index.php'; 

            header("Location: " . $url_anterior);
        }

        static function ver(){
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
            if (isset($url[2])) {
                $id = intval($url[2]);
                if(Curso::existe($id)[0]){
                    $curso = Curso::ver($id);
                } else {
                    echo "ID não encontrado.";
                    exit;
                }
            }

            return $curso;
            header("Location: ./../");
        }

        static function listarMeus(){
            return Curso::listarMeus($_SESSION["usuario"]);
        }

        static function participar($id){
            if($_SESSION["nivel_acesso"] !== "aluno"){
                $_SESSION["mensagem_alerta"] = "Se cadastre para se inscrever em algum curso.";
                header("Location: ./../");
                return;
            }
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
            if (isset($url[2])) {
                $id = intval($url[2]);
                if(Curso::existe($id)[0]){
                    Curso::participar($id, $_SESSION["usuario"]);
                    UsuarioController::matricular($_SESSION["id"], $id);
                } else {
                    echo "ID não encontrado.";
                    exit;
                }
            }
            // Obtém o URL da página anterior ou define uma página padrão
            $url_anterior = $_SERVER['HTTP_REFERER'] ?? 'index.php'; 

            header("Location: " . $url_anterior);
            exit(); // É crucial chamar exit() após um redirecionamento para parar a execução do script.
        }

        

        static function sair($idCurso) {
            $usuario = $_SESSION["usuario"];

            if (Curso::usuarioInscritoCurso($idCurso, $usuario)) {
                $curso = Curso::ver($idCurso);
                $alunos = $curso["alunos"];
                $novaLista = str_replace($usuario . ";", "", $alunos);

                if (Curso::atualizarAlunos($idCurso, $novaLista)) {
                    $url_anterior = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                    header("Location: " . $url_anterior);
                    exit;
                } else {
                    echo "Erro ao atualizar o curso.";
                }
            } else {
                echo "Você não está matriculado nesse curso.";
            }
        }
    }

?>