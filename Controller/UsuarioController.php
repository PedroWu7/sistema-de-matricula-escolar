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
            $existe = Usuario::existe($criarUsuario, $criarSenha);
            if($existe){ ?>
                <p>Usuário ou senha incorretos.</p>
            <?php } else { 
                Usuario::adicionar($criarNome, $criarUsuario, $criarSenha);
             }


        }
        
        include __DIR__ . "/../View/cadastrar.html";

    }

    static function esqueciSenha(){
        include __DIR__ . "/../View/esqueciSenha.php";
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

        $sql2 = "UPDATE `alunos` SET `cursos_matriculados` = '$novos_cursos;' WHERE `alunos`.`id` = $idUsuario;";
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
    
            // Etapa 2: Verifica o CPF
            if (isset($_POST["inputCpf"]) && isset($_SESSION["usuario_recuperacao"])) {
                $inputCpf = $_POST["inputCpf"];
                $usuario = $_SESSION["usuario_recuperacao"];
                $recuperar = true;
                include __DIR__ . "/../View/recuperar_nova.html";
                return;
            }

            if(isset($_POST["inputSenha"])){
                $_SESSION["mensagem_alerta"] = "Senha alterada com sucesso!";
                header("location: ./index");
                return;
            }
        }
    
        // Primeira vez acessando
        include __DIR__ . "/../View/recuperar_senha.html";
    }
    
}

?>