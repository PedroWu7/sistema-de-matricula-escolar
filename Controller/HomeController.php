<?php

class HomeController {

    static function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["usuario"])) {
            $_SESSION["usuario"] = "Guest";
            $_SESSION["nivel_acesso"] = "visitante";
        }

        // Captura a mensagem da sessão e apaga
        $mensagem = null;
        if (isset($_SESSION['mensagem_alerta'])) {
            $mensagem = $_SESSION['mensagem_alerta'];
            unset($_SESSION['mensagem_alerta']);
        }

        // Carrega a view principal
        include __DIR__ . "/../View/index.php";

        // Exibe o alerta no final da página
        if ($mensagem) {
            echo "<script>alert('" . addslashes($mensagem) . "');</script>";
        }
    }

    static function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index");
        exit;
    }

    static function gerenciar() {
        if (!isset($_SESSION["nivel_acesso"]) || $_SESSION["nivel_acesso"] !== "administrador") {
            $_SESSION["mensagem_alerta"] = "Você não tem acesso a essa página.";
            header("Location: ../");
            exit;
        }

        include __DIR__ . "/../View/utilizadores.php";
    }

    static function ver() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comentario"])) {
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
    
            $curso_id = intval($url[2] ?? 0);
            $autor = $_SESSION["usuario"];
            $texto = trim($_POST["comentario"]);
    
            if (!empty($texto)) {
                Comentario::salvar($curso_id, $autor, $texto);
            }
        }
        include __DIR__ . "/../View/curso.php";
    }

    static function meusCursos() {
        if (!isset($_SESSION["nivel_acesso"]) || $_SESSION["nivel_acesso"] !== "aluno") {
            $_SESSION["mensagem_alerta"] = "Você não tem acesso a essa página.";
            header("Location: index");
            exit;
        }

        include __DIR__ . "/../View/meus_cursos.php";
    }

    static function sobre(){
        include __DIR__ . "/../View/sobre.html";
    }
}
?>
