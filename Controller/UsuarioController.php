<?php
    require_once __DIR__ . "/../Model/Usuario.php";
    require_once __DIR__ . "/../Utils/csrf.php";

    class UsuarioController{

        static function login(){
            if ($_SERVER["REQUEST_METHOD"] === "POST"){
                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    die("Erro: token CSRF inválido.");
                }

                $inputUsuario = $_POST["inputUsuario"];
                $inputSenha = $_POST["inputSenha"];

                $login = Usuario::login($inputUsuario, $inputSenha);
                if($login){
                    $_SESSION["id"] = $login["id"];
                    $_SESSION["nome"] = $login["nome"];
                    $_SESSION["usuario"] = $login["usuario"];
                    $_SESSION["nivel_acesso"] = $login["nivel_acesso"];
                    $_SESSION["cursos_matriculados"] = $login["cursos_matriculados"];

                    setcookie("usuario_logado", $login["usuario"], time() + (3 * 24 * 60 * 60), "/");

                    header("location: index");
                } else { ?>
                    <p>Usuário ou senha incorretos.</p>
                <?php }
            }
            include __DIR__ . "/../View/login.php";

            
        }

        static function cadastrar(){
            if ($_SERVER["REQUEST_METHOD"] === "POST"){

                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('Erro: token CSRF inválido.');
                }

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
            
            include __DIR__ . "/../View/cadastrar.php";

        }

        static function matricular($idUsuario, $idCurso) {
            if ($_SESSION["nivel_acesso"] !== "aluno") {
                $_SESSION["mensagem_alerta"] = "Se cadastre para se inscrever em algum curso.";
                header("Location: ./../");
                return;
            }

            //buscar cursos atuais do aluno
            $curso_alunos = Usuario::buscarCursosMatriculados($idUsuario);

            //verificar se já está matriculado
            if (str_contains($curso_alunos, $idCurso . ";")) {
                return "inscrito";
            }

            //concatenar novo curso e atualizar
            $novosCursos = $curso_alunos . $idCurso . ";";
            Usuario::atualizarCursosMatriculados($idUsuario, $novosCursos);
        }

        static function recuperarSenha() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    die("Erro: token CSRF inválido.");
                }

                //verificação do usuário
                if (isset($_POST["inputUsuario"])) {
                    $inputUsuario = $_POST["inputUsuario"];

                    if (Usuario::existe($inputUsuario)) {
                        $_SESSION["usuario_recuperacao"] = $inputUsuario;
                        include __DIR__ . "/../View/recuperar_senha/recuperar_cpf.php";
                        return;
                    } else {
                        $_SESSION["mensagem_alerta"] = "Usuário não encontrado.";
                        include __DIR__ . "/../View/recuperar_senha/recuperar_senha.php";
                        return;
                    }
                }

                //verificação de CPF e nascimento
                if (isset($_POST["inputCpf"]) && isset($_POST["inputNascimento"])) {
                    $inputCpf = $_POST["inputCpf"];
                    $inputNasc = $_POST["inputNascimento"];
                    $usuario = $_SESSION["usuario_recuperacao"];

                    if (Usuario::verificaCpfNascimento($usuario, $inputCpf, $inputNasc)) {
                        include __DIR__ . "/../View/recuperar_senha/recuperar_nova.php";
                        return;
                    } else {
                        $_SESSION["mensagem_alerta"] = "Dados incorretos.";
                        include __DIR__ . "/../View/recuperar_senha/recuperar_cpf.php";
                        return;
                    }
                }

                // atualizar senha
                if (isset($_POST["inputSenha"])) {
                    $senha = $_POST["inputSenha"];
                    $inputUsuario = $_SESSION["usuario_recuperacao"];

                    if (Usuario::atualizarSenha($inputUsuario, $senha)) {
                        $_SESSION["mensagem_alerta"] = "Senha alterada com sucesso!";
                        header("location: /sistema-de-matricula-escolar/");
                        exit;
                    } else {
                        $_SESSION["mensagem_alerta"] = "Erro ao atualizar senha.";
                        include __DIR__ . "/../View/recuperar_senha/recuperar_nova.php";
                        return;
                    }
                }
            }

            include __DIR__ . "/../View/recuperar_senha/recuperar_senha.php";
        }


        public static function editar($id) {

            if($_SERVER["REQUEST_METHOD"] === "POST"){

                if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                    die("Erro: token CSRF inválido.");
                }

                $aluno = [$_POST["nome"], $_POST["usuario"], $_POST["nivel_acesso"], $_POST["cursos_matriculados"], $_POST["cpf"], $_POST["data_nasc"]];
                $nome = $aluno[0];
                $usuario = $aluno[1];
                $nivel_acesso = $aluno[2];
                $cursos_matriculados = $aluno[3];
                $cpf = $aluno[4];
                $data_nasc = $aluno[5];

                Usuario::editar($id, $nome, $usuario, $nivel_acesso, $cursos_matriculados, $cpf, $data_nasc);

            }
            
            include __DIR__ . "/../View/editar_utilizador.php";
        }

        static function pegarPorId($id){    
            return Usuario::pegarPorId($id);
        }
    }
?>