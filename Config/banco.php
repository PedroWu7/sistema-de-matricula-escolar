<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    $conn = new mysqli("localhost", "root", "", "sistema_escolar", "3307");
    if($conn->error){ ?>
        <p>Erro ao fazer a conexão com o banco.</p>
    <?php }


    

    function usuarioExiste($conn, $usuario, $inputSenha){
        $q = "SELECT * FROM alunos WHERE usuario = '$usuario'";
        $resultado = $conn->query($q);

        if ($resultado->num_rows > 0){
            $aluno = $resultado->fetch_assoc();
            $hash_armazenado = $aluno["senha"];

            if(password_verify($inputSenha, $hash_armazenado)){
                $_SESSION["id"] = $aluno["id"];
                $_SESSION["nome"] = $aluno["nome"];
                $_SESSION["usuario"] = $aluno["usuario"];
                $_SESSION["nivel_acesso"] = $aluno["nivel_acesso"];
                $_SESSION["cursos_matriculados"] = $aluno["cursos_matriculados"];
                return true;
            }
        }
        return false;
    }


    function adicionarUsuario($conn, $nome, $usuario, $senha) {
        // Gerar o hash da senha
        $hash_armazenado = password_hash($senha, PASSWORD_DEFAULT);
    
        // Verificar se o hash foi gerado corretamente
        if ($hash_armazenado) {
            // Inserir no banco de dados com o hash
            $sql = "INSERT INTO alunos (id, nome, usuario, senha, nivel_acesso, cursos_matriculados) 
                    VALUES (NULL, '$nome', '$usuario', '$hash_armazenado', 'aluno', NULL)";
            $resp = $conn->query($sql);
            
            if ($resp) {
                echo "Usuário criado com sucesso!";
            } else {
                echo "Erro ao criar o usuário: " . $conn->error;
            }
        } else {
            echo "Erro ao gerar o hash da senha.";
        }
    }
    

    function listarCursos(){
        global $conn;
        $sql = "SELECT * FROM cursos";
        $resp = $conn->query($sql);
        if($resp->num_rows > 0){
            $cursos = $resp->fetch_all();
            return $cursos;
        }
    }

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


