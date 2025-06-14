<?php
require_once __DIR__ . "/../Model/Comentario.php";
require_once __DIR__ . "/CursoController.php";
if (session_status() === PHP_SESSION_NONE) {
      session_start();
}
class ComentarioController{
    public static function listarPorCurso() {
        $conn = Banco::Conn(); 
        $pagina = $_GET['p'] ?? null;
        $url = explode('/', $pagina);
        $curso_id = intval($url[2] ?? 0);
    
        $sql = "SELECT * FROM comentarios WHERE curso_id = $curso_id ORDER BY horario DESC";
        $resultado = $conn->query($sql);
        return $resultado->fetch_all();
    
        return $comentarios;
    }
    public static function excluirComentario($comentario_id) {
        $conn = Banco::Conn(); 
        $sql = "DELETE FROM comentarios WHERE id = $comentario_id";
        $resp = $conn->query($sql);
        $curso_id = $_SESSION["curso"]["id"];
        header("Location: ./../../ver/curso/$curso_id");
        exit; 
    }
}
?>