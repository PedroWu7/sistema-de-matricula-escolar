<?php
    $conn = new mysqli("localhost", "root", "", "sistema_escolar");
    if($conn->error){
        echo "Erro ao fazer a conexão com o banco.";
    }

    function usuarioExiste($conn, $usuario, $senha){
        $q = "SELECT * FROM alunos WHERE usuario = '$usuario' AND senha = '$senha'";
        $resultado = $conn->query($q);
        if ($resultado->num_rows > 0){
            return true;
        }
        return false;
    }
?>