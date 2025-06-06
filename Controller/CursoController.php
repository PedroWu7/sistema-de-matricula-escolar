<?php
    require_once __DIR__ . "\..\Model\Curso.php";
    class CursoController {
        public static function listarCursos(){
            $conn = Banco::Conn();
            $sql = "SELECT * FROM cursos";
            $resp = $conn->query($sql);
            if($resp->num_rows > 0){
                $cursos = $resp->fetch_all();
                return $cursos;
            }
        }

        function adicionarCurso($nome, $imagem, $descricao, $professor){
            $sql = "INSERT INTO cursos (id, nome, imagem, descricao, alunos, professor) VALUES (NULL, '$nome', '$imagem', '$descricao', NULL, '$professor')";
            $resp = Banco::Conn()->query($sql);
        }

        function adicionarAlunoEmCurso($idCurso){
            $sql2 = "SELECT * FROM cursos WHERE `cursos`.`nome` = '$idCurso';";
            $resultado = Banco::Conn()->query($sql2);
            $linhas = $resultado->num_rows;
            if ( $linhas > 0){
                $aluno = $resultado->fetch_assoc()['alunos'];
                $sql = "UPDATE `cursos` SET `alunos` = '$idCurso' WHERE `cursos`.`alunos` = '$aluno' . '$idCurso';";
                $resp = Banco::Conn()->query($sql);
            }
            
        }

        public static function existe($usuario){
            
        }

        static function adicionarUsuario($nome, $usuario, $senha) {
            
        }

        static function atualizarCurso($id){
    

        require_once __DIR__ . "/../Config/Banco.php";
        
        if ($_SESSION["nivel_acesso"] !== "aluno") {
           // header("Location: index");
            exit;
        }else{
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = intval($_POST["id"]);
                $nome = $_POST["nome"];
                $imagem = $_POST["imagem"];
                $descricao = $_POST["descricao"];
                $professor = $_POST["professor"];
                
                if (isset($_GET["id"])) {   
                    $id = intval($_GET["id"]);
                    $sql = "SELECT * FROM cursos WHERE id = $id";
                    $res = $conn->query($sql);
                    $curso = $res->fetch_assoc();
                } else {
                    header("Location: index");
                    exit;
                }
            }
            

            include __DIR__ . "View/atualizarCurso.php?id=$id";
        }

        header("Location: index");
        exit;


        }
    } 
?>