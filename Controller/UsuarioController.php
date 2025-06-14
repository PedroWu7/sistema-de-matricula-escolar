<?php

require_once __DIR__ . "/../Model/Usuario.php";
session_start();

class UsuarioController{
    static function login(){

        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $inputUsuario = $_POST["inputUsuario"];
            $inputSenha = $_POST["inputSenha"];

            $login = Usuario::login($inputUsuario, $inputSenha);
            if($login){
                $_SESSION["id"] = $login["id"];
                $_SESSION["nome"] = $login["nome"];
                $_SESSION["usuario"] = $login["usuario"];
                $_SESSION["nivel_acesso"] = $login["nivel_acesso"];
                $_SESSION["cursos_matriculados"] = $login["cursos_matriculados"];
                header("location: index");
            } else { ?>
                <p>Usuário ou senha incorretos.</p>
            <?php }
        }
        include __DIR__ . "/../View/login.html";

        
    }

    static function cadastrar(){
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            $criarUsuario = $_POST["criarUsuario"];
            $criarSenha = $_POST["criarSenha"];
            $criarNome = $_POST["criarNome"];
            $criarDataNasc = $_POST["criarDataNasc"];
            $criarCPF = $_POST["criarCPF"];
            $existe = Usuario::existe($criarUsuario, $criarSenha);
            if($existe){ ?>
                <p>Usuário ou senha incorretos.</p>
            <?php } else { 
                Usuario::adicionar($criarNome, $criarUsuario, $criarSenha, $criarDataNasc, $criarCPF);
             }


        }
        
        include __DIR__ . "/../View/cadastrar.html";

    }

    static function matricular($idUsuario, $idCurso){
        if($_SESSION["nivel_acesso"] !== "aluno"){
            $_SESSION["mensagem_alerta"] = "Se cadastre para se inscrever em algum curso.";
            header("Location: ./../");
            return;
        }
        $conn = Banco::Conn();

        $sql = "SELECT * FROM alunos WHERE id = '$idUsuario'";
        $resp = $conn->query($sql);
        if($resp->num_rows > 0){
            $curso_alunos = $resp->fetch_assoc()["cursos_matriculados"];
        }
        if(str_contains($curso_alunos, $idCurso)){
            return "inscrito";
        }

        $novos_cursos = $curso_alunos . $idCurso;

        $sql2 = "UPDATE alunos SET cursos_matriculados = '$novos_cursos' WHERE id = $idUsuario";
        $resp = Banco::Conn()->query($sql2);
    }

    static function listar(){
        $sql = "SELECT * FROM alunos;";
        $resp = Banco::Conn()->query($sql);
        $alunos = $resp->fetch_all();
        return $alunos;
    }

    static function recuperarSenha() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
            // Etapa 1: Verifica o usuário
            if (isset($_POST["inputUsuario"])) {
                $inputUsuario = $_POST["inputUsuario"];
                $sql = "SELECT * FROM alunos WHERE usuario = '$inputUsuario'";
                $result = Banco::Conn()->query($sql);
    
                if ($result->num_rows > 0) {
                    // Salva o usuário temporariamente na sessão
                    $_SESSION["usuario_recuperacao"] = $inputUsuario;
                    include __DIR__ . "/../View/recuperar_cpf.html";
                    return;
                } else {
                    echo "<p>Usuário não encontrado.</p>";
                    include __DIR__ . "/../View/recuperar_senha.html";
                    return;
                }
            }
    
            // Etapa 2: Verifica o CPF e data de nascimento
            if (isset($_POST["inputCpf"]) && isset($_POST["inputNascimento"])) {
                $inputCpf = $_POST["inputCpf"];
                $inputNasc = $_POST["inputNascimento"];
                $usuario = $_SESSION["usuario_recuperacao"];

                $sql = "SELECT * FROM alunos WHERE cpf = '$inputCpf'";
                $result = Banco::Conn()->query($sql);

                if ($result->num_rows > 0) {
                    $sql = "SELECT * FROM alunos WHERE data_nasc = '$inputNasc'";
                    $result = Banco::Conn()->query($sql);
                    if ($result->num_rows > 0) {
                        $recuperar = true;
                        include __DIR__ . "/../View/recuperar_nova.html";
                        return;
                    }else{
                        echo "<p>Data de nascimento incorreta.<p>";
                        include __DIR__ . "/../View/recuperar_cpf.html";
                        return;
                    }
                } else{ 
                    echo "<p>Cpf incorreto.</p>";
                    include __DIR__ . "/../View/recuperar_cpf.html";
                    return;
                }
            }

            if(isset($_POST["inputSenha"])){
                $senha = $_POST["inputSenha"];
                $inputUsuario = $_SESSION["usuario_recuperacao"];
                $hash_armazenado = password_hash($senha, PASSWORD_DEFAULT);
                $conn = Banco::Conn();
                $stmt = $conn->prepare("UPDATE alunos SET senha = ? WHERE usuario = ?");
                $stmt->bind_param("ss", $hash_armazenado, $inputUsuario);
                $stmt->execute();
                //echo "$inputUsuario";
                //echo "$hash_armazenado";
                //echo "$senha";
                $_SESSION["mensagem_alerta"] = "Senha alterada com sucesso!";
                header("location: ./index");
                return;
            }
        }
    
        // Primeira vez acessando
        include __DIR__ . "/../View/recuperar_senha.html";
    }
    
    public static function excluir($id) {
        $pdo = Banco::conn();
        $sql = "DELETE FROM alunos WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header("location: ./../../../gerenciar/usuarios");
        exit;
    }

    public static function editar($id) {

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $aluno = [$_POST["nome"], $_POST["usuario"], $_POST["nivel_acesso"], $_POST["cursos_matriculados"], $_POST["cpf"], $_POST["data_nasc"]];
            $nome = $aluno[0];
            $usuario = $aluno[1];
            $nivel_acesso = $aluno[2];
            $cursos_matriculados = $aluno[3];
            $cpf = $aluno[4];
            $data_nasc = $aluno[5];
            $conn = Banco::Conn();

            $sql = "UPDATE `alunos` SET `nome` = '$nome', `usuario` = '$usuario', `nivel_acesso` = '$nivel_acesso', `cursos_matriculados` = '$cursos_matriculados', `cpf` = '$cpf', `data_nasc` = '$data_nasc' WHERE `alunos`.`id` = $id;";

            $conn->query($sql);
            header("location: ./../../../gerenciar/usuarios");
        }
        
        include __DIR__ . "/../View/editar_utilizador.php";
    }

    static function pegarPorId($id){
        $sql = "SELECT * FROM alunos WHERE id = '$id';";
        $resp = Banco::Conn()->query($sql);
        $aluno = $resp->fetch_assoc();
        return $aluno;
    }
}

?>