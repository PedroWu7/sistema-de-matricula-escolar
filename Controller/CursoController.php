<?php
    require_once __DIR__ . "\..\Model\Curso.php";
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    class CursoController {
        static function listarCursos(){
            $conn = Banco::Conn();
            $sql = "SELECT * FROM cursos";
            $resp = $conn->query($sql);
            if($resp->num_rows > 0){
                $cursos = $resp->fetch_all();
                return $cursos;
            }
        }

        static function adicionar(){
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                Curso::adicionar($_POST["criarNome"], $_POST["criarImagem"], $_POST["criarDescricao"], $_POST["addProfessor"]);
            }
            include __DIR__ . "/../View/adicionar-curso.php";
        }
        
        static function adicionarAlunoEmCurso($idCurso){
            $sql2 = "SELECT * FROM cursos WHERE `cursos`.`nome` = '$idCurso';";
            $resultado = Banco::Conn()->query($sql2);
            $linhas = $resultado->num_rows;
            if ( $linhas > 0){
                $aluno = $resultado->fetch_assoc()['alunos'];
                $sql = "UPDATE `cursos` SET `alunos` = '$idCurso' WHERE `cursos`.`alunos` = '$aluno' . '$idCurso';";
                $resp = Banco::Conn()->query($sql);
            }
            
        }

        static function atualizarCurso($id){
    
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
            
            include __DIR__ . "/../View/atualizarCurso.php";
        } 

        static function excluir($id){
            if ($_SESSION["nivel_acesso"] !== "administrador") {
                header("Location: index.php");
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
    } 
?>