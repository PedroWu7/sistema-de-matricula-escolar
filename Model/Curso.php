<?php
    require_once __DIR__ . "\..\Config\Banco.php";
    class Curso {
        static function listarCursos(){
            $conn = Banco::Conn();
            $sql = "SELECT * FROM cursos";
            $resp = $conn->query($sql);
            if($resp->num_rows > 0){
                $cursos = $resp->fetch_all();
                return $cursos;
            }
        }

        static function adicionar($nome, $imagem, $descricao, $professor){
            $sql = "INSERT INTO cursos (id, nome, imagem, descricao, alunos, professor) VALUES (NULL, '$nome', '$imagem', '$descricao', NULL, '$professor')";
            $resp = Banco::Conn()->query($sql);
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

        static function atualizar($nome, $imagem, $descricao, $professor, $id){
            $sql = "UPDATE cursos SET nome = '$nome', imagem = '$imagem', descricao = '$descricao', professor = '$professor' WHERE id = $id";
            $resp = Banco::Conn()->query($sql);
        }

        static function existe($id){
            $sql = "SELECT * FROM cursos WHERE id = $id";
            $res = Banco::Conn()->query($sql);
            if($res->num_rows > 0){
                return [true, $res->fetch_assoc()];
            }
            return [false];
        }

        static function excluir($id){
            $sql = "DELETE FROM cursos WHERE id = $id";
            Banco::Conn()->query($sql);
        }
    } 
?>