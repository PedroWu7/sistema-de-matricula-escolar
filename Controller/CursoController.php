<?php
    require_once __DIR__ . "\..\Model\Curso.php";
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    class CursoController {
        static function listar(){
            return Curso::listar();
        }

        static function adicionar(){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                Curso::adicionar($_POST["criarNome"], $_POST["criarImagem"], $_POST["criarDescricao"], $_POST["addProfessor"]);
            }
            include __DIR__ . "/../View/adicionar_curso.html";
        }

        static function atualizar($id){
    
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
                $id = intval($_POST["id"]);
                $nome = $_POST["nome"];
                $imagem = $_POST["imagem"];
                $descricao = $_POST["descricao"];
                $professor = $_POST["professor"];
                Curso::atualizar($nome, $imagem, $descricao, $professor, $id);
            }
            
            include __DIR__ . "/../View/atualizar_curso.php";
        } 

        static function excluir($id){
            if ($_SESSION["nivel_acesso"] !== "administrador") {
                header("Location: index");
                exit;
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

            header("Location: ./../");
            exit;
        }

        static function participar($id){
           $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
            if (isset($url[2])) {
                $id = intval($url[2]);
                if(Curso::existe($id)[0]){
                    Curso::participar($id, $_SESSION["usuario"]);
                } else {
                    echo "ID não encontrado.";
                    exit;
                }
            }

            //header("Location: ./../");
            exit;
        }
    } 
?>