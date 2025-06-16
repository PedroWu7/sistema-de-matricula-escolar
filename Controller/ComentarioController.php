<?php
    require_once __DIR__ . "/../Model/Comentario.php";
    require_once __DIR__ . "/CursoController.php";
    require_once __DIR__ . "/../Utils/csrf.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    class ComentarioController{

        public static function listarPorCurso() {
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
            $curso_id = intval($url[2] ?? 0);

            $comentarios = Comentario::listarPorCurso($curso_id);
            $comentarios = $comentarios->fetch_all();

            return $comentarios;
        }


        public static function excluirComentario($comentario_id) {
            Comentario::excluir($comentario_id);

            $curso_id = $_SESSION["curso"]["id"];
            header("Location: ./../../ver/curso/$curso_id");
            exit;
        }
            
    }
?>