<?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "sistema_escolar");
    if($conn->error){ ?>
        <p>Erro ao fazer a conexão com o banco.</p>
    <?php }

    function usuarioExiste($conn, $usuario, $senha){
        $q = "SELECT * FROM alunos WHERE usuario = '$usuario' AND senha = '$senha'";
        $resultado = $conn->query($q);
        if ($resultado->num_rows > 0){
            $aluno = $resultado->fetch_assoc();
            $_SESSION["id"] = $aluno["id"];
            $_SESSION["nome"] = $aluno["nome"];
            $_SESSION["usuario"] = $aluno["usuario"];
            $_SESSION["senha"] = $aluno["senha"];
            $_SESSION["nivel_acesso"] = $aluno["nivel_acesso"];
            $_SESSION["cursos_matriculados"] = $aluno["cursos_matriculados"];
            return true;
        }
        return false;
    }
?>