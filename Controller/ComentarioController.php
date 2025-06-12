<?php
require_once __DIR__ . "/../Model/Comentario.php";
require_once __DIR__ . "/CursoController.php";

class ComentarioController{
    static function salvar(){
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comentario"])) {
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
    
            $curso_id = intval($url[2] ?? 0);
            $autor = $_SESSION["usuario"];
            $texto = trim($_POST["comentario"]);
    
            if (!empty($texto)) {

                Comentario::salvar($curso_id, $autor, $texto);

                exit;
            }else{
                echo "Nada a ser enviado";
            }
        }
    
    }
    public static function listarPorCurso($curso_id) {
        $conn = Banco::Conn(); 
        $curso_id = intval($curso_id); 
    
        $sql = "SELECT * FROM comentarios WHERE curso_id = $curso_id ORDER BY horario DESC";
        $resultado = $conn->query($sql);
    
        $comentarios = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comentarios[] = $row;
            }
        }
    
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