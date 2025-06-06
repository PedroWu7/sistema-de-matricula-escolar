<?php
    require_once __DIR__ . "\..\Config\Banco.php";
    class Curso {
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

        static function atualizarCurso($nome, $imagem, $descricao, $professor, $id){
            $sql = "UPDATE cursos SET nome = '$nome', imagem = '$imagem', descricao = '$descricao', professor = '$professor' WHERE id = $id";
            $resp = Banco::Conn()->query($sql);
        }
    } 
?>