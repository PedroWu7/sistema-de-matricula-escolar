<?php
require_once __DIR__ . "/../Model/Comentario.php";
require_once __DIR__ . "/CursoController.php";

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
        $sql = "DELETE FROM comentarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $comentario_id);
        $stmt->execute();
        header("Location:curso");

        exit; 
    }
}

?>