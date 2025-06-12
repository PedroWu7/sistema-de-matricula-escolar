<?php
    require_once __DIR__ . "/../Config/Banco.php";

    class Comentario {
        public static function salvar($curso_id, $autor, $texto) {
          $sql = "INSERT INTO `comentarios` (`id`, `curso_id`, `autor`, `texto`, `horario`) VALUES (NULL, '$curso_id', '$autor', '$texto', current_timestamp())";
          $resp = Banco::Conn()->query($sql);
        }
      
        public static function listarPorCurso($curso_id) {
          $sql = "SELECT * FROM comentarios WHERE curso_id = $curso_id ORDER BY horario DESC";
          $resp = Banco::Conn()->query($sql); 

        }
      }
      
?>