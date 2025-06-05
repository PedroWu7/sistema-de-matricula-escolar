<?php
    require __DIR__ . "\..\Config\Banco.php";
    class Curso {
        public static function listarCursos(){
            $conn = Banco::Conn();
            $sql = "SELECT * FROM cursos";
            $resp = $conn->query($sql);
            if($resp->num_rows > 0){
                $cursos = $resp->fetch_all();
                return $cursos;
            }
        }

        public static function existe($usuario){
            
        }

        static function adicionarUsuario($nome, $usuario, $senha) {
            
        }
    } 
?>