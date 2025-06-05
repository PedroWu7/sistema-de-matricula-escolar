<?php
    require __DIR__ . "\..\Config\Banco.php";
    class Usuario {
        public static function login($usuario, $senha){
            $q = "SELECT * FROM alunos WHERE usuario = '$usuario'";
            $resultado = Banco::Conn()->query($q);
            if($resultado->num_rows > 0){
                echo "linha";
                $aluno = $resultado->fetch_assoc();
            } else { return false; }
            $hash_armazenado = $aluno["senha"];
            echo $aluno["senha"];
            echo $senha;
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
            // Gerar o hash da senha
            $hash_armazenado = password_hash($senha, PASSWORD_DEFAULT);
        
            // Verificar se o hash foi gerado corretamente
            if ($hash_armazenado) {
                // Inserir no banco de dados com o hash
                $sql = "INSERT INTO alunos (id, nome, usuario, senha, nivel_acesso, cursos_matriculados) 
                        VALUES (NULL, '$nome', '$usuario', '$hash_armazenado', 'aluno', NULL)";
                $resp = Banco::Conn()->query($sql);
                
                if ($resp) {
                    echo "Usuário criado com sucesso!";
                } else {
                    echo "Erro ao criar o usuário: " . Banco::Conn()->error;
                }
            } else {
                echo "Erro ao gerar o hash da senha.";
            }
        }
    } 
?>