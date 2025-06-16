<?php
    require_once __DIR__ . "/../Config/Banco.php";


    class Usuario {
        public static function listar(){
            $sql = "SELECT * FROM alunos;";
            $resp = Banco::Conn()->query($sql);
            $alunos = $resp->fetch_all();
            return $alunos;
        }

        static function pegarPorId($id){
            $sql = "SELECT * FROM alunos WHERE id = '$id';";
            $resp = Banco::Conn()->query($sql);
            $aluno = $resp->fetch_assoc();
            return $aluno;
        }


        public static function buscarCursosMatriculados($idUsuario) {
            $conn = Banco::Conn();
        
            $sql = "SELECT cursos_matriculados FROM alunos WHERE id = $idUsuario";
            $result = $conn->query($sql);
        
            if ($result && $row = $result->fetch_assoc()) {
                return $row["cursos_matriculados"] ?? "";
            }
        
            return "";
        }

        public static function atualizarCursosMatriculados($idUsuario, $novosCursos) {
            $conn = Banco::Conn();
            $sql = "UPDATE alunos SET cursos_matriculados = '$novosCursos' WHERE id = '$idUsuario'";
            $conn->query($sql);

        }

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

            $sql = "UPDATE alunos SET nome = '$nome', usuario = '$usuario', nivel_acesso = '$nivel_acesso', cursos_matriculados = '$cursos_matriculados', cpf = '$cpf', data_nasc = '$data_nasc' WHERE id = '$id'";

            $conn->query($sql);
            header("Location: ./../../../gerenciar/usuarios");
            exit;
    }

        public static function excluir($id) {
            $conn = Banco::conn();
            $sql = "DELETE FROM alunos WHERE id='$id'";
            $conn->query($sql);
            header("location: ./../../../gerenciar/usuarios");
            exit;
        }

        public static function verificaCpfNascimento($usuario, $cpf, $nascimento) {
            $sql = "SELECT * FROM alunos WHERE usuario = '$usuario' AND cpf = '$cpf' AND data_nasc = '$nascimento'";
            $conn = Banco::Conn();
            $res = $conn->query($sql);

            if($res->num_rows > 0){
                return true;
            }

            return false;
        }

        public static function atualizarSenha($usuario, $novaSenha) {
            $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $conn = Banco::Conn();
            $sql = "UPDATE alunos SET senha = '$hash' WHERE usuario = '$usuario'";
            
            return $conn->query($sql);
        }


    } 
?>