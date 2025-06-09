<?php
require_once __DIR__ . "/../Model/Comentario.php";
require_once __DIR__ . "/CursoController.php";

class ComentarioController{
    static function salvar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
            $pagina = $_GET['p'] ?? null;
            $url = explode('/', $pagina);
    
            $curso_id = intval($url[2] ?? 0);
            $autor = $_SESSION['usuario'] ?? 'Anônimo';
            $texto = trim($_POST['comentario']);
    
            if (!empty($texto)) {
                Comentario::salvar([
                    'curso_id' => $curso_id,
                    'autor' => $autor,
                    'texto' => $texto
                ]);

                exit;
            }
        }
    
    }
    public static function listarPorCurso($curso_id) {
        $conn = Banco::Conn(); // conexão do seu sistema
        $curso_id = intval($curso_id); // segurança básica
    
        $sql = "SELECT * FROM comentarios WHERE curso_id = $curso_id ORDER BY 'data' DESC";
        $resultado = $conn->query($sql);
    
        $comentarios = [];
    
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $comentarios[] = $row;
            }
        }
    
        return $comentarios;
    }
    
}







?>