<?php
require_once __DIR__ . "/../Config/Banco.php";

class Comentario {

    public static function listarPorCurso($curso_id) {
      $sql = "SELECT * FROM comentarios WHERE curso_id = $curso_id ORDER BY horario DESC";
      $resp = Banco::Conn()->query($sql); 
      return $resp;
    }

    public static function salvar($curso_id, $autor, $texto) {
      $sql = "INSERT INTO `comentarios` (`id`, `curso_id`, `autor`, `texto`, `horario`) VALUES (NULL, '$curso_id', '$autor', '$texto', current_timestamp())";
      $resp = Banco::Conn()->query($sql);
    }

    public static function excluir($comentario_id) {
      $conn = Banco::Conn();
      $sql = "DELETE FROM comentarios WHERE id = $comentario_id";
      return $conn->query($sql);
    }

    public static function editar($comentario_id, $novoComentario) {
      $conn = Banco::Conn();
      $sql = "UPDATE comentarios SET texto = '$novoComentario' WHERE id = '$comentario_id'";
      $conn->query($sql);
    }
}
?>
