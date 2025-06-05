<?php
    require __DIR__ . "\..\Config\Banco.php";
    class Usuario {
        public static function login($usuario, $senha){
            $q = "SELECT * FROM alunos WHERE usuario = '$usuario'";
            $resultado = Banco::Conn()->query($q);
            if($resultado->num_rows > 0){
                $aluno = $resultado->fetch_assoc();
            } else { 
                return false; 
            }
            $hash_armazenado = $aluno["senha"];
            if(password_verify($senha, $hash_armazenado)){
                $_SESSION["id"] = $aluno["id"];
                $_SESSION["nome"] = $aluno["nome"];
                $_SESSION["usuario"] = $aluno["usuario"];
                $_SESSION["nivel_acesso"] = $aluno["nivel_acesso"];
                $_SESSION["cursos_matriculados"] = $aluno["cursos_matriculados"];
                return true;
            }
            return false;
        }

        public static function existe($usuario){
            $q = "SELECT * FROM alunos WHERE usuario = '$usuario'";
            $resultado = Banco::Conn()->query($q);

            if ($resultado->num_rows > 0){
                return true;
            }
            return false;
        }

        static function adicionarUsuario($nome, $usuario, $senha) {
            $hash_armazenado = password_hash($senha, PASSWORD_DEFAULT);
        
            if ($hash_armazenado) {
                $conn = Banco::Conn();
                $stmt = $conn->prepare("INSERT INTO alunos (nome, usuario, senha, nivel_acesso, cursos_matriculados) VALUES (?, ?, ?, 'aluno', NULL)");
                $stmt->bind_param("sss", $nome, $usuario, $hash_armazenado);
        
                if ($stmt->execute()) {
                    echo "Usuário criado com sucesso!";
                } else {
                    echo "Erro ao criar o usuário: " . $stmt->error;
                }
            } else {
                echo "Erro ao gerar o hash da senha.";
            }
        }
    } 
?>