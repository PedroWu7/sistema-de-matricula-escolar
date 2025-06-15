<?php
    require_once __DIR__ . "/../Config/Banco.php";


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
                return $aluno;
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

        static function adicionar($nome, $usuario, $senha, $dataNasc, $cpf) {
            $hash_armazenado = password_hash($senha, PASSWORD_DEFAULT);
            
            if ($hash_armazenado) {
                $conn = Banco::Conn();
                $stmt = $conn->prepare("INSERT INTO alunos (nome, usuario, senha, nivel_acesso, cursos_matriculados, cpf, data_nasc) VALUES (?, ?, ?, 'aluno', NULL, ?, ?)");
                $stmt->bind_param("sssss", $nome, $usuario, $hash_armazenado, $cpf, $dataNasc);
        
                if ($stmt->execute()) {
                    echo "Usuário criado com sucesso!";
                } else {
                    echo "Erro ao criar o usuário: " . $stmt->error;
                }
            } else {
                echo "Erro ao gerar o hash da senha.";
            }
        }

        public static function editar($id, $nome, $usuario, $nivel_acesso, $cursos_matriculados, $cpf, $data_nasc) {
            $conn = Banco::conn();

            $sql = "UPDATE alunos SET nome = ?, usuario = ?, nivel_acesso = ?, cursos_matriculados = ?, cpf = ?, data_nasc = ? WHERE id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $nome, $usuario, $nivel_acesso, $cursos_matriculados, $cpf, $data_nasc, $id);
            $stmt->execute();

            header("Location: ./../../../gerenciar/usuarios");
            exit;
    }


        public static function excluir($id) {
            $conn = Banco::conn();
            $sql = "DELETE FROM alunos WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id]);
            header("location: ./../../../gerenciar/usuarios");
            exit;
        }

    } 
?>