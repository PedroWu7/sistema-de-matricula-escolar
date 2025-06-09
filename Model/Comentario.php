<?php
    require_once __DIR__ . "/../Config/Banco.php";

    class Comentario {
        public static function salvar($dados) {
            
          $sql = "INSERT INTO comentarios (curso_id, autor, texto) VALUES (?, ?, ?)";
          $resp = Banco::Conn()->query($sql);
        }
      
        public static function listarPorCurso($curso_id) {
          $sql = "SELECT * FROM comentarios WHERE curso_id = ? ORDER BY 'data' DESC";
          $resp = Banco::Conn()->query($sql);

        }
      }
      
?>