<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    
    if($conn->error){ ?>
        <p>Erro ao fazer a conexão com o banco.</p>
    <?php }

    function adicionarCurso($conn, $nome, $imagem, $descricao, $professor){
        $sql = "INSERT INTO cursos (id, nome, imagem, descricao, alunos, professor) VALUES (NULL, '$nome', '$imagem', '$descricao', NULL, '$professor')";
        $resp = $conn->query($sql);
    }

    function adicionarAlunoEmCurso($conn, $idCurso){
        $sql2 = "SELECT * FROM cursos WHERE `cursos`.`nome` = '$idCurso';";
        $resultado = $conn->query($sql2);
        $linhas = $resultado->num_rows;
        if ( $linhas > 0){
            $aluno = $resultado->fetch_assoc()['alunos'];
            $sql = "UPDATE `cursos` SET `alunos` = '$idCurso' WHERE `cursos`.`alunos` = '$aluno' . '$idCurso';";
            $resp = $conn->query($sql);
        }
        
    }


?>


